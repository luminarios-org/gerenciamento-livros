<?php
/**
 * Luminários — Catálogo de Livros
 * Banco: biblioteca_mysql_db | Tabela: livros_mysql
 * Funcionalidades: listagem, busca (LIKE), exclusão segura (Prepared Statements)
 */
require_once 'config.php';

/* ── EXCLUSÃO SEGURA (GET ?excluir=id) ───────────────────────── */
if (isset($_GET['excluir'])) {
    $id   = (int)$_GET['excluir'];           // cast para int — camada extra de segurança
    $stmt = $pdo->prepare("DELETE FROM livros_mysql WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: catalogo.php");
    exit;
}

/* ── BUSCA + LISTAGEM ─────────────────────────────────────────── */
$busca  = isset($_GET['busca'])  ? trim($_GET['busca'])  : '';
$genero = isset($_GET['genero']) ? trim($_GET['genero']) : '';
$ordem  = isset($_GET['ordem'])  ? trim($_GET['ordem'])  : 'recente';

$allowedOrdens  = ['recente','titulo_asc','titulo_desc','autor_asc'];
$allowedGeneros = ['fantasia','thriller','acao','literatura','romance','ciencia','biografia','outro'];
if (!in_array($ordem,  $allowedOrdens,  true)) $ordem  = 'recente';
if ($genero !== '' && !in_array($genero, $allowedGeneros, true)) $genero = '';

/* Monta cláusula WHERE dinâmica */
$where  = [];
$params = [];

if ($busca !== '') {
    $where[]           = '(titulo LIKE :busca OR autor LIKE :busca2)';
    $params[':busca']  = '%' . $busca . '%';
    $params[':busca2'] = '%' . $busca . '%';
}
if ($genero !== '') {
    $where[]           = 'genero = :genero';
    $params[':genero'] = $genero;
}

$whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$orderMap = [
    'recente'     => 'criado_em DESC',
    'titulo_asc'  => 'titulo ASC',
    'titulo_desc' => 'titulo DESC',
    'autor_asc'   => 'autor ASC',
];

$query = "SELECT * FROM livros_mysql {$whereClause} ORDER BY {$orderMap[$ordem]}";
$stmt  = $pdo->prepare($query);
$stmt->execute($params);
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ── Contagem total (para o badge) ───────────────────────────── */
$totalStmt = $pdo->query("SELECT COUNT(*) FROM livros_mysql");
$totalLivros = (int)$totalStmt->fetchColumn();

