const t = {
  fr: {
    title: "Excelsior 3D",
    subtitle: "Calcul du prix reel pour impression 3D",
    calcTitle: "Calculateur",
    settingsTitle: "Parametres de cout",
    historyTitle: "Historique",
    teaserTitle: "Prochaine fonctionnalite",
    teaserText: "En cours de developpement. Un nouveau module arrive bientot pour aller plus loin.",
    teaserBadge: "En cours de developpement",
    labelName: "Nom du produit",
    labelWeight: "Poids (g)",
    labelPrintTime: "Temps impression (h)",
    labelLaborTime: "Temps main d'oeuvre (h)",
    labelEnergy: "Conso energie (kWh)",
    labelOther: "Autres couts fixes",
    labelMaterial: "Materiel",
    labelEnergyCost: "Energie",
    labelMachine: "Machine",
    labelLabor: "Main d'oeuvre",
    labelCost: "Cout total",
    labelPrice: "Prix conseille",
    labelBaseCurrency: "Devise de base",
    labelRateEur: "Taux vers EUR",
    labelRateUsd: "Taux vers USD",
    labelRateGbp: "Taux vers GBP",
    labelFilament: "Prix filament (par kg)",
    labelElectricity: "Prix electricite (kWh)",
    labelMachineCost: "Cout machine (par h)",
    labelLaborCost: "Cout main d'oeuvre (par h)",
    labelOverhead: "Frais generaux (%)",
    labelMargin: "Marge (%)",
    thName: "Nom",
    thWeight: "Poids",
    thTime: "Temps",
    thCost: "Cout",
    thPrice: "Prix",
    thDate: "Date",
    saveBtn: "Enregistrer",
    recalcBtn: "Recalculer",
    saveSettingsBtn: "Sauvegarder",
    settingsNote: "Les taux de change sont editables. 1 unite de devise de base = taux vers EUR/USD/GBP.",
    navAuthBtn: "Connexion",
    navLogoutBtn: "Deconnexion",
    tabLoginBtn: "Connexion",
    tabRegisterBtn: "Inscription",
    tabProfileBtn: "Profil",
    tabForgotBtn: "Mot de passe",
    labelLoginEmail: "Email",
    labelLoginPassword: "Mot de passe",
    labelRegisterEmail: "Email",
    labelRegisterPassword: "Mot de passe",
    labelRegisterPhone: "Numero de telephone",
    labelRegisterAddress: "Adresse (facultatif)",
    labelProfileEmail: "Email",
    labelProfileCurrentPassword: "Mot de passe actuel",
    labelProfilePassword: "Nouveau mot de passe",
    labelProfilePhone: "Numero de telephone",
    labelProfileAddress: "Adresse (facultatif)",
    labelForgotEmail: "Email",
    labelResetToken: "Token",
    labelResetPassword: "Nouveau mot de passe",
    loginBtn: "Connexion",
    registerBtn: "Creer le compte",
    profileSaveBtn: "Sauvegarder",
    requestResetBtn: "Generer token",
    resetPasswordBtn: "Reinitialiser",
    resetNote: "Le token vous a ete envoye par mail.",
    resetNoteDemo: "Le token est affiche ici (mode demo).",
    resetFailed: "Echec d'envoi du mail. Reessayez plus tard.",
    authLoggedOut: "Vous n'etes pas connecte.",
    authLoggedIn: "Connecte: ",
    historyEmpty: "Connectez-vous pour voir l'historique.",
    authTitle: "Compte",
    toastLogin: "Connexion reussie. Bienvenue."
  },
  en: {
    title: "Excelsior 3D",
    subtitle: "Real price calculator for 3D printing",
    calcTitle: "Calculator",
    settingsTitle: "Cost settings",
    historyTitle: "History",
    teaserTitle: "Upcoming Feature",
    teaserText: "Under development. A new module is coming soon to extend the app.",
    teaserBadge: "In Development",
    labelName: "Product name",
    labelWeight: "Weight (g)",
    labelPrintTime: "Print time (h)",
    labelLaborTime: "Labor time (h)",
    labelEnergy: "Energy use (kWh)",
    labelOther: "Other fixed costs",
    labelMaterial: "Material",
    labelEnergyCost: "Energy",
    labelMachine: "Machine",
    labelLabor: "Labor",
    labelCost: "Total cost",
    labelPrice: "Suggested price",
    labelBaseCurrency: "Base currency",
    labelRateEur: "Rate to EUR",
    labelRateUsd: "Rate to USD",
    labelRateGbp: "Rate to GBP",
    labelFilament: "Filament price (per kg)",
    labelElectricity: "Electricity price (kWh)",
    labelMachineCost: "Machine cost (per h)",
    labelLaborCost: "Labor cost (per h)",
    labelOverhead: "Overhead (%)",
    labelMargin: "Margin (%)",
    thName: "Name",
    thWeight: "Weight",
    thTime: "Time",
    thCost: "Cost",
    thPrice: "Price",
    thDate: "Date",
    saveBtn: "Save",
    recalcBtn: "Recalculate",
    saveSettingsBtn: "Save",
    settingsNote: "Exchange rates are editable. 1 base currency unit = rate to EUR/USD/GBP.",
    navAuthBtn: "Login",
    navLogoutBtn: "Logout",
    tabLoginBtn: "Login",
    tabRegisterBtn: "Register",
    tabProfileBtn: "Profile",
    tabForgotBtn: "Reset",
    labelLoginEmail: "Email",
    labelLoginPassword: "Password",
    labelRegisterEmail: "Email",
    labelRegisterPassword: "Password",
    labelRegisterPhone: "Phone number",
    labelRegisterAddress: "Address (optional)",
    labelProfileEmail: "Email",
    labelProfileCurrentPassword: "Current password",
    labelProfilePassword: "New password",
    labelProfilePhone: "Phone number",
    labelProfileAddress: "Address (optional)",
    labelForgotEmail: "Email",
    labelResetToken: "Token",
    labelResetPassword: "New password",
    loginBtn: "Login",
    registerBtn: "Create account",
    profileSaveBtn: "Save",
    requestResetBtn: "Generate token",
    resetPasswordBtn: "Reset",
    resetNote: "The token was sent by email.",
    resetNoteDemo: "Token is shown here (demo mode).",
    resetFailed: "Failed to send email. Please try again later.",
    authLoggedOut: "You are not logged in.",
    authLoggedIn: "Logged in: ",
    historyEmpty: "Log in to see history.",
    authTitle: "Account",
    toastLogin: "Login successful. Welcome back."
  }
};

