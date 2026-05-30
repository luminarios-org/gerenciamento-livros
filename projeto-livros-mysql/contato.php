<!DOCTYPE html>
<html lang="pt-BR" data-theme="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Entre em contato com a equipe da Luminários. Tire dúvidas, envie sugestões ou reporte problemas.">
  <title>Luminários | Contato</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

  <!-- ========================================================
       HEADER
       ======================================================== -->
  <header class="site-header">
    <div class="top-bar">
      <a href="index.php" class="brand-container" aria-label="Ir para página inicial">
        <img src="IMG/Logo_sem_fundo.png" alt="Logo Luminários">
        <span class="brand-title">LUMINÁRIOS</span>
      </a>
      <div class="top-actions">
        <button class="btn-toggle" onclick="toggleTheme()" aria-label="Alternar tema claro/escuro">
          <span class="theme-icon" id="theme-icon">🌙</span>
          <span id="theme-label">Modo Escuro</span>
        </button>
        <div id="auth-area"></div>
      </div>
    </div>
    <nav class="nav-bar" aria-label="Navegação principal">
      <a href="index.php">Página Inicial</a>
      <a href="catalogo.php">Catálogo</a>
      <a href="adicionar_livro.php">Adicionar Livro</a>
      <a href="contato.php" class="active" aria-current="page">Contato</a>
    </nav>
  </header>

  <main>

    <!-- ========================================================
         HERO DO CONTATO
         ======================================================== -->
    <section class="contact-hero" aria-label="Cabeçalho da página de contato">
      <div class="contact-hero-content">
        <span class="hero-eyebrow">✉️ Fale Conosco</span>
        <h1>Entre em Contato</h1>
        <p>
          Tem alguma dúvida, sugestão ou quer nos ajudar a melhorar?<br>
          Nossa equipe está pronta para te ouvir.
        </p>
      </div>
    </section>

    <!-- ========================================================
         LAYOUT CONTATO: Formulário + Sidebar
         ======================================================== -->
    <section class="contact-page-main" aria-labelledby="contato-titulo">
      <div class="contact-layout">

        <!-- Formulário Principal -->
        <div class="contact-form-card">
          <span class="section-label">Enviar Mensagem</span>
          <h2 class="card-title" id="contato-titulo">Como podemos ajudar?</h2>
          <p class="card-subtitle">Preencha o formulário abaixo e responderemos em até 48 horas úteis.</p>
          <hr class="contact-divider">

          <form class="contact-form" onsubmit="handleContactSubmit(event)" novalidate>

            <div class="form-row">
              <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required autocomplete="name">
              </div>
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="exemplo@email.com" required autocomplete="email">
              </div>
            </div>

            <div class="form-group">
              <label for="assunto">Assunto</label>
              <select id="assunto" name="assunto" required>
                <option value="" disabled selected>Selecione um assunto...</option>
                <option value="duvida">💬 Dúvida sobre a plataforma</option>
                <option value="sugestao">💡 Sugestão de funcionalidade</option>
                <option value="feedback">⭐ Feedback geral</option>
                <option value="problema">🐛 Relatar um problema / Bug</option>
                <option value="parceria">🤝 Proposta de parceria</option>
                <option value="outro">📌 Outro</option>
              </select>
            </div>

            <div class="form-group">
              <label for="mensagem">Sua Mensagem</label>
              <textarea
                id="mensagem"
                name="mensagem"
                placeholder="Descreva sua dúvida, sugestão ou feedback com o máximo de detalhes possível..."
                required
                aria-describedby="mensagem-hint"
              ></textarea>
              <small id="mensagem-hint" style="font-size:0.78rem; opacity:0.5; margin-top:4px;">Mínimo de 20 caracteres.</small>
            </div>

            <button type="submit" class="btn-submit">
              <span>✉️</span>
              Enviar Mensagem
            </button>

          </form>
        </div>

        <!-- Sidebar de Informações -->
        <aside class="contact-sidebar" aria-label="Informações de contato">

          <div class="contact-info-card">
            <div class="info-icon" aria-hidden="true">📧</div>
            <h3>E-mail</h3>
            <p>Para dúvidas e suporte técnico, entre em contato diretamente:</p>
            <a href="mailto:contato@luminarios.com.br" style="margin-top:8px; display:inline-block;">
              contato@luminarios.com.br
            </a>
          </div>

          <div class="contact-info-card">
            <div class="info-icon" aria-hidden="true">📍</div>
            <h3>Localização</h3>
            <p>Plataforma 100% online — atendemos em todo o Brasil.</p>
          </div>

          <div class="contact-info-card">
            <div class="info-icon" aria-hidden="true">🕐</div>
            <h3>Horário de Atendimento</h3>
            <ul class="hours-list" aria-label="Horários de atendimento">
              <li class="hours-item">
                <span class="hours-day">Segunda — Sexta</span>
                <span class="hours-time">9h — 18h</span>
              </li>
              <li class="hours-item">
                <span class="hours-day">Sábado</span>
                <span class="hours-time">9h — 13h</span>
              </li>
              <li class="hours-item">
                <span class="hours-day">Domingo</span>
                <span class="hours-time">Fechado</span>
              </li>
            </ul>
          </div>

          <div class="faq-card">
            <h3>Perguntas Frequentes</h3>

            <details class="faq-item">
              <summary class="faq-question">O sistema é gratuito?</summary>
              <p class="faq-answer">Sim! A Luminários oferece um plano gratuito com acesso ao catálogo e gerenciamento básico. Planos premium estão em desenvolvimento.</p>
            </details>

            <details class="faq-item">
              <summary class="faq-question">Posso cadastrar minha biblioteca?</summary>
              <p class="faq-answer">Absolutamente. O sistema suporta múltiplos perfis — leitores individuais, bibliotecas públicas e instituições educacionais.</p>
            </details>

            <details class="faq-item">
              <summary class="faq-question">Os dados são seguros?</summary>
              <p class="faq-answer">Sim. Utilizamos criptografia e seguimos as diretrizes da LGPD para garantir a privacidade e segurança dos seus dados.</p>
            </details>

          </div>

        </aside>
      </div>
    </section>

  </main>

  <!-- ========================================================
       FOOTER
       ======================================================== -->
  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-minimal">
        <p>© 2024 Luminários. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>

  <!-- VLibras -->
  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>
  <script src="JS/script.js"></script>
</body>
</html>