/* ── Rótulos de gênero ────────────────────────────────────────── */
$generoLabels = [
    'fantasia'   => 'Fantasia Épica',
    'thriller'   => 'Suspense & Thriller',
    'acao'       => 'Ação & HQ',
    'literatura' => 'Literatura Brasileira',
    'romance'    => 'Romance',
    'ciencia'    => 'Ficção Científica',
    'biografia'  => 'Biografia',
    'outro'      => 'Outro',
];
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Catálogo completo de livros da Luminários. Pesquise, filtre e gerencie o acervo.">
  <title>Luminários | Catálogo</title>
  <link rel="stylesheet" href="CSS/style.css">
  <style>
    /* ── Estilos específicos do Catálogo v2 ─────────────────── */

    /* Badge de total */
    .catalog-total-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: linear-gradient(135deg, var(--btn-primary), var(--el-secondary));
      color: #fff;
      font-size: 0.78rem;
      font-weight: 800;
      letter-spacing: 0.5px;
      padding: 5px 14px;
      border-radius: 50px;
      margin-left: 12px;
      vertical-align: middle;
    }

    /* Card de livro — versão catálogo com ações */
    .book-card-catalog {
      position: relative;
      background: var(--card-bg);
      border-radius: var(--radius-md);
      overflow: hidden;
      border: 1px solid var(--border-subtle);
      transition: transform var(--transition-med), box-shadow var(--transition-med);
      display: flex;
      flex-direction: column;
    }
    .book-card-catalog:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-md);
    }

    /* Área de capa */
    .book-card-catalog .book-cover-wrapper {
      width: 100%;
      height: 220px;
      overflow: hidden;
      background: linear-gradient(135deg, var(--header-top-bg), var(--btn-primary));
      flex-shrink: 0;
    }
    .book-card-catalog .book-cover-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
      display: block;
    }
    .book-card-catalog:hover .book-cover-wrapper img {
      transform: scale(1.05);
    }
    .book-cover-placeholder {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 4rem;
      opacity: 0.25;
    }

    /* Info do card */
    .book-card-catalog .book-info {
      padding: 18px 20px 14px;
      display: flex;
      flex-direction: column;
      gap: 4px;
      flex: 1;
    }
    .book-card-catalog .book-genre {
      font-size: 0.7rem;
      font-weight: 800;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--status-active);
      opacity: 0.85;
    }
    .book-card-catalog .book-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.05rem;
      font-weight: 700;
      line-height: 1.3;
      margin: 2px 0;
    }
    .book-card-catalog .book-author {
      font-size: 0.82rem;
      opacity: 0.55;
      font-style: italic;
    }
    .book-card-catalog .book-year {
      font-size: 0.72rem;
      font-weight: 600;
      opacity: 0.35;
      letter-spacing: 1px;
      margin-top: 2px;
    }
    .book-card-catalog .book-desc {
      font-size: 0.82rem;
      line-height: 1.55;
      opacity: 0.65;
      margin-top: 6px;
      flex: 1;
    }

    /* Barra de ações no rodapé do card */
    .card-actions {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 20px 16px;
      border-top: 1px solid var(--border-subtle);
      gap: 10px;
    }
    .card-id-badge {
      font-size: 0.7rem;
      font-weight: 700;
      opacity: 0.35;
      letter-spacing: 0.5px;
    }
    .btn-delete {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      background: transparent;
      color: var(--btn-login-bg);
      border: 1.5px solid rgba(201,48,44,0.3);
      padding: 6px 14px;
      border-radius: 50px;
      font-family: 'Nunito Sans', sans-serif;
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.3px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s ease;
    }
    .btn-delete:hover {
      background: var(--btn-login-bg);
      border-color: var(--btn-login-bg);
      color: #fff;
      transform: scale(1.03);
    }

    /* Empty state */
    .empty-state {
      text-align: center;
      padding: 80px 20px;
      grid-column: 1 / -1;
    }
    .empty-icon { display: block; font-size: 4rem; margin-bottom: 20px; }
    .empty-state h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem;
      font-weight: 700;
      margin-bottom: 12px;
    }
    .empty-state p { font-size: 0.9rem; opacity: 0.6; }
    .empty-state a { color: var(--status-active); font-weight: 700; text-decoration: underline; }

    /* Alert */
    .alert { padding:14px 18px; border-radius: var(--radius-sm); font-size:0.9rem; font-weight:600; margin-bottom:24px; }
    .alert-success { background:rgba(34,197,94,0.1); border:1.5px solid rgba(34,197,94,0.3); color:#166534; }
    .alert-error   { background:rgba(239,68,68,0.08); border:1.5px solid rgba(239,68,68,0.25); color:#991b1b; }
    [data-theme="dark"] .alert-success { color:#86efac; }
    [data-theme="dark"] .alert-error   { color:#fca5a5; }

    /* Filtros */
    .catalog-filters-section { padding: 32px 5% 8px; }
    .catalog-filter-form {
      display: flex;
      flex-wrap: wrap;
      align-items: flex-end;
      gap: 16px;
      background: var(--card-bg);
      border-radius: var(--radius-md);
      padding: 24px 28px;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--border-subtle);
    }
    .filter-group { display:flex; flex-direction:column; gap:6px; flex:1; min-width:160px; }
    .filter-group label { font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; opacity:0.6; }
    .search-input-wrapper { position:relative; display:flex; align-items:center; }
    .search-input-wrapper .filter-icon { position:absolute; left:14px; font-size:0.95rem; pointer-events:none; opacity:0.5; }
    .search-input-wrapper input { padding-left:40px !important; flex:1; }
    .catalog-filter-form input,
    .catalog-filter-form select {
      width:100%; padding:11px 14px;
      border:1.5px solid var(--border-subtle);
      border-radius:var(--radius-sm);
      background:var(--bg-color);
      color:var(--text-color);
      font-family:'Nunito Sans',sans-serif;
      font-size:0.9rem;
      outline:none;
      transition:border-color .2s, box-shadow .2s;
      -webkit-appearance:none; appearance:none;
    }
    .catalog-filter-form select {
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23247BA0' stroke-width='2' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
      background-repeat:no-repeat;
      background-position:right 14px center;
      padding-right:38px;
    }
    .catalog-filter-form input:focus,
    .catalog-filter-form select:focus { border-color:var(--status-active); box-shadow:0 0 0 3px rgba(27,152,224,0.12); }
    .btn-filter {
      background:linear-gradient(135deg,var(--btn-primary),var(--el-secondary));
      color:#fff; padding:11px 28px;
      border-radius:var(--radius-sm);
      font-family:'Nunito Sans',sans-serif; font-size:0.875rem; font-weight:700;
      letter-spacing:0.5px; border:none; cursor:pointer;
      transition:all .2s; box-shadow:0 3px 12px rgba(0,100,148,.35);
      align-self:flex-end; white-space:nowrap;
    }
    .btn-filter:hover { transform:translateY(-1px); box-shadow:0 6px 18px rgba(0,100,148,.5); }
    .btn-clear-filter {
      align-self:flex-end; font-size:0.82rem; font-weight:700;
      color:var(--btn-login-bg); opacity:0.75;
      padding:11px 14px; border-radius:var(--radius-sm);
      transition:opacity .2s; white-space:nowrap;
      border:1.5px solid rgba(201,48,44,.3);
    }
    .btn-clear-filter:hover { opacity:1; }
    .filter-result-info { margin-top:16px; font-size:0.875rem; opacity:0.65; padding:0 4px; }
    .filter-result-info strong { opacity:1; font-weight:700; color:var(--status-active); }

    /* Sessão */
    .user-session { display:flex; align-items:center; gap:10px; }
    .user-greeting { color:var(--header-text); font-size:0.875rem; font-weight:700; white-space:nowrap; max-width:200px; overflow:hidden; text-overflow:ellipsis; }
    .btn-logout { background:transparent; color:rgba(232,241,242,.75); border:1px solid rgba(232,241,242,.3); padding:7px 14px; border-radius:var(--radius-sm); font-family:'Nunito Sans',sans-serif; font-size:0.8rem; font-weight:700; cursor:pointer; transition:all .2s; white-space:nowrap; }
    .btn-logout:hover { background:rgba(201,48,44,.2); border-color:var(--btn-login-bg); color:#fff; }
    .btn-view-all { display:inline-flex; align-items:center; gap:6px; color:var(--status-active); font-size:0.875rem; font-weight:700; border-bottom:2px solid transparent; padding-bottom:2px; transition:border-color .2s,color .2s; white-space:nowrap; }
    .btn-view-all:hover { border-color:var(--status-active); }

    @media (max-width:768px) {
      .catalog-filter-form { flex-direction:column; padding:20px; }
      .filter-group { min-width:unset; width:100%; }
      .btn-filter,.btn-clear-filter { width:100%; text-align:center; }
    }
  </style>
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
      <a href="catalogo.php" class="active" aria-current="page">Catálogo</a>
      <a href="adicionar_livro.php">Adicionar Livro</a>
      <a href="contato.php">Contato</a>
    </nav>
  </header>

  <main>

    <!-- HERO -->
    <section class="contact-hero" aria-label="Catálogo de Livros">
      <div class="contact-hero-content">
        <span class="hero-eyebrow">📚 Acervo</span>
        <h1>
          Catálogo de Livros
          <span class="catalog-total-badge" aria-label="Total de livros">
            <?= $totalLivros ?> título<?= $totalLivros !== 1 ? 's' : '' ?>
          </span>
        </h1>
        <p>Explore, pesquise, filtre e gerencie todos os títulos do acervo.</p>
      </div>
    </section>

    <!-- FILTROS -->
    <section class="catalog-filters-section" aria-label="Filtros de busca">
      <div class="container">
        <form class="catalog-filter-form" method="GET" action="catalogo.php" role="search">

          <div class="filter-group">
            <label for="busca-input">Pesquisar</label>
            <div class="search-input-wrapper">
              <span class="filter-icon">🔍</span>
              <input type="search" id="busca-input" name="busca"
                placeholder="Título ou autor..."
                value="<?= htmlspecialchars($busca, ENT_QUOTES, 'UTF-8') ?>"
                autocomplete="off">
            </div>
          </div>

          <div class="filter-group">
            <label for="genero-select">Gênero</label>
            <select id="genero-select" name="genero">
              <option value="">Todos os gêneros</option>
              <?php foreach ($generoLabels as $val => $lbl): ?>
                <option value="<?= $val ?>" <?= $genero === $val ? 'selected' : '' ?>>
                  <?= htmlspecialchars($lbl, ENT_QUOTES, 'UTF-8') ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="filter-group">
            <label for="ordem-select">Ordenar por</label>
            <select id="ordem-select" name="ordem">
              <option value="recente"     <?= $ordem === 'recente'     ? 'selected' : '' ?>>Mais recente</option>
              <option value="titulo_asc"  <?= $ordem === 'titulo_asc'  ? 'selected' : '' ?>>Título A–Z</option>
              <option value="titulo_desc" <?= $ordem === 'titulo_desc' ? 'selected' : '' ?>>Título Z–A</option>
              <option value="autor_asc"   <?= $ordem === 'autor_asc'   ? 'selected' : '' ?>>Autor A–Z</option>
            </select>
          </div>

          <button type="submit" class="btn-filter">Filtrar</button>

          <?php if ($busca !== '' || $genero !== ''): ?>
            <a href="catalogo.php" class="btn-clear-filter">✕ Limpar</a>
          <?php endif; ?>

        </form>

        <?php if ($busca !== '' || $genero !== ''): ?>
          <p class="filter-result-info">
            <strong><?= count($livros) ?></strong> resultado(s)
            <?= $busca  !== '' ? ' para "<strong>' . htmlspecialchars($busca, ENT_QUOTES, 'UTF-8') . '</strong>"' : '' ?>
            <?= $genero !== '' ? ' em <strong>' . htmlspecialchars($generoLabels[$genero] ?? $genero, ENT_QUOTES, 'UTF-8') . '</strong>' : '' ?>
          </p>
        <?php endif; ?>
      </div>
    </section>

    <!-- GRADE DE LIVROS -->
    <section class="books-section" aria-labelledby="catalogo-grid-titulo">
      <div class="container">

        <div class="section-header" style="margin-bottom:28px;">
          <div class="section-header-text">
            <h2 id="catalogo-grid-titulo">
              <?= ($busca !== '' || $genero !== '') ? 'Resultados da busca' : 'Todos os títulos' ?>
            </h2>
            <p><?= count($livros) ?> livro(s) exibido(s)</p>
          </div>
          <a href="adicionar_livro.php" class="btn-view-all">+ Adicionar novo livro</a>
        </div>

        <?php if (empty($livros)): ?>
          <div class="empty-state" role="status">
            <span class="empty-icon">📭</span>
            <h3>Nenhum livro encontrado</h3>
            <p>
              <?php if ($busca !== '' || $genero !== ''): ?>
                Tente outros termos ou <a href="catalogo.php">veja todos os títulos</a>.
              <?php else: ?>
                O acervo está vazio. <a href="adicionar_livro.php">Adicione o primeiro livro</a>.
              <?php endif; ?>
            </p>
          </div>
        <?php else: ?>

          <div class="books-grid">
            <?php foreach ($livros as $livro): ?>
              <?php
                $tituloEsc  = htmlspecialchars($livro['titulo'],  ENT_QUOTES, 'UTF-8');
                $autorEsc   = htmlspecialchars($livro['autor'],   ENT_QUOTES, 'UTF-8');
                $generoEsc  = htmlspecialchars($generoLabels[$livro['genero']] ?? ucfirst($livro['genero']), ENT_QUOTES, 'UTF-8');
                $descTrunc  = mb_strlen($livro['descricao'] ?? '') > 130
                              ? mb_substr($livro['descricao'], 0, 130) . '…'
                              : ($livro['descricao'] ?? '');
              ?>
              <article class="book-card-catalog" tabindex="0" aria-label="Livro: <?= $tituloEsc ?>">

                <div class="book-cover-wrapper">
                  <?php if (!empty($livro['capa_url'])): ?>
                    <img src="<?= htmlspecialchars($livro['capa_url'], ENT_QUOTES, 'UTF-8') ?>"
                         alt="Capa: <?= $tituloEsc ?>" loading="lazy">
                  <?php else: ?>
                    <div class="book-cover-placeholder" aria-hidden="true">📖</div>
                  <?php endif; ?>
                </div>

                <div class="book-info">
                  <span class="book-genre"><?= $generoEsc ?></span>
                  <h3 class="book-title"><?= $tituloEsc ?></h3>
                  <p class="book-author"><?= $autorEsc ?></p>
                  <?php if (!empty($livro['ano'])): ?>
                    <p class="book-year"><?= (int)$livro['ano'] ?></p>
                  <?php endif; ?>
                  <?php if ($descTrunc !== ''): ?>
                    <p class="book-desc"><?= htmlspecialchars($descTrunc, ENT_QUOTES, 'UTF-8') ?></p>
                  <?php endif; ?>
                </div>

                <!-- Ações do card: ID + Botão Excluir -->
                <div class="card-actions">
                  <span class="card-id-badge">#<?= (int)$livro['id'] ?></span>
                  <a href="catalogo.php?excluir=<?= (int)$livro['id'] ?>"
                     class="btn-delete"
                     role="button"
                     aria-label="Excluir livro <?= $tituloEsc ?>"
                     onclick="return confirm('Tem certeza que deseja excluir o livro \'<?= addslashes($tituloEsc) ?>\'?\n\nEsta ação não pode ser desfeita.')">
                    🗑️ Excluir
                  </a>
                </div>

              </article>
            <?php endforeach; ?>
          </div>

        <?php endif; ?>

      </div>
    </section>

  </main>

  <!-- FOOTER -->
  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-minimal">
        <p>© 2024 Luminários. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>

  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper><div class="vw-plugin-top-wrapper"></div></div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>
  <script src="JS/script.js"></script>
</body>
</html>