const els = {
  language: document.getElementById('language'),
  displayCurrency: document.getElementById('displayCurrency'),
  navAuthBtn: document.getElementById('navAuthBtn'),
  navLogoutBtn: document.getElementById('navLogoutBtn'),
  navUser: document.getElementById('navUser'),
  baseCurrency: document.getElementById('baseCurrency'),
  rateEur: document.getElementById('rateEur'),
  rateUsd: document.getElementById('rateUsd'),
  rateGbp: document.getElementById('rateGbp'),
  filamentPrice: document.getElementById('filamentPrice'),
  electricityPrice: document.getElementById('electricityPrice'),
  machineCost: document.getElementById('machineCost'),
  laborCost: document.getElementById('laborCost'),
  overheadPercent: document.getElementById('overheadPercent'),
  marginPercent: document.getElementById('marginPercent'),
  name: document.getElementById('name'),
  weight: document.getElementById('weight'),
  printTime: document.getElementById('printTime'),
  laborTime: document.getElementById('laborTime'),
  energy: document.getElementById('energy'),
  otherCosts: document.getElementById('otherCosts'),
  materialCost: document.getElementById('materialCost'),
  energyCost: document.getElementById('energyCost'),
  machineCostOut: document.getElementById('machineCostOut'),
  laborCostOut: document.getElementById('laborCostOut'),
  totalCost: document.getElementById('totalCost'),
  price: document.getElementById('price'),
  saveBtn: document.getElementById('saveBtn'),
  recalcBtn: document.getElementById('recalcBtn'),
  saveSettingsBtn: document.getElementById('saveSettingsBtn'),
  historyBody: document.getElementById('historyBody'),
  authModal: document.getElementById('authModal'),
  authStatus: document.getElementById('authStatus'),
  tabLoginBtn: document.getElementById('tabLoginBtn'),
  tabRegisterBtn: document.getElementById('tabRegisterBtn'),
  tabProfileBtn: document.getElementById('tabProfileBtn'),
  tabForgotBtn: document.getElementById('tabForgotBtn'),
  loginEmail: document.getElementById('loginEmail'),
  loginPassword: document.getElementById('loginPassword'),
  registerEmail: document.getElementById('registerEmail'),
  registerPassword: document.getElementById('registerPassword'),
  registerPhone: document.getElementById('registerPhone'),
  registerAddress: document.getElementById('registerAddress'),
  profileEmail: document.getElementById('profileEmail'),
  profileCurrentPassword: document.getElementById('profileCurrentPassword'),
  profilePassword: document.getElementById('profilePassword'),
  profilePhone: document.getElementById('profilePhone'),
  profileAddress: document.getElementById('profileAddress'),
  forgotEmail: document.getElementById('forgotEmail'),
  resetToken: document.getElementById('resetToken'),
  resetPassword: document.getElementById('resetPassword'),
  loginBtn: document.getElementById('loginBtn'),
  registerBtn: document.getElementById('registerBtn'),
  profileSaveBtn: document.getElementById('profileSaveBtn'),
  requestResetBtn: document.getElementById('requestResetBtn'),
  resetPasswordBtn: document.getElementById('resetPasswordBtn'),
  resetNote: document.getElementById('resetNote'),
  toast: document.getElementById('toast')
};

