<!DOCTYPE html>
<html lang="pt-BR" data-theme="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Acesse sua conta na Luminários ou crie uma nova.">
  <title>Luminários | Acesso</title>
  <link rel="stylesheet" href="CSS/style.css">
  <style>
    /* ── Layout específico da página de login ──────────────────── */
    .auth-header {
      background: var(--header-top-bg);
      padding: 16px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .brand-link {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }
    .brand-link img { height: 38px; width: auto; }
    .brand-link .brand-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      font-weight: 900;
      letter-spacing: 0.12em;
      color: #e8f1f2;
    }
    .btn-theme {
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.15);
      color: #e8f1f2;
      padding: 7px 16px;
      border-radius: 50px;
      font-family: 'Nunito Sans', sans-serif;
      font-size: 0.82rem;
      cursor: pointer;
      transition: background 0.2s;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .btn-theme:hover { background: rgba(255,255,255,0.18); }

    /* ── Main Layout ────────────────────────────────────────────── */
    .auth-page {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 48px 16px;
      position: relative;
      overflow: hidden;
    }
    .auth-page::before,
    .auth-page::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.35;
      pointer-events: none;
      z-index: 0;
    }
    .auth-page::before {
      width: 400px; height: 400px;
      background: var(--el-secondary);
      top: -60px; left: -80px;
    }
    .auth-page::after {
      width: 300px; height: 300px;
      background: var(--btn-primary);
      bottom: -40px; right: -60px;
    }

    /* ── Auth Card ──────────────────────────────────────────────── */
    .auth-card {
      background: var(--card-bg);
      border-radius: 18px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 460px;
      padding: 44px 44px 36px;
      position: relative;
      z-index: 1;
      transition: background-color 0.4s ease;
    }
    .auth-card::before {
      content: '';
      position: absolute;
      top: 0; left: 32px; right: 32px;
      height: 3px;
      background: linear-gradient(90deg, var(--btn-primary), var(--status-active));
      border-radius: 0 0 4px 4px;
    }
    .auth-eyebrow {
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--el-secondary);
      margin-bottom: 6px;
    }
    .auth-title {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      font-weight: 700;
      line-height: 1.15;
      margin-bottom: 4px;
    }
    .auth-subtitle {
      font-size: 0.88rem;
      opacity: 0.6;
      margin-bottom: 28px;
    }

    /* Toggle pills */
    .auth-toggle {
      display: flex;
      background: var(--bg-color);
      border-radius: 50px;
      padding: 4px;
      margin-bottom: 32px;
      gap: 4px;
    }
    .toggle-btn {
      flex: 1;
      padding: 9px 0;
      border: none;
      border-radius: 50px;
      font-family: 'Nunito Sans', sans-serif;
      font-size: 0.88rem;
      font-weight: 600;
      cursor: pointer;
      background: transparent;
      color: var(--text-color);
      opacity: 0.55;
      transition: all 0.25s;
    }
    .toggle-btn.active {
      background: var(--btn-primary);
      color: #fff;
      opacity: 1;
      box-shadow: 0 4px 14px rgba(0,100,148,0.35);
    }

    /* Form */
    .auth-form { display: flex; flex-direction: column; gap: 18px; }
    .auth-form .form-group { display: flex; flex-direction: column; gap: 7px; }
    .auth-form .form-group label {
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.04em;
      opacity: 0.75;
    }
    .auth-form .form-group input {
      padding: 13px 16px;
      border: 1.5px solid var(--border-subtle);
      border-radius: 10px;
      background: transparent;
      color: var(--text-color);
      font-family: 'Nunito Sans', sans-serif;
      font-size: 0.95rem;
      transition: border-color 0.2s, box-shadow 0.2s;
      width: 100%;
    }
    .auth-form .form-group input:focus {
      outline: none;
      border-color: var(--status-active);
      box-shadow: 0 0 0 4px rgba(27,152,224,0.12);
    }
    .password-wrapper { position: relative; display: flex; }
    .password-wrapper input { padding-right: 48px; flex: 1; }
    .toggle-pw {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1rem;
      padding: 4px;
      opacity: 0.6;
      transition: opacity 0.2s;
    }
    .toggle-pw:hover { opacity: 1; }

    /* Submit */
    .btn-submit-auth {
      background: linear-gradient(135deg, var(--btn-primary), var(--el-secondary));
      color: #fff;
      padding: 14px 28px;
      border-radius: 10px;
      font-family: 'Nunito Sans', sans-serif;
      font-size: 0.95rem;
      font-weight: 700;
      letter-spacing: 0.5px;
      border: none;
      cursor: pointer;
      box-shadow: 0 4px 16px rgba(0,100,148,0.4);
      transition: all 0.2s;
      width: 100%;
      margin-top: 4px;
    }
    .btn-submit-auth:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0,100,148,0.5);
    }

    /* Messages */
    .auth-msg {
      padding: 12px 16px;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 600;
      display: none;
      margin-bottom: 4px;
    }
    .auth-msg.show { display: block; }
    .auth-msg.success { background: rgba(34,197,94,0.12); color: #166534; border: 1px solid rgba(34,197,94,0.3); }
    .auth-msg.error   { background: rgba(239,68,68,0.1);  color: #991b1b; border: 1px solid rgba(239,68,68,0.3); }
    [data-theme="dark"] .auth-msg.success { color: #86efac; }
    [data-theme="dark"] .auth-msg.error   { color: #fca5a5; }

    /* Panel hidden */
    .form-panel.hidden { display: none; }

    /* Footer link */
    .auth-footer-link {
      text-align: center;
      font-size: 0.85rem;
      opacity: 0.65;
      margin-top: 20px;
    }
    .auth-footer-link a {
      color: var(--status-active);
      font-weight: 700;
      cursor: pointer;
      text-decoration: underline;
    }

    /* Page footer */
    .auth-page-footer {
      text-align: center;
      padding: 20px;
      font-size: 0.8rem;
      opacity: 0.45;
    }

    @media (max-width: 480px) {
      .auth-card { padding: 32px 24px 28px; }
      .auth-title { font-size: 1.75rem; }
    }
  </style>
</head>
<body>

  <!-- Minimal Header -->
  <header class="auth-header">
    <a href="index.php" class="brand-link">
      <img src="IMG/Logo_sem_fundo.png" alt="Logo Luminários" onerror="this.style.display='none'">
      <span class="brand-title">LUMINÁRIOS</span>
    </a>
    <button class="btn-theme" onclick="toggleTheme()" aria-label="Alternar tema">
      <span id="theme-icon">🌙</span>
      <span id="theme-label">Modo Escuro</span>
    </button>
  </header>

  <main class="auth-page">
    <div class="auth-card">

      <p class="auth-eyebrow" id="card-eyebrow">🔐 Área do Leitor</p>
      <h1 class="auth-title" id="card-title">Bem-vindo de volta</h1>
      <p class="auth-subtitle" id="card-subtitle">Faça login para acessar sua biblioteca.</p>

      <!-- Toggle -->
      <div class="auth-toggle" role="tablist" aria-label="Alternar entre Login e Cadastro">
        <button class="toggle-btn active" id="tab-login"    role="tab" aria-selected="true"  onclick="showPanel('login')">Entrar</button>
        <button class="toggle-btn"        id="tab-cadastro" role="tab" aria-selected="false" onclick="showPanel('cadastro')">Cadastrar</button>
      </div>

      <!-- ── LOGIN FORM ── -->
      <div id="panel-login" class="form-panel" role="tabpanel">
        <div id="msg-login" class="auth-msg" aria-live="polite"></div>
        <form class="auth-form" onsubmit="handleLogin(event)" novalidate>
          <div class="form-group">
            <label for="login-email">E-mail</label>
            <input type="email" id="login-email" placeholder="exemplo@email.com" autocomplete="email" required>
          </div>
          <div class="form-group">
            <label for="login-senha">Senha</label>
            <div class="password-wrapper">
              <input type="password" id="login-senha" placeholder="Sua senha" autocomplete="current-password" required>
              <button type="button" class="toggle-pw" onclick="togglePw('login-senha', this)" aria-label="Mostrar senha">👁️</button>
            </div>
          </div>
          <button type="submit" class="btn-submit-auth">Entrar na Biblioteca</button>
        </form>
        <p class="auth-footer-link">Não tem conta? <a onclick="showPanel('cadastro')">Cadastre-se grátis</a></p>
      </div>

      <!-- ── CADASTRO FORM ── -->
      <div id="panel-cadastro" class="form-panel hidden" role="tabpanel">
        <div id="msg-cadastro" class="auth-msg" aria-live="polite"></div>
        <form class="auth-form" onsubmit="handleCadastro(event)" novalidate>
          <div class="form-group">
            <label for="cad-nome">Nome Completo</label>
            <input type="text" id="cad-nome" placeholder="Seu nome completo" autocomplete="name" required>
          </div>
          <div class="form-group">
            <label for="cad-email">E-mail</label>
            <input type="email" id="cad-email" placeholder="exemplo@email.com" autocomplete="email" required>
          </div>
          <div class="form-group">
            <label for="cad-senha">Senha</label>
            <div class="password-wrapper">
              <input type="password" id="cad-senha" placeholder="Mínimo 6 caracteres" autocomplete="new-password" required>
              <button type="button" class="toggle-pw" onclick="togglePw('cad-senha', this)" aria-label="Mostrar senha">👁️</button>
            </div>
          </div>
          <div class="form-group">
            <label for="cad-confirmar">Confirmar Senha</label>
            <div class="password-wrapper">
              <input type="password" id="cad-confirmar" placeholder="Repita a senha" autocomplete="new-password" required>
              <button type="button" class="toggle-pw" onclick="togglePw('cad-confirmar', this)" aria-label="Mostrar senha">👁️</button>
            </div>
          </div>
          <button type="submit" class="btn-submit-auth">Criar minha Conta</button>
        </form>
        <p class="auth-footer-link">Já tem conta? <a onclick="showPanel('login')">Fazer login</a></p>
      </div>

    </div>
  </main>

  <footer class="auth-page-footer">© 2024 Luminários. Todos os direitos reservados.</footer>

  <!-- VLibras -->
  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>

  <script>
    /* ── THEME ─────────────────────────────────────────────────── */
    const THEME_KEY = 'luminarios-theme';
    function applyTheme(isDark) {
      document.body.setAttribute('data-theme', isDark ? 'dark' : '');
      const icon  = document.getElementById('theme-icon');
      const label = document.getElementById('theme-label');
      if (icon)  icon.textContent  = isDark ? '☀️' : '🌙';
      if (label) label.textContent = isDark ? 'Modo Claro' : 'Modo Escuro';
      localStorage.setItem(THEME_KEY, isDark ? 'dark' : 'light');
    }
    function toggleTheme() {
      applyTheme(document.body.getAttribute('data-theme') !== 'dark');
    }
    (function initTheme() {
      const saved = localStorage.getItem(THEME_KEY);
      if (saved) applyTheme(saved === 'dark');
      else applyTheme(window.matchMedia('(prefers-color-scheme: dark)').matches);
    })();

    /* ── Se já logado, redireciona ─────────────────────────────── */
    (function checkSession() {
      try {
        const session = JSON.parse(localStorage.getItem('luminarios-session'));
        if (session && session.nome) window.location.replace('index.php');
      } catch(e) {}
    })();

    /* ── PANEL TOGGLE ──────────────────────────────────────────── */
    const titles = {
      login:    { eyebrow: '🔐 Área do Leitor', title: 'Bem-vindo de volta',  subtitle: 'Faça login para acessar sua biblioteca.' },
      cadastro: { eyebrow: '📚 Nova Conta',     title: 'Crie sua conta',      subtitle: 'Junte-se à Luminários gratuitamente.' }
    };
    function showPanel(panel) {
      ['login', 'cadastro'].forEach(p => {
        document.getElementById('panel-' + p).classList.toggle('hidden', p !== panel);
        const tab = document.getElementById('tab-' + p);
        tab.classList.toggle('active', p === panel);
        tab.setAttribute('aria-selected', String(p === panel));
      });
      const t = titles[panel];
      document.getElementById('card-eyebrow').textContent  = t.eyebrow;
      document.getElementById('card-title').textContent    = t.title;
      document.getElementById('card-subtitle').textContent = t.subtitle;
      clearMsg('login');
      clearMsg('cadastro');
    }

    /* ── HELPERS ───────────────────────────────────────────────── */
    function showMsg(panel, type, text) {
      const el = document.getElementById('msg-' + panel);
      el.className = 'auth-msg ' + type + ' show';
      el.textContent = text;
    }
    function clearMsg(panel) {
      const el = document.getElementById('msg-' + panel);
      el.className = 'auth-msg';
      el.textContent = '';
    }
    function togglePw(inputId, btn) {
      const inp  = document.getElementById(inputId);
      const show = inp.type === 'password';
      inp.type      = show ? 'text' : 'password';
      btn.textContent = show ? '🙈' : '👁️';
    }

    /* ── LOCALSTORAGE USERS ────────────────────────────────────── */
    const USERS_KEY = 'luminarios-users';
    function getUsers() {
      try { return JSON.parse(localStorage.getItem(USERS_KEY)) || {}; } catch { return {}; }
    }
    function saveUsers(users) {
      localStorage.setItem(USERS_KEY, JSON.stringify(users));
    }

    /* ── CADASTRO ──────────────────────────────────────────────── */
    function handleCadastro(e) {
      e.preventDefault();
      const nome      = document.getElementById('cad-nome').value.trim();
      const email     = document.getElementById('cad-email').value.trim().toLowerCase();
      const senha     = document.getElementById('cad-senha').value;
      const confirmar = document.getElementById('cad-confirmar').value;

      if (!nome || !email || !senha || !confirmar)
        return showMsg('cadastro', 'error', '⚠️ Preencha todos os campos.');
      if (senha.length < 6)
        return showMsg('cadastro', 'error', '⚠️ A senha deve ter pelo menos 6 caracteres.');
      if (senha !== confirmar)
        return showMsg('cadastro', 'error', '⚠️ As senhas não coincidem.');

      const users = getUsers();
      if (users[email])
        return showMsg('cadastro', 'error', '⚠️ Este e-mail já está cadastrado. Faça login.');

      users[email] = { nome, email, senha };
      saveUsers(users);
      showMsg('cadastro', 'success', `✅ Conta criada! Bem-vindo, ${nome}!`);
      e.target.reset();
      setTimeout(() => showPanel('login'), 1800);
    }

    /* ── LOGIN ─────────────────────────────────────────────────── */
    function handleLogin(e) {
      e.preventDefault();
      const email = document.getElementById('login-email').value.trim().toLowerCase();
      const senha = document.getElementById('login-senha').value;

      if (!email || !senha)
        return showMsg('login', 'error', '⚠️ Preencha e-mail e senha.');

      const users = getUsers();
      const user  = users[email];

      if (!user || user.senha !== senha)
        return showMsg('login', 'error', '❌ E-mail ou senha incorretos.');

      showMsg('login', 'success', `✅ Login realizado! Redirecionando, ${user.nome}…`);
      localStorage.setItem('luminarios-session', JSON.stringify({ nome: user.nome, email: user.email }));
      setTimeout(() => { window.location.href = 'index.php'; }, 1200);
    }
  </script>
</body>
</html>
