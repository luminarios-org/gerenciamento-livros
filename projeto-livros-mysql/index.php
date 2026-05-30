<!DOCTYPE html>
<html lang="pt-BR" data-theme="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Luminários — Plataforma premium de gerenciamento de livros, coleções literárias e bibliotecas digitais.">
  <title>Luminários | Página Inicial</title>
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
        <!-- Botão de Login / Usuário logado (gerenciado por script.js) -->
        <div id="auth-area"></div>
      </div>
    </div>

    <nav class="nav-bar" aria-label="Navegação principal">
      <a href="index.php" class="active" aria-current="page">Página Inicial</a>
      <a href="catalogo.php">Catálogo</a>
      <a href="adicionar_livro.php">Adicionar Livro</a>
      <a href="contato.php">Contato</a>
    </nav>
  </header>

  <main>

    <!-- ========================================================
         HERO — Pesquisa
         ======================================================== -->
    <section class="hero-section" aria-label="Busca de livros">
      <div class="hero-content">
        <span class="hero-eyebrow">📖 Sua Biblioteca Digital</span>
        <h1 class="hero-title">
          Descubra, organize e explore<br>
          <em>universos literários</em>
        </h1>
        <p class="hero-subtitle">
          Milhares de títulos ao alcance dos seus olhos. Gerencie seu acervo,<br>
          encontre novos títulos e conecte-se com a literatura.
        </p>

        <form class="search-form" role="search" action="catalogo.php" method="GET">
          <span class="search-icon" aria-hidden="true">🔍</span>
          <input
            type="search"
            id="searchInput"
            name="busca"
            placeholder="Pesquisar por título, autor ou categoria..."
            aria-label="Campo de pesquisa de livros"
            autocomplete="off"
          >
          <button type="submit" class="btn-search">Pesquisar</button>
        </form>
      </div>
    </section>

    <!-- ========================================================
         SEÇÃO SOBRE
         ======================================================== -->
    <section class="about-section" aria-labelledby="sobre-titulo">
      <div class="container">
        <div class="about-card">
          <div class="about-text-content">
            <span class="section-label">Nossa Plataforma</span>
            <h2 id="sobre-titulo">Sobre a Luminários</h2>
            <hr class="about-divider">
            <p class="about-text">
              A Luminários é uma plataforma web desenvolvida para integrar o gerenciamento de livros e coleções literárias em um único sistema. Nosso objetivo é ajudar bibliotecas, instituições e leitores assíduos a terem mais organização, praticidade e eficiência no dia a dia, centralizando informações importantes de forma simples, segura e acessível. Com tecnologia moderna e intuitiva, a Luminários facilita a gestão e melhora o controle do seu acervo literário.
            </p>
          </div>
          <div class="about-stats" aria-label="Estatísticas da plataforma">
            <div class="stat-item">
              <span class="stat-number">8.4k</span>
              <span class="stat-label">Livros</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">320</span>
              <span class="stat-label">Autores</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         SEÇÃO LIVROS EM ALTA
         ======================================================== -->
    <section class="books-section" aria-labelledby="alta-titulo">
      <div class="container">
        <div class="section-header">
          <div class="section-header-text">
            <h2 id="alta-titulo">Livros em Alta</h2>
            <p>Os títulos mais acessados desta semana</p>
          </div>
          <a href="catalogo.php" class="btn-view-all">Ver Catálogo Completo →</a>
        </div>

        <div class="books-grid">

          <!-- Card 1: A Guerra dos Tronos -->
          <article class="book-card" tabindex="0" aria-label="Livro: A Guerra dos Tronos">
            <span class="book-badge">🔥 Em Alta</span>
            <div class="book-cover-wrapper">
              <img src="IMG/got.jpg" alt="Capa do livro A Guerra dos Tronos" loading="lazy">
            </div>
            <div class="book-info">
              <span class="book-genre">Fantasia Épica</span>
              <h3 class="book-title">A Guerra dos Tronos</h3>
              <p class="book-author">George R. R. Martin</p>
              <p class="book-desc">Primeiro livro da série As Crônicas de Gelo e Fogo. Uma fantasia épica sobre intrigas políticas, famílias nobres e a batalha pelo cobiçado Trono de Ferro.</p>
            </div>
          </article>

          <!-- Card 2: Dexter -->
          <article class="book-card" tabindex="0" aria-label="Livro: Dexter">
            <span class="book-badge">🔥 Em Alta</span>
            <div class="book-cover-wrapper">
              <img src="IMG/dexter.jpg" alt="Capa do livro Dexter: A Mão Esquerda de Deus" loading="lazy">
            </div>
            <div class="book-info">
              <span class="book-genre">Suspense &amp; Thriller</span>
              <h3 class="book-title">Dexter: A Mão Esquerda de Deus</h3>
              <p class="book-author">Jeff Lindsay</p>
              <p class="book-desc">Apresenta Dexter Morgan, um educado perito forense da polícia de Miami que esconde sua real face: um serial killer que extermina apenas aqueles que merecem.</p>
            </div>
          </article>

          <!-- Card 3: The Boys -->
          <article class="book-card" tabindex="0" aria-label="Livro: The Boys">
            <span class="book-badge">🔥 Em Alta</span>
            <div class="book-cover-wrapper">
              <img src="IMG/the_boys.jpg" alt="Capa do livro The Boys: O Nome do Jogo" loading="lazy">
            </div>
            <div class="book-info">
              <span class="book-genre">Ação &amp; HQ</span>
              <h3 class="book-title">The Boys: O Nome do Jogo</h3>
              <p class="book-author">Garth Ennis</p>
              <p class="book-desc">Em um universo onde super-heróis agem como celebridades irresponsáveis e corrompidas, a CIA forma um esquadrão implacável para mantê-los na linha.</p>
            </div>
          </article>

          <!-- Card 4: O Espelho de Assis -->
          <article class="book-card" tabindex="0" aria-label="Livro: O Espelho de Assis">
            <span class="book-badge">🔥 Em Alta</span>
            <div class="book-cover-wrapper">
              <img src="IMG/machado.webp" alt="Capa do livro O Espelho de Assis" loading="lazy">
            </div>
            <div class="book-info">
              <span class="book-genre">Literatura Brasileira</span>
              <h3 class="book-title">O Espelho de Assis</h3>
              <p class="book-author">Marcus Robson Costa</p>
              <p class="book-desc">Uma ficção que se alimenta da interação familiar vivenciada pelo autor, fazendo um paralelo investigativo com o enredo do clássico romance Dom Casmurro.</p>
            </div>
          </article>

        </div><!-- /books-grid -->
      </div>
    </section>

    <!-- ========================================================
         FAIXA DE ESTATÍSTICAS
         ======================================================== -->
    <section class="stats-strip" aria-label="Estatísticas da plataforma">
      <div class="container">
        <div class="strip-stat">
          <span class="strip-stat-number">8.4k+</span>
          <span class="strip-stat-label">Livros no Acervo</span>
        </div>
        <div class="strip-stat">
          <span class="strip-stat-number">320+</span>
          <span class="strip-stat-label">Autores Cadastrados</span>
        </div>
        <div class="strip-stat">
          <span class="strip-stat-number">1.2k</span>
          <span class="strip-stat-label">Leitores Ativos</span>
        </div>
        <div class="strip-stat">
          <span class="strip-stat-number">48</span>
          <span class="strip-stat-label">Categorias</span>
        </div>
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

  <!-- VLibras Plugin de Acessibilidade -->
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