let toastTimer = null;
function showToast(message) {
  if (!els.toast) return;
  els.toast.textContent = message;
  els.toast.classList.add('show');
  if (toastTimer) clearTimeout(toastTimer);
  toastTimer = setTimeout(() => {
    els.toast.classList.remove('show');
  }, 3000);
}

function applyLang(lang) {
  const dict = t[lang];
  for (const key in dict) {
    const el = document.getElementById(key);
    if (el) el.textContent = dict[key];
  }
  els.saveBtn.textContent = dict.saveBtn;
  els.recalcBtn.textContent = dict.recalcBtn;
  els.saveSettingsBtn.textContent = dict.saveSettingsBtn;
  els.resetNote.textContent = dict.resetNote;
  els.navAuthBtn.textContent = dict.navAuthBtn;
  els.navLogoutBtn.textContent = dict.navLogoutBtn;
  els.loginBtn.textContent = dict.loginBtn;
  els.registerBtn.textContent = dict.registerBtn;
  els.profileSaveBtn.textContent = dict.profileSaveBtn;
  els.requestResetBtn.textContent = dict.requestResetBtn;
  els.resetPasswordBtn.textContent = dict.resetPasswordBtn;
}

function fmt(amount, currency) {
  return new Intl.NumberFormat(undefined, { style: 'currency', currency }).format(amount);
}

function getRate(currency) {
  if (currency === 'EUR') return parseFloat(els.rateEur.value || 1);
  if (currency === 'USD') return parseFloat(els.rateUsd.value || 1);
  if (currency === 'GBP') return parseFloat(els.rateGbp.value || 1);
  return 1;
}

