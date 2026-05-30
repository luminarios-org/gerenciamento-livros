<?php
/**
 * Luminários — Adicionar Livro
 * Insere novo registro em livros_mysql usando prepare() + bindParam().
 */
require_once 'config.php';

$erros   = [];
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ── Sanitização ──────────────────────────────────────────── */
    $titulo    = trim($_POST['titulo']    ?? '');
    $autor     = trim($_POST['autor']     ?? '');
    $genero    = trim($_POST['genero']    ?? '');
    $ano       = trim($_POST['ano']       ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    $allowedGeneros = ['fantasia','thriller','acao','literatura','romance','ciencia','biografia','outro'];

    /* ── Validação ────────────────────────────────────────────── */
    if ($titulo === '')                                      $erros[] = 'O título é obrigatório.';
    elseif (mb_strlen($titulo) > 100)                       $erros[] = 'O título deve ter no máximo 100 caracteres.';

    if ($autor === '')                                       $erros[] = 'O autor é obrigatório.';
    elseif (mb_strlen($autor) > 100)                        $erros[] = 'O autor deve ter no máximo 100 caracteres.';

    if (!in_array($genero, $allowedGeneros, true))          $erros[] = 'Selecione um gênero válido.';
    if ($descricao === '')                                   $erros[] = 'A descrição é obrigatória.';

    $anoInt = null;
    if ($ano !== '') {
        $anoInt = (int)$ano;
        if ($anoInt < 1000 || $anoInt > 2099)               $erros[] = 'O ano deve estar entre 1000 e 2099.';
    }

    /* ── INSERT com prepare() + bindParam() ───────────────────── */
    if (empty($erros)) {
        $stmt = $pdo->prepare(
            "INSERT INTO livros_mysql (titulo, autor, genero, ano, descricao)
             VALUES (:titulo, :autor, :genero, :ano, :descricao)"
        );
        $stmt->bindParam(':titulo',    $titulo,    PDO::PARAM_STR);
        $stmt->bindParam(':autor',     $autor,     PDO::PARAM_STR);
        $stmt->bindParam(':genero',    $genero,    PDO::PARAM_STR);
        $stmt->bindParam(':ano',       $anoInt,    PDO::PARAM_INT);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->execute();
        $sucesso = true;
    }
}

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
  <meta name="description" content="Adicione novos livros ao acervo da Luminários.">
  <title>Luminários | Adicionar Livro</title>
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
      <a href="adicionar_livro.php" class="active" aria-current="page">Adicionar Livro</a>
      <a href="contato.php">Contato</a>
    </nav>
  </header>

  <main>

    <!-- HERO -->
    <section class="contact-hero" aria-label="Adicionar Livro">
      <div class="contact-hero-content">
        <span class="hero-eyebrow">📚 Acervo</span>
        <h1>Adicionar Livro</h1>
        <p>Cadastre um novo título no acervo da Luminários.</p>
      </div>
    </section>

    <!-- FORMULÁRIO -->
    <section class="contact-page-main" aria-labelledby="adicionar-titulo">
      <div class="contact-layout" style="grid-template-columns:1fr; max-width:700px; margin:0 auto;">
        <div class="contact-form-card">

          <span class="section-label">Novo Título</span>
          <h2 class="card-title" id="adicionar-titulo">Informações do Livro</h2>
          <p class="card-subtitle">Preencha os dados abaixo para cadastrar o livro no sistema.</p>
          <hr class="contact-divider">

          <?php if ($sucesso): ?>
            <div class="alert alert-success" role="alert" aria-live="polite">
              ✅ Livro cadastrado com sucesso no banco de dados!
              <a href="catalogo.php">Ver no catálogo →</a>
            </div>
          <?php endif; ?>

          <?php if (!empty($erros)): ?>
            <div class="alert alert-error" role="alert" aria-live="polite">
              <strong>⚠️ Corrija os erros abaixo:</strong>
              <ul style="margin-top:8px; padding-left:20px;">
                <?php foreach ($erros as $e): ?>
                  <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form class="contact-form" method="POST" action="adicionar_livro.php" novalidate>

            <div class="form-row">
              <div class="form-group">
                <label for="titulo">Título <span style="color:#e53935;" aria-hidden="true">*</span></label>
                <input type="text" id="titulo" name="titulo" placeholder="Título do livro"
                  value="<?= htmlspecialchars($_POST['titulo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                  required maxlength="100">
              </div>
              <div class="form-group">
                <label for="autor">Autor <span style="color:#e53935;" aria-hidden="true">*</span></label>
                <input type="text" id="autor" name="autor" placeholder="Nome do autor"
                  value="<?= htmlspecialchars($_POST['autor'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                  required maxlength="100">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="genero">Gênero <span style="color:#e53935;" aria-hidden="true">*</span></label>
                <select id="genero" name="genero" required>
                  <option value="" disabled <?= empty($_POST['genero']) ? 'selected' : '' ?>>Selecione um gênero...</option>
                  <?php foreach ($generoLabels as $val => $label): ?>
                    <option value="<?= $val ?>" <?= (($_POST['genero'] ?? '') === $val) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="ano">Ano de Publicação</label>
                <input type="number" id="ano" name="ano" placeholder="Ex: 2023" min="1000" max="2099"
                  value="<?= htmlspecialchars($_POST['ano'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="descricao">Descrição <span style="color:#e53935;" aria-hidden="true">*</span></label>
              <textarea id="descricao" name="descricao" placeholder="Breve descrição do livro..." required
              ><?= htmlspecialchars($_POST['descricao'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <button type="submit" class="btn-submit">
              <span>📚</span> Cadastrar Livro
            </button>

          </form>
        </div>
      </div>
    </section>

  </main>

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
