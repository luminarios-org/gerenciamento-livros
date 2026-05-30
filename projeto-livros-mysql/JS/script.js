/* ============================================================
   LUMINÁRIOS — Script Unificado | v3.0
   ============================================================ */

/* ── CONSTANTES ──────────────────────────────────────────────── */
const THEME_KEY   = 'luminarios-theme';
const SESSION_KEY = 'luminarios-session';

/* ============================================================
   TEMA: Claro / Escuro
   ============================================================ */
function applyTheme(isDark) {
  const body  = document.body;
  const icon  = document.getElementById('theme-icon');
  const label = document.getElementById('theme-label');

  if (isDark) {
    body.setAttribute('data-theme', 'dark');
    if (icon)  icon.textContent  = '☀️';
    if (label) label.textContent = 'Modo Claro';
  } else {
    body.removeAttribute('data-theme');
    if (icon)  icon.textContent  = '🌙';
    if (label) label.textContent = 'Modo Escuro';
  }
  localStorage.setItem(THEME_KEY, isDark ? 'dark' : 'light');
}

function toggleTheme() {
  applyTheme(document.body.getAttribute('data-theme') !== 'dark');
}

/* Carrega preferência salva ou respeita SO */
(function initTheme() {
  const saved = localStorage.getItem(THEME_KEY);
  if (saved) {
    applyTheme(saved === 'dark');
  } else {
    applyTheme(window.matchMedia('(prefers-color-scheme: dark)').matches);
  }
})();

/* ============================================================
   SESSÃO / AUTH — Renderiza botão de Login ou Usuário logado
   ============================================================ */
(function renderAuthArea() {
  const area = document.getElementById('auth-area');
  if (!area) return;

  let session = null;
  try {
    session = JSON.parse(localStorage.getItem(SESSION_KEY));
  } catch (e) { /* ignorado */ }

  if (session && session.nome) {
    /* Usuário logado: exibe nome e botão Sair */
    area.innerHTML = `
      <div class="user-session" role="status" aria-label="Sessão do usuário">
        <span class="user-greeting">👤 ${escapeHtml(session.nome)}</span>
        <button class="btn-logout" onclick="handleLogout()" aria-label="Sair da conta">
          Sair
        </button>
      </div>
    `;
  } else {
    /* Visitante: exibe botão Login */
    area.innerHTML = `
      <button class="btn-login" onclick="window.location.href='login.php'" aria-label="Fazer login">
        🔐 Login
      </button>
    `;
  }
})();

function handleLogout() {
  localStorage.removeItem(SESSION_KEY);
  window.location.reload();
}

/* Utilitário de escape HTML para evitar XSS no nome */
function escapeHtml(str) {
  const div = document.createElement('div');
  div.appendChild(document.createTextNode(str));
  return div.innerHTML;
}

/* ============================================================
   FORMULÁRIO DE CONTATO
   ============================================================ */
function handleContactSubmit(event) {
  event.preventDefault();
  const nome     = document.getElementById('nome')?.value.trim();
  const email    = document.getElementById('email')?.value.trim();
  const assunto  = document.getElementById('assunto')?.value;
  const mensagem = document.getElementById('mensagem')?.value.trim();

  if (!nome || !email || !assunto || !mensagem) {
    alert('⚠️ Por favor, preencha todos os campos antes de enviar.');
    return;
  }
  if (mensagem.length < 20) {
    alert('⚠️ Sua mensagem deve ter pelo menos 20 caracteres.');
    return;
  }

  alert(`✅ Mensagem enviada com sucesso!\n\nObrigado, ${nome}! Retornaremos em até 48 horas úteis para ${email}.\n\n(Integração com backend PHP em breve)`);
  event.target.reset();
}

/* ============================================================
   ANIMAÇÃO DE SCROLL (Intersection Observer)
   ============================================================ */
document.addEventListener('DOMContentLoaded', () => {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.opacity   = '1';
          entry.target.style.transform = 'translateY(0)';
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1, rootMargin: '0px 0px -40px 0px' }
  );

  document.querySelectorAll('.contact-info-card, .strip-stat, .faq-card').forEach((el) => {
    el.style.opacity    = '0';
    el.style.transform  = 'translateY(16px)';
    el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    observer.observe(el);
  });
});

/* ============================================================
   HEADER: Sombra ao scroll
   ============================================================ */
window.addEventListener('scroll', () => {
  const header = document.querySelector('.site-header');
  if (!header) return;
  header.style.boxShadow = window.scrollY > 10
    ? '0 4px 24px rgba(0,0,0,0.35)'
    : '0 4px 20px rgba(0,0,0,0.25)';
}, { passive: true });