function compute() {
  const weight = parseFloat(els.weight.value || 0);
  const printTime = parseFloat(els.printTime.value || 0);
  const laborTime = parseFloat(els.laborTime.value || 0);
  const energy = parseFloat(els.energy.value || 0);
  const otherCosts = parseFloat(els.otherCosts.value || 0);

  const filamentPrice = parseFloat(els.filamentPrice.value || 0);
  const electricityPrice = parseFloat(els.electricityPrice.value || 0);
  const machineCost = parseFloat(els.machineCost.value || 0);
  const laborCost = parseFloat(els.laborCost.value || 0);
  const overheadPercent = parseFloat(els.overheadPercent.value || 0);
  const marginPercent = parseFloat(els.marginPercent.value || 0);

  const materialCost = (weight / 1000) * filamentPrice;
  const energyCost = energy * electricityPrice;
  const machineCostTotal = printTime * machineCost;
  const laborCostTotal = laborTime * laborCost;

  const subtotal = materialCost + energyCost + machineCostTotal + laborCostTotal + otherCosts;
  const overhead = subtotal * (overheadPercent / 100);
  const cost = subtotal + overhead;
  const price = cost * (1 + marginPercent / 100);

  const displayCurrency = els.displayCurrency.value;
  const rate = getRate(displayCurrency);
  const toDisplay = (value) => value * rate;

  els.materialCost.textContent = fmt(toDisplay(materialCost), displayCurrency);
  els.energyCost.textContent = fmt(toDisplay(energyCost), displayCurrency);
  els.machineCostOut.textContent = fmt(toDisplay(machineCostTotal), displayCurrency);
  els.laborCostOut.textContent = fmt(toDisplay(laborCostTotal), displayCurrency);
  els.totalCost.textContent = fmt(toDisplay(cost), displayCurrency);
  els.price.textContent = fmt(toDisplay(price), displayCurrency);

  return {
    materialCost, energyCost, machineCostTotal, laborCostTotal, subtotal, overhead, cost, price
  };
}

async function api(action, payload) {
  const res = await fetch(`/api.php?api=1&action=${action}`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: payload ? JSON.stringify(payload) : null
  });
  return res.json();
}

function setTab(name) {
  document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
  const tab = document.getElementById(`tab-${name}`);
  const btn = document.querySelector(`[data-tab="${name}"]`);
  if (tab) tab.classList.add('active');
  if (btn) btn.classList.add('active');
}

function openModal() {
  els.authModal.classList.add('open');
  els.authModal.setAttribute('aria-hidden', 'false');
}

function closeModal() {
  els.authModal.classList.remove('open');
  els.authModal.setAttribute('aria-hidden', 'true');
}

function setAuthStatus(text) {
  if (els.authStatus) els.authStatus.textContent = text || '';
}

function applyUser(user) {
  const dict = t[els.language.value] || t.fr;
  if (!user) {
    els.navAuthBtn.style.display = 'inline-block';
    els.navLogoutBtn.style.display = 'none';
    els.navUser.textContent = '';
    setAuthStatus(dict.authLoggedOut);
    setTab('login');
    return;
  }
  els.navAuthBtn.style.display = 'none';
  els.navLogoutBtn.style.display = 'inline-block';
  els.navUser.textContent = user.email;
  els.profileEmail.value = user.email || '';
  els.profilePhone.value = user.phone || '';
  els.profileAddress.value = user.address || '';
  setAuthStatus(dict.authLoggedIn + user.email);
  setTab('profile');
}

async function refreshProfile() {
  const data = await api('get_profile');
  if (data.ok) {
    applyUser(data.user);
  } else {
    applyUser(null);
  }
}

async function handleLogin() {
  const payload = {
    email: els.loginEmail.value,
    password: els.loginPassword.value
  };
  const data = await api('login', payload);
  if (data.ok) {
    els.loginPassword.value = '';
    applyUser(data.user);
    await loadHistory();
    closeModal();
    showToast((t[els.language.value] || t.fr).toastLogin);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  } else {
    setAuthStatus(data.error || 'Erreur');
  }
}

async function handleRegister() {
  const payload = {
    email: els.registerEmail.value,
    password: els.registerPassword.value,
    phone: els.registerPhone.value,
    address: els.registerAddress.value
  };
  const data = await api('register', payload);
  if (data.ok) {
    els.registerPassword.value = '';
    applyUser(data.user);
    await loadHistory();
    closeModal();
  } else {
    setAuthStatus(data.error || 'Erreur');
  }
}

async function handleProfileSave() {
  const payload = {
    email: els.profileEmail.value,
    current_password: els.profileCurrentPassword.value,
    new_password: els.profilePassword.value,
    phone: els.profilePhone.value,
    address: els.profileAddress.value
  };
  const data = await api('update_profile', payload);
  if (data.ok) {
    els.profileCurrentPassword.value = '';
    els.profilePassword.value = '';
    applyUser(data.user);
  } else {
    setAuthStatus(data.error || 'Erreur');
  }
}

