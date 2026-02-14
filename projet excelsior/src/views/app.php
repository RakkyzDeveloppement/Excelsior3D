<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Excelsior 3D - Calcul de Prix Reels</title>
  <link rel="stylesheet" href="/assets/css/app.css" />
</head>
<body>
  <div class="page-loader" id="pageLoader" aria-hidden="true">
    <div class="loader-modal">
      <div class="loader-title">EXCELSIOR 3D</div>
      <div class="loader-status-wrap">
        <div class="loader-status" id="loaderStatus">Chargement assets...</div>
      </div>
    </div>
  </div>
  <div class="topbar">
    <div class="nav">
      <div class="brand">Excelsior 3D</div>
      <div class="nav-actions">
        <select id="language">
          <option value="fr">FR</option>
          <option value="en">EN</option>
        </select>
        <select id="displayCurrency">
          <option value="EUR">EUR</option>
          <option value="USD">USD</option>
          <option value="GBP">GBP</option>
        </select>
        <span class="nav-user" id="navUser"></span>
        <button class="secondary" id="navAuthBtn">Connexion</button>
        <button class="secondary" id="navLogoutBtn" style="display:none;">Deconnexion</button>
      </div>
    </div>
  </div>

  <section class="hero">
    <div class="title" id="title">Excelsior 3D</div>
    <div class="subtitle" id="subtitle">Calcul du prix reel pour impression 3D</div>
  </section>

  <main>
    <section class="card">
      <h2 id="calcTitle">Calculateur</h2>
      <div class="grid">
        <div>
          <label id="labelName">Nom du produit</label>
          <input id="name" placeholder="Support mural" />
        </div>
        <div>
          <label id="labelWeight">Poids (g)</label>
          <input id="weight" type="number" step="0.01" value="100" />
        </div>
        <div>
          <label id="labelPrintTime">Temps impression (h)</label>
          <input id="printTime" type="number" step="0.01" value="6" />
        </div>
        <div>
          <label id="labelLaborTime">Temps main d'oeuvre (h)</label>
          <input id="laborTime" type="number" step="0.01" value="0" />
        </div>
        <div>
          <label id="labelEnergy">Conso energie (kWh)</label>
          <input id="energy" type="number" step="0.01" value="1.2" />
        </div>
        <div>
          <label id="labelOther">Autres couts fixes</label>
          <input id="otherCosts" type="number" step="0.01" value="0" />
        </div>
      </div>
      <div class="results" style="margin-top:16px;">
        <div class="result-box">
          <div class="muted" id="labelMaterial">Materiel</div>
          <div class="value" id="materialCost">-</div>
        </div>
        <div class="result-box">
          <div class="muted" id="labelEnergyCost">Energie</div>
          <div class="value" id="energyCost">-</div>
        </div>
        <div class="result-box">
          <div class="muted" id="labelMachine">Machine</div>
          <div class="value" id="machineCostOut">-</div>
        </div>
        <div class="result-box">
          <div class="muted" id="labelLabor">Main d'oeuvre</div>
          <div class="value" id="laborCostOut">-</div>
        </div>
        <div class="result-box">
          <div class="muted" id="labelCost">Cout total</div>
          <div class="value" id="totalCost">-</div>
        </div>
        <div class="result-box">
          <div class="muted" id="labelPrice">Prix conseille</div>
          <div class="value" id="price">-</div>
        </div>
      </div>
      <div class="actions" style="margin-top:16px;">
        <button id="saveBtn">Enregistrer</button>
        <button class="secondary" id="recalcBtn">Recalculer</button>
      </div>
    </section>

    <section class="card">
      <h2 id="settingsTitle">Parametres de cout</h2>
      <div class="grid">
        <div>
          <label id="labelBaseCurrency">Devise de base</label>
          <select id="baseCurrency">
            <option value="EUR">EUR</option>
            <option value="USD">USD</option>
            <option value="GBP">GBP</option>
          </select>
        </div>
        <div>
          <label id="labelRateEur">Taux vers EUR</label>
          <input id="rateEur" type="number" step="0.0001" />
        </div>
        <div>
          <label id="labelRateUsd">Taux vers USD</label>
          <input id="rateUsd" type="number" step="0.0001" />
        </div>
        <div>
          <label id="labelRateGbp">Taux vers GBP</label>
          <input id="rateGbp" type="number" step="0.0001" />
        </div>
        <div>
          <label id="labelFilament">Prix filament (par kg)</label>
          <input id="filamentPrice" type="number" step="0.01" />
        </div>
        <div>
          <label id="labelElectricity">Prix electricite (kWh)</label>
          <input id="electricityPrice" type="number" step="0.01" />
        </div>
        <div>
          <label id="labelMachineCost">Cout machine (par h)</label>
          <input id="machineCost" type="number" step="0.01" />
        </div>
        <div>
          <label id="labelLaborCost">Cout main d'oeuvre (par h)</label>
          <input id="laborCost" type="number" step="0.01" />
        </div>
        <div>
          <label id="labelOverhead">Frais generaux (%)</label>
          <input id="overheadPercent" type="number" step="0.1" />
        </div>
        <div>
          <label id="labelMargin">Marge (%)</label>
          <input id="marginPercent" type="number" step="0.1" />
        </div>
      </div>
      <div class="actions" style="margin-top:16px;">
        <button id="saveSettingsBtn">Sauvegarder</button>
      </div>
      <div class="muted" id="settingsNote" style="margin-top:8px;">
        Les taux de change sont editables. 1 unite de devise de base = taux vers EUR/USD/GBP.
      </div>
    </section>
    <section class="card teaser-card">
      <h2 id="teaserTitle">Prochaine fonctionnalite</h2>
      <div class="muted" id="teaserText">En cours de developpement. Un nouveau module arrive bientot pour aller plus loin.</div>
      <div class="teaser-chip" id="teaserBadge">En cours de developpement</div>
    </section>
    <section class="card" style="grid-column: 1 / -1;">
      <h2 id="historyTitle">Historique</h2>
      <table>
        <thead>
          <tr>
            <th id="thName">Nom</th>
            <th id="thWeight">Poids</th>
            <th id="thTime">Temps</th>
            <th id="thCost">Cout</th>
            <th id="thPrice">Prix</th>
            <th id="thDate">Date</th>
          </tr>
        </thead>
        <tbody id="historyBody"></tbody>
      </table>
    </section>
  </main>

  <div class="modal" id="authModal" aria-hidden="true">
    <div class="modal-overlay" data-close="true"></div>
    <div class="modal-card" role="dialog" aria-modal="true">
      <div class="modal-header">
        <div class="modal-title" id="authTitle">Compte</div>
      </div>
      <div class="modal-tabs">
        <button class="tab-btn active" data-tab="login" id="tabLoginBtn">Connexion</button>
        <button class="tab-btn" data-tab="register" id="tabRegisterBtn">Inscription</button>
        <button class="tab-btn" data-tab="profile" id="tabProfileBtn">Profil</button>
        <button class="tab-btn" data-tab="forgot" id="tabForgotBtn">Mot de passe</button>
      </div>

      <div class="tab active" id="tab-login">
        <div class="grid">
          <div>
            <label id="labelLoginEmail">Email</label>
            <input id="loginEmail" type="email" placeholder="email@exemple.com" />
          </div>
          <div>
            <label id="labelLoginPassword">Mot de passe</label>
            <input id="loginPassword" type="password" />
          </div>
        </div>
        <div class="actions" style="margin-top:12px;">
          <button id="loginBtn">Connexion</button>
        </div>
      </div>

      <div class="tab" id="tab-register">
        <div class="grid">
          <div>
            <label id="labelRegisterEmail">Email</label>
            <input id="registerEmail" type="email" placeholder="email@exemple.com" />
          </div>
          <div>
            <label id="labelRegisterPassword">Mot de passe</label>
            <input id="registerPassword" type="password" />
          </div>
          <div>
            <label id="labelRegisterPhone">Numero de telephone</label>
            <input id="registerPhone" type="text" />
          </div>
          <div>
            <label id="labelRegisterAddress">Adresse</label>
            <textarea id="registerAddress"></textarea>
          </div>
        </div>
        <div class="actions" style="margin-top:12px;">
          <button id="registerBtn">Creer le compte</button>
        </div>
      </div>

      <div class="tab" id="tab-profile">
        <div class="grid">
          <div>
            <label id="labelProfileEmail">Email</label>
            <input id="profileEmail" type="email" />
          </div>
          <div>
            <label id="labelProfileCurrentPassword">Mot de passe actuel</label>
            <input id="profileCurrentPassword" type="password" />
          </div>
          <div>
            <label id="labelProfilePassword">Nouveau mot de passe</label>
            <input id="profilePassword" type="password" />
          </div>
          <div>
            <label id="labelProfilePhone">Numero de telephone</label>
            <input id="profilePhone" type="text" />
          </div>
          <div>
            <label id="labelProfileAddress">Adresse</label>
            <textarea id="profileAddress"></textarea>
          </div>
        </div>
        <div class="actions" style="margin-top:12px;">
          <button id="profileSaveBtn">Sauvegarder</button>
        </div>
      </div>

      <div class="tab" id="tab-forgot">
        <div class="grid">
          <div>
            <label id="labelForgotEmail">Email</label>
            <input id="forgotEmail" type="email" placeholder="email@exemple.com" />
          </div>
          <div>
            <label id="labelResetToken">Token</label>
            <input id="resetToken" type="text" />
          </div>
          <div>
            <label id="labelResetPassword">Nouveau mot de passe</label>
            <input id="resetPassword" type="password" />
          </div>
        </div>
        <div class="actions" style="margin-top:12px;">
          <button class="secondary" id="requestResetBtn">Generer token</button>
          <button id="resetPasswordBtn">Reinitialiser</button>
        </div>
        <div class="muted" id="resetNote">Le token vous a ete envoye par mail.</div>
      </div>

      <div class="status" id="authStatus"></div>
    </div>
  </div>

  <div class="toast" id="toast" role="status" aria-live="polite"></div>

  <script src="/assets/js/app.js"></script>
</body>
</html>
