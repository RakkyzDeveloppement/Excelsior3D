<?php
function load_env(string $path): void {
    if (!file_exists($path)) {
        return;
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line == '' || str_starts_with($line, '#')) {
            continue;
        }
        $parts = explode('=', $line, 2);
        if (count($parts) != 2) {
            continue;
        }
        $key = trim($parts[0]);
        $val = trim($parts[1]);
        if ($key == '') {
            continue;
        }
        if (getenv($key) === false) {
            putenv($key . '=' . $val);
        }
    }
}

load_env(__DIR__ . '/../.env');

$DB_HOST = getenv('DB_HOST') ?: 'localhost';
$DB_PORT = (int)(getenv('DB_PORT') ?: 3306);
$DB_NAME = getenv('DB_NAME') ?: 'excelsior';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: '';
$FORCE_HTTPS = (getenv('APP_FORCE_HTTPS') ?: '0') === '1';
$SHOW_RESET_TOKEN = (getenv('APP_SHOW_RESET_TOKEN') ?: '0') === '1';
$MAILJET_API_KEY = getenv('MAILJET_API_KEY') ?: '';
$MAILJET_API_SECRET = getenv('MAILJET_API_SECRET') ?: '';
$MAIL_FROM_EMAIL = getenv('MAIL_FROM_EMAIL') ?: '';
$MAIL_FROM_NAME = getenv('MAIL_FROM_NAME') ?: 'Excelsior 3D';

$serverDsn = 'mysql:host=' . $DB_HOST . ';port=' . $DB_PORT . ';charset=utf8mb4';
$db = new PDO($serverDsn, $DB_USER, $DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$db->exec('CREATE DATABASE IF NOT EXISTS `' . $DB_NAME . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
$db->exec('USE `' . $DB_NAME . '`');

$db->exec('CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(50) DEFAULT "",
    address TEXT DEFAULT "",
    created_at DATETIME NOT NULL
)');

$db->exec('CREATE TABLE IF NOT EXISTS password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(128) NOT NULL UNIQUE,
    expires_at DATETIME NOT NULL,
    created_at DATETIME NOT NULL
)');

$db->exec('CREATE TABLE IF NOT EXISTS settings (
    `key` VARCHAR(64) PRIMARY KEY,
    `value` TEXT NOT NULL
)');

$db->exec('CREATE TABLE IF NOT EXISTS calculations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    name VARCHAR(255) NOT NULL,
    weight_g DOUBLE NOT NULL,
    print_time_h DOUBLE NOT NULL,
    labor_time_h DOUBLE NOT NULL,
    energy_kwh DOUBLE NOT NULL,
    material_cost DOUBLE NOT NULL,
    energy_cost DOUBLE NOT NULL,
    machine_cost DOUBLE NOT NULL,
    labor_cost DOUBLE NOT NULL,
    other_costs DOUBLE NOT NULL,
    overhead_percent DOUBLE NOT NULL,
    margin_percent DOUBLE NOT NULL,
    subtotal DOUBLE NOT NULL,
    overhead DOUBLE NOT NULL,
    cost DOUBLE NOT NULL,
    price DOUBLE NOT NULL,
    display_cost DOUBLE NOT NULL,
    display_price DOUBLE NOT NULL,
    base_currency VARCHAR(3) NOT NULL,
    display_currency VARCHAR(3) NOT NULL,
    created_at DATETIME NOT NULL
)');

function ensure_column(PDO $db, string $dbName, string $table, string $column, string $definition): void {
    $stmt = $db->prepare('SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = :db AND TABLE_NAME = :tbl AND COLUMN_NAME = :col');
    $stmt->execute([':db' => $dbName, ':tbl' => $table, ':col' => $column]);
    if ((int)$stmt->fetchColumn() === 0) {
        $db->exec('ALTER TABLE `' . $table . '` ADD COLUMN ' . $definition);
    }
}

ensure_column($db, $DB_NAME, 'calculations', 'display_cost', 'display_cost DOUBLE NOT NULL DEFAULT 0');
ensure_column($db, $DB_NAME, 'calculations', 'display_price', 'display_price DOUBLE NOT NULL DEFAULT 0');
ensure_column($db, $DB_NAME, 'calculations', 'user_id', 'user_id INT NULL');

$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
if ($FORCE_HTTPS && !$https) {
    $host = $_SERVER['HTTP_HOST'] ?? '';
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    header('Location: https://' . $host . $uri, true, 302);
    exit;
}

ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'Lax');
if ($https) {
    ini_set('session.cookie_secure', '1');
}

session_start();

function get_settings(PDO $db): array {
    $defaults = [
        'language' => 'fr',
        'base_currency' => 'EUR',
        'rate_eur' => '1',
        'rate_usd' => '1.1',
        'rate_gbp' => '0.86',
        'filament_price_per_kg' => '22',
        'electricity_price_per_kwh' => '0.2',
        'machine_cost_per_hour' => '1.5',
        'labor_cost_per_hour' => '0',
        'overhead_percent' => '0',
        'margin_percent' => '30'
    ];

    $rows = $db->query('SELECT `key`, `value` FROM settings')->fetchAll(PDO::FETCH_KEY_PAIR);
    if (!$rows) {
        return $defaults;
    }
    return array_merge($defaults, $rows);
}

function save_settings(PDO $db, array $settings): array {
    $allowed = [
        'language',
        'base_currency',
        'rate_eur',
        'rate_usd',
        'rate_gbp',
        'filament_price_per_kg',
        'electricity_price_per_kwh',
        'machine_cost_per_hour',
        'labor_cost_per_hour',
        'overhead_percent',
        'margin_percent'
    ];

    $db->beginTransaction();
    $stmt = $db->prepare('INSERT INTO settings (`key`, `value`) VALUES (:key, :value)
        ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)');

    foreach ($allowed as $key) {
        if (array_key_exists($key, $settings)) {
            $stmt->execute([':key' => $key, ':value' => (string)$settings[$key]]);
        }
    }
    $db->commit();

    return get_settings($db);
}

function current_user(PDO $db): ?array {
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    $stmt = $db->prepare('SELECT id, email, phone, address FROM users WHERE id = :id');
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function json_response($data, int $code = 200): void {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function send_mailjet(string $toEmail, string $toName, string $subject, string $html, string $text = ''): array {
    $apiKey = getenv('MAILJET_API_KEY') ?: '';
    $apiSecret = getenv('MAILJET_API_SECRET') ?: '';
    $fromEmail = getenv('MAIL_FROM_EMAIL') ?: '';
    $fromName = getenv('MAIL_FROM_NAME') ?: 'Excelsior 3D';

    if ($apiKey === '' || $apiSecret === '' || $fromEmail === '') {
        return ['ok' => false, 'error' => 'Missing Mailjet credentials'];
    }

    $payload = [
        'Messages' => [[
            'From' => ['Email' => $fromEmail, 'Name' => $fromName],
            'To' => [['Email' => $toEmail, 'Name' => $toName]],
            'Subject' => $subject,
            'TextPart' => $text ?: strip_tags($html),
            'HTMLPart' => $html
        ]]
    ];

    $ch = curl_init('https://api.mailjet.com/v3.1/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ':' . $apiSecret);
    $caPath = __DIR__ . '/../storage/cacert-2025-12-02.pem';
    if (file_exists($caPath)) {
        curl_setopt($ch, CURLOPT_CAINFO, $caPath);
    }
    $resp = curl_exec($ch);
    $err = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $ok = $err === '' && $code >= 200 && $code < 300;
    return [
        'ok' => $ok,
        'error' => $err,
        'status' => $code,
        'response' => $resp
    ];
}

function log_mail(string $message): void {
    $dir = __DIR__ . '/../storage';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $line = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
    file_put_contents($dir . '/mail.log', $line, FILE_APPEND);
}