async function handleLogout() {
  await api('logout');
  applyUser(null);
  els.historyBody.innerHTML = '';
}

async function handleResetRequest() {
  const payload = { email: els.forgotEmail.value };
  const data = await api('request_reset', payload);
  if (data.ok) {
    if (data.token) {
      els.resetToken.value = data.token;
      els.resetNote.textContent = (t[els.language.value] || t.fr).resetNoteDemo;
    } else {
      els.resetToken.value = '';
      els.resetNote.textContent = (t[els.language.value] || t.fr).resetNote;
    }
    setAuthStatus(data.message || 'OK');
    showToast((t[els.language.value] || t.fr).resetNote);
  } else {
    setAuthStatus(data.error || 'Erreur');
    showToast((t[els.language.value] || t.fr).resetFailed);
  }
}

async function handleResetPassword() {
  const payload = {
    token: els.resetToken.value,
    new_password: els.resetPassword.value
  };
  const data = await api('reset_password', payload);
  if (data.ok) {
    els.resetPassword.value = '';
    setAuthStatus('OK');
  } else {
    setAuthStatus(data.error || 'Erreur');
  }
}

async function loadSettings() {
  const data = await api('get_settings');
  if (!data.ok) return;
  const s = data.settings;

  els.language.value = s.language;
  els.baseCurrency.value = s.base_currency;
  els.rateEur.value = s.rate_eur;
  els.rateUsd.value = s.rate_usd;
  els.rateGbp.value = s.rate_gbp;
  els.filamentPrice.value = s.filament_price_per_kg;
  els.electricityPrice.value = s.electricity_price_per_kwh;
  els.machineCost.value = s.machine_cost_per_hour;
  els.laborCost.value = s.labor_cost_per_hour;
  els.overheadPercent.value = s.overhead_percent;
  els.marginPercent.value = s.margin_percent;
  applyLang(s.language);
  compute();
}

async function saveSettings() {
  const base = els.baseCurrency.value;
  const payload = {
    language: els.language.value,
    base_currency: base,
    rate_eur: els.rateEur.value,
    rate_usd: els.rateUsd.value,
    rate_gbp: els.rateGbp.value,
    filament_price_per_kg: els.filamentPrice.value,
    electricity_price_per_kwh: els.electricityPrice.value,
    machine_cost_per_hour: els.machineCost.value,
    labor_cost_per_hour: els.laborCost.value,
    overhead_percent: els.overheadPercent.value,
    margin_percent: els.marginPercent.value
  };

  if (base === 'EUR') payload.rate_eur = '1';
  if (base === 'USD') payload.rate_usd = '1';
  if (base === 'GBP') payload.rate_gbp = '1';

  const data = await api('set_settings', payload);
  if (data.ok) {
    await loadSettings();
  }
}

async function saveCalc() {
  const calc = compute();
  const displayCurrency = els.displayCurrency.value;
  const rate = getRate(displayCurrency);
  const payload = {
    name: els.name.value || 'Produit',
    weight_g: parseFloat(els.weight.value || 0),
    print_time_h: parseFloat(els.printTime.value || 0),
    labor_time_h: parseFloat(els.laborTime.value || 0),
    energy_kwh: parseFloat(els.energy.value || 0),
    material_cost: calc.materialCost,
    energy_cost: calc.energyCost,
    machine_cost: calc.machineCostTotal,
    labor_cost: calc.laborCostTotal,
    other_costs: parseFloat(els.otherCosts.value || 0),
    overhead_percent: parseFloat(els.overheadPercent.value || 0),
    margin_percent: parseFloat(els.marginPercent.value || 0),
    subtotal: calc.subtotal,
    overhead: calc.overhead,
    cost: calc.cost,
    price: calc.price,
    display_cost: calc.cost * rate,
    display_price: calc.price * rate,
    base_currency: els.baseCurrency.value,
    display_currency: displayCurrency
  };

  const data = await api('save_calc', payload);
  if (data.ok) {
    await loadHistory();
  }
}

