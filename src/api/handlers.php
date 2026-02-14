<?php
if (!isset($_GET['api'])) {
    json_response(['ok' => false, 'error' => 'Invalid request'], 400);
}

$action = $_GET['action'] ?? '';
$input = json_decode(file_get_contents('php://input'), true) ?? [];

try {
    if ($action === 'get_settings') {
        json_response(['ok' => true, 'settings' => get_settings($db)]);
    }

    if ($action === 'set_settings') {
        $saved = save_settings($db, $input);
        json_response(['ok' => true, 'settings' => $saved]);
    }

    if ($action === 'register') {
        $email = trim((string)($input['email'] ?? ''));
        $password = (string)($input['password'] ?? '');
        $phone = trim((string)($input['phone'] ?? ''));
        $address = trim((string)($input['address'] ?? ''));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            json_response(['ok' => false, 'error' => 'Invalid email'], 400);
        }
        if (strlen($password) < 6) {
            json_response(['ok' => false, 'error' => 'Password too short'], 400);
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare('INSERT INTO users (email, password_hash, phone, address, created_at) VALUES (:email, :hash, :phone, :address, :created_at)');
        try {
            $stmt->execute([
                ':email' => $email,
                ':hash' => $hash,
                ':phone' => $phone,
                ':address' => $address,
                ':created_at' => gmdate('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            json_response(['ok' => false, 'error' => 'Email already used'], 400);
        }

        $_SESSION['user_id'] = (int)$db->lastInsertId();
        json_response(['ok' => true, 'user' => current_user($db)]);
    }

    if ($action === 'login') {
        $email = trim((string)($input['email'] ?? ''));
        $password = (string)($input['password'] ?? '');
        $stmt = $db->prepare('SELECT id, password_hash FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row || !password_verify($password, $row['password_hash'])) {
            json_response(['ok' => false, 'error' => 'Invalid credentials'], 401);
        }
        $_SESSION['user_id'] = (int)$row['id'];
        json_response(['ok' => true, 'user' => current_user($db)]);
    }

    if ($action === 'logout') {
        session_unset();
        session_destroy();
        json_response(['ok' => true]);
    }

    if ($action === 'get_profile') {
        $user = current_user($db);
        if (!$user) {
            json_response(['ok' => false, 'error' => 'Not authenticated'], 401);
        }
        json_response(['ok' => true, 'user' => $user]);
    }

    if ($action === 'update_profile') {
        $user = current_user($db);
        if (!$user) {
            json_response(['ok' => false, 'error' => 'Not authenticated'], 401);
        }
        $email = trim((string)($input['email'] ?? $user['email']));
        $phone = trim((string)($input['phone'] ?? ''));
        $address = trim((string)($input['address'] ?? ''));
        $newPassword = (string)($input['new_password'] ?? '');
        $currentPassword = (string)($input['current_password'] ?? '');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            json_response(['ok' => false, 'error' => 'Invalid email'], 400);
        }

        $needCurrent = ($email !== $user['email']) || ($newPassword !== '');
        if ($needCurrent) {
            $stmt = $db->prepare('SELECT password_hash FROM users WHERE id = :id');
            $stmt->execute([':id' => $user['id']]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row || !password_verify($currentPassword, $row['password_hash'])) {
                json_response(['ok' => false, 'error' => 'Current password required'], 401);
            }
        }

        $db->beginTransaction();
        $stmt = $db->prepare('UPDATE users SET email = :email, phone = :phone, address = :address WHERE id = :id');
        $stmt->execute([
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address,
            ':id' => $user['id']
        ]);

        if ($newPassword !== '') {
            if (strlen($newPassword) < 6) {
                $db->rollBack();
                json_response(['ok' => false, 'error' => 'Password too short'], 400);
            }
            $hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $db->prepare('UPDATE users SET password_hash = :hash WHERE id = :id');
            $stmt->execute([':hash' => $hash, ':id' => $user['id']]);
        }
        $db->commit();

        json_response(['ok' => true, 'user' => current_user($db)]);
    }

    if ($action === 'request_reset') {
        $email = trim((string)($input['email'] ?? ''));
        $stmt = $db->prepare('SELECT id FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            json_response(['ok' => true, 'message' => 'If the account exists, a reset token is generated.']);
        }

        $token = bin2hex(random_bytes(16));
        $expires = gmdate('Y-m-d H:i:s', time() + 3600);
        $stmt = $db->prepare('INSERT INTO password_resets (user_id, token, expires_at, created_at) VALUES (:uid, :token, :expires, :created)');
        $stmt->execute([
            ':uid' => $row['id'],
            ':token' => $token,
            ':expires' => $expires,
            ':created' => gmdate('Y-m-d H:i:s')
        ]);

        $subject = 'Reinitialisation du mot de passe';
        $html = '<p>Bonjour,</p><p>Voici votre token de reinitialisation :</p><p><b>' . $token . '</b></p><p>Ce token expire dans 1 heure.</p>';
        $result = send_mailjet($email, $email, $subject, $html);
        if (!$result['ok']) {
            log_mail('Mailjet error: status=' . ($result['status'] ?? 'n/a') . ' err=' . ($result['error'] ?? '') . ' resp=' . ($result['response'] ?? ''));
        }

        $resp = ['ok' => true, 'message' => 'If the account exists, a reset token was sent.'];
        if (!$result['ok'] && ((getenv('APP_SHOW_RESET_TOKEN') ?: '0') === '1')) {
            $resp['token'] = $token;
            $resp['message'] = 'Reset token generated (demo).';
        }
        json_response($resp);
    }

    if ($action === 'reset_password') {
        $token = trim((string)($input['token'] ?? ''));
        $newPassword = (string)($input['new_password'] ?? '');
        if ($token === '' || strlen($newPassword) < 6) {
            json_response(['ok' => false, 'error' => 'Invalid reset'], 400);
        }
        $stmt = $db->prepare('SELECT user_id FROM password_resets WHERE token = :token AND expires_at > :now');
        $stmt->execute([':token' => $token, ':now' => gmdate('Y-m-d H:i:s')]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            json_response(['ok' => false, 'error' => 'Invalid or expired token'], 400);
        }
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $db->prepare('UPDATE users SET password_hash = :hash WHERE id = :id');
        $stmt->execute([':hash' => $hash, ':id' => $row['user_id']]);
        $stmt = $db->prepare('DELETE FROM password_resets WHERE token = :token');
        $stmt->execute([':token' => $token]);
        json_response(['ok' => true]);
    }

    if ($action === 'save_calc') {
        $required = [
            'name','weight_g','print_time_h','labor_time_h','energy_kwh',
            'material_cost','energy_cost','machine_cost','labor_cost','other_costs',
            'overhead_percent','margin_percent','subtotal','overhead','cost','price',
            'display_cost','display_price',
            'base_currency','display_currency'
        ];
        foreach ($required as $k) {
            if (!array_key_exists($k, $input)) {
                json_response(['ok' => false, 'error' => 'Missing field: ' . $k], 400);
            }
        }

        $stmt = $db->prepare('INSERT INTO calculations
            (user_id, name, weight_g, print_time_h, labor_time_h, energy_kwh, material_cost, energy_cost, machine_cost, labor_cost, other_costs, overhead_percent, margin_percent, subtotal, overhead, cost, price, display_cost, display_price, base_currency, display_currency, created_at)
            VALUES
            (:user_id, :name, :weight_g, :print_time_h, :labor_time_h, :energy_kwh, :material_cost, :energy_cost, :machine_cost, :labor_cost, :other_costs, :overhead_percent, :margin_percent, :subtotal, :overhead, :cost, :price, :display_cost, :display_price, :base_currency, :display_currency, :created_at)');

        $input['created_at'] = gmdate('Y-m-d H:i:s');
        $stmt->execute([
            ':user_id' => $_SESSION['user_id'] ?? null,
            ':name' => $input['name'],
            ':weight_g' => $input['weight_g'],
            ':print_time_h' => $input['print_time_h'],
            ':labor_time_h' => $input['labor_time_h'],
            ':energy_kwh' => $input['energy_kwh'],
            ':material_cost' => $input['material_cost'],
            ':energy_cost' => $input['energy_cost'],
            ':machine_cost' => $input['machine_cost'],
            ':labor_cost' => $input['labor_cost'],
            ':other_costs' => $input['other_costs'],
            ':overhead_percent' => $input['overhead_percent'],
            ':margin_percent' => $input['margin_percent'],
            ':subtotal' => $input['subtotal'],
            ':overhead' => $input['overhead'],
            ':cost' => $input['cost'],
            ':price' => $input['price'],
            ':display_cost' => $input['display_cost'],
            ':display_price' => $input['display_price'],
            ':base_currency' => $input['base_currency'],
            ':display_currency' => $input['display_currency'],
            ':created_at' => $input['created_at']
        ]);

        json_response(['ok' => true]);
    }

    if ($action === 'list_calcs') {
        if (isset($_SESSION['user_id'])) {
            $stmt = $db->prepare('SELECT * FROM calculations WHERE user_id = :uid ORDER BY id DESC LIMIT 50');
            $stmt->execute([':uid' => $_SESSION['user_id']]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $rows = [];
        }
        json_response(['ok' => true, 'items' => $rows]);
    }

    json_response(['ok' => false, 'error' => 'Unknown action'], 400);
} catch (Exception $e) {
    json_response(['ok' => false, 'error' => $e->getMessage()], 500);
}