async function loadHistory() {
  const data = await api('list_calcs');
  if (!data.ok) return;
  els.historyBody.innerHTML = '';
  if (!data.items.length) {
    const tr = document.createElement('tr');
    const dict = t[els.language.value] || t.fr;
    tr.innerHTML = `<td colspan="6" class="muted">${dict.historyEmpty}</td>`;
    els.historyBody.appendChild(tr);
    return;
  }
  data.items.forEach(item => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${item.name}</td>
      <td>${item.weight_g} g</td>
      <td>${item.print_time_h} h</td>
      <td>${fmt(item.display_cost, item.display_currency)}</td>
      <td>${fmt(item.display_price, item.display_currency)}</td>
      <td>${item.created_at}</td>
    `;
    els.historyBody.appendChild(tr);
  });
}

els.language.addEventListener('change', async () => {
  applyLang(els.language.value);
  await saveSettings();
  await refreshProfile();
  await loadHistory();
});

els.displayCurrency.addEventListener('change', compute);
['weight','printTime','laborTime','energy','otherCosts','filamentPrice','electricityPrice','machineCost','laborCost','overheadPercent','marginPercent','rateEur','rateUsd','rateGbp'].forEach(id => {
  const el = document.getElementById(id);
  if (el) el.addEventListener('input', compute);
});

els.saveBtn.addEventListener('click', saveCalc);
els.recalcBtn.addEventListener('click', compute);
els.saveSettingsBtn.addEventListener('click', saveSettings);
els.tabLoginBtn.addEventListener('click', () => setTab('login'));
els.tabRegisterBtn.addEventListener('click', () => setTab('register'));
els.tabProfileBtn.addEventListener('click', () => setTab('profile'));
els.tabForgotBtn.addEventListener('click', () => setTab('forgot'));
els.loginBtn.addEventListener('click', handleLogin);
els.registerBtn.addEventListener('click', handleRegister);
els.profileSaveBtn.addEventListener('click', handleProfileSave);
els.requestResetBtn.addEventListener('click', handleResetRequest);
els.resetPasswordBtn.addEventListener('click', handleResetPassword);
els.navAuthBtn.addEventListener('click', () => {
  openModal();
  setTab('login');
});
els.navLogoutBtn.addEventListener('click', handleLogout);

document.querySelectorAll('[data-close="true"]').forEach(el => {
  el.addEventListener('click', closeModal);
});

document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') closeModal();
});

loadSettings().then(async () => {
  await refreshProfile();
  await loadHistory();
});

const loaderState = {
  startedAt: Date.now(),
  ready: false,
  closed: false
};

function updateLoaderStatus(message) {
  const statusEl = document.getElementById('loaderStatus');
  if (!statusEl) return;
  statusEl.textContent = message;
}

function closePageLoader() {
  if (loaderState.closed) return;
  const loader = document.getElementById('pageLoader');
  if (!loader) return;
  loaderState.closed = true;
  loader.classList.add('is-hidden');
  setTimeout(() => loader.remove(), 500);
}

function tryCloseLoader() {
  if (!loaderState.ready) return;
  const elapsed = Date.now() - loaderState.startedAt;
  if (elapsed >= 5000) {
    closePageLoader();
  } else {
    setTimeout(tryCloseLoader, 120);
  }
}

function startPageLoaderSequence() {
  const steps = [
    'Chargement assets...',
    'Chargement style...',
    'Chargement de la logique...'
  ];
  let index = 0;
  updateLoaderStatus(steps[index]);

  const ticker = setInterval(() => {
    index = (index + 1) % steps.length;
    updateLoaderStatus(steps[index]);
  }, 1400);

  window.addEventListener('load', () => {
    loaderState.ready = true;
    tryCloseLoader();
  });

  setTimeout(() => {
    loaderState.ready = true;
    tryCloseLoader();
  }, 10000);

  const stopTicker = () => clearInterval(ticker);
  setTimeout(stopTicker, 10500);
}

startPageLoaderSequence();