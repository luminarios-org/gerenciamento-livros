<?php
include 'conexao.php';

$erro   = '';
$sucesso = '';

// ─── INSERÇÃO COM STATUS ──────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_salvar'])) {
    $titulo = trim($_POST['titulo'] ?? '');
    $autor  = trim($_POST['autor']  ?? '');
    $status = trim($_POST['status'] ?? 'Quero Ler');

    if ($titulo === '' || $autor === '') {
        $erro = 'Preencha todos os campos antes de cadastrar.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, status) VALUES (:titulo, :autor, :status)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor',  $autor);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        header("Location: painel.php?sucesso=1");
        exit;
    }
}

// ─── EXCLUSÃO ────────────────────────────────────────────────────────────────
if (isset($_GET['excluir'])) {
    $id   = (int) $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: painel.php?deletado=1");
    exit;
}

// ─── ATUALIZAÇÃO RÁPIDA DE STATUS (NOVA AÇÃO) ──────────────────────────────────
if (isset($_GET['alterar_status']) && isset($_GET['novo_status'])) {
    $id = (int) $_GET['alterar_status'];
    $novo_status = trim($_GET['novo_status']);
    
    // Validação para aceitar apenas os status corretos
    if (in_array($novo_status, ['Quero Ler', 'Lendo', 'Finalizado'])) {
        $stmt = $pdo->prepare("UPDATE livros SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $novo_status);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: painel.php?sucesso=2");
        exit;
    }
}

if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == '1') $sucesso = 'Livro catalogado com sucesso!';
    if ($_GET['sucesso'] == '2') $sucesso = 'Progresso de leitura atualizado!';
}
if (isset($_GET['deletado'])) $sucesso = 'O livro foi removido do acervo.';

$busca = trim($_GET['busca'] ?? '');

if ($busca !== '') {
    $stmt = $pdo->prepare("SELECT * FROM livros WHERE titulo LIKE :busca OR autor LIKE :busca ORDER BY id DESC");
    $stmt->execute([':busca' => "%$busca%"]);
    $livros = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("SELECT * FROM livros ORDER BY id DESC");
    $livros = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Acervo – Luminários</title>
    <link rel="icon" type="image/png" href="IMG/fundo.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-dark:     #13293d;
            --text-dark:   #e8f1f2;
            --btn-primary: #006494;
            --secondary:   #247BA0;
            --active-info: #1b98e0;
            --card-bg:     rgba(232, 241, 242, 0.05);
            --border:      rgba(232, 241, 242, 0.12);
            --radius:      12px;
            --danger:      #ef4444;
        }

        body {
            font-family: 'Inter', sans-serif;
            /* Gradiente usando sua paleta base e variações mais escuras */
            background: linear-gradient(-45deg, #0a1722, #13293d, #0d324c, #004263);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
            padding: 20px; /* (Mantenha o padding original se houver) */
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .panel-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-dark);
        }

        .brand img {
            height: 38px;
            width: auto;
        }

        .brand h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
        }

        .btn-logout {
            color: var(--text-dark);
            opacity: 0.7;
            text-decoration: none;
            font-size: 0.95rem;
            transition: opacity 0.2s;
            font-weight: 500;
        }
        .btn-logout:hover { opacity: 1; color: var(--danger); }

        .alert {
            padding: 14px 18px;
            border-radius: var(--radius);
            margin-bottom: 24px;
            font-size: 0.95rem;
            font-weight: 500;
            border: 1px solid transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: rgba(27, 152, 224, 0.12); color: var(--text-dark); border-color: var(--active-info); }
        .alert-error { background: rgba(239, 68, 68, 0.12); color: #fff; border-color: var(--danger); }

        .main-grid {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 30px;
            align-items: start;
        }

        @media (max-width: 850px) {
            .main-grid { grid-template-columns: 1fr; }
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
        }

        .card h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.25rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            font-size: 0.85rem;
            opacity: 0.8;
            margin-bottom: 6px;
            font-weight: 500;
        }

        input[type="text"] {
            width: 100%;
            background: rgba(232, 241, 242, 0.05);
            border: 1px solid var(--border);
            padding: 12px;
            border-radius: 8px;
            color: #fff;
            font-size: 0.95rem;
            transition: border-color 0.2s;
            font-family: 'Inter', sans-serif;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: var(--active-info);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .btn-primary { background: var(--btn-primary); color: #fff; }
        .btn-primary:hover { background: var(--secondary); }
        
        .btn-danger { 
            background: rgba(239, 68, 68, 0.1); 
            color: var(--danger); 
            font-size: 0.85rem; 
            padding: 6px 12px; 
            border-radius: 6px;
            border: 1px solid rgba(239, 68, 68, 0.2);
            width: auto;
        }
        .btn-danger:hover { background: var(--danger); color: #fff; }

        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }
        .search-box input { flex: 1; }
        .search-box .btn { width: auto; padding: 0 20px; }

        .table-wrapper { overflow-x: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.95rem;
        }
        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
        }
        th {
            opacity: 0.7;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        tr:hover td { background: rgba(232, 241, 242, 0.02); }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            opacity: 0.6;
        }
        .empty-state .icon { font-size: 2.5rem; margin-bottom: 10px; }

        footer {
            margin-top: 50px;
            text-align: center;
            font-size: 0.85rem;
            opacity: 0.6;
            border-top: 1px solid var(--border);
            padding-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="panel-nav">
        <a href="index.php" class="brand">
            <img src="IMG/_Logo sem fundo.png" alt="Luminários">
            <h1>Luminários</h1>
        </a>
        <a href="index.php" class="btn-logout">🚪 Sair do Sistema</a>
    </div>

    <?php if ($erro): ?>
        <div class="alert alert-error">⚠️ <?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>
    <?php if ($sucesso): ?>
        <div class="alert alert-success">ℹ️ <?= htmlspecialchars($sucesso) ?></div>
    <?php endif; ?>

    <div class="main-grid">
        
        <div class="card">
            <h2>Novo Registro</h2>
            <form method="POST">
                    <div class="form-group">
                        <label for="titulo">Título do Livro</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Ex: O Alquimista" required>
                    </div>

                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input type="text" id="autor" name="autor" placeholder="Ex: Paulo Coelho" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status da Leitura</label>
                        <select id="status" name="status" style="width: 100%; padding: 12px; background: #006494; border: 1px solid var(--border); border-radius: 8px; color: var(--text-dark); font-family: inherit; font-size: 0.95rem; margin-top: 6px; outline: none;">
                            <option value="Quero Ler">⏳ Quero Ler</option>
                            <option value="Lendo">📖 Lendo</option>
                            <option value="Finalizado">✅ Finalizado</option>
                        </select>
                    </div>

                    <button type="submit" name="btn_salvar" class="btn btn-primary" style="margin-top: 10px;">Salvar no Acervo</button>
                </form>
        </div>

        <div class="card">
            <h2>Livros Cadastrados</h2>
            
            <form method="GET" class="search-box">
                <input 
                    type="text" 
                    name="busca" 
                    placeholder="Pesquise por título ou autor..." 
                    value="<?= htmlspecialchars($busca) ?>"
                >
                <button type="submit" class="btn btn-primary">🔍</button>
                <?php if ($busca !== ''): ?>
                    <a href="painel.php" class="btn" style="background: rgba(232, 241, 242, 0.1); color: var(--text-dark); text-decoration: none; line-height: 42px; padding: 0 15px;">Limpar</a>
                <?php endif; ?>
            </form>

            <div class="table-wrapper">
                <?php if (count($livros) > 0): ?>
                    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th style="text-align: center; width: 140px;">Status</th>
                <th style="text-align: right; width: 220px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livros as $livro): 
                // Configuração de cores das Badges baseadas no status
                $currentStatus = $livro['status'] ?? 'Quero Ler';
                $badgeStyle = 'padding: 4px 10px; border-radius: 20px; font-size: 0.78rem; font-weight: 600; display: inline-block;';
                
                if ($currentStatus === 'Finalizado') {
                    $badgeStyle .= ' background: rgba(46, 204, 113, 0.15); color: #2ecc71;';
                } elseif ($currentStatus === 'Lendo') {
                    $badgeStyle .= ' background: rgba(52, 152, 219, 0.15); color: #3498db;';
                } else {
                    $badgeStyle .= ' background: rgba(149, 165, 166, 0.2); color: #a5b1b2;';
                }
                
                // Escapa o título do livro para não quebrar o JavaScript caso tenha aspas
                $tituloEscapado = addslashes(htmlspecialchars($livro['titulo']));
            ?>
            <tr>
                <td style="font-weight: 600;"><?= htmlspecialchars($livro['titulo']) ?></td>
                <td style="color: var(--muted);"><?= htmlspecialchars($livro['autor']) ?></td>
                <td style="text-align: center;">
                    <span style="<?= $badgeStyle ?>"><?= htmlspecialchars($currentStatus) ?></span>
                </td>
                <td style="text-align: right;">
                    <div style="display: flex; gap: 6px; justify-content: flex-end; align-items: center;">
                        
                        <?php if ($currentStatus === 'Quero Ler'): ?>
                            <a href="painel.php?alterar_status=<?= $livro['id'] ?>&novo_status=Lendo" 
                               class="btn" 
                               style="background: rgba(52, 152, 219, 0.1); color: #3498db; padding: 5px 8px; font-size: 0.8rem; border-radius: 4px; text-decoration: none;" 
                               title="Começar a ler"
                               onclick="return confirm('Deseja começar a ler este livro?');">
                                📖 Ler
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($currentStatus !== 'Finalizado'): ?>
                            <a href="painel.php?alterar_status=<?= $livro['id'] ?>&novo_status=Finalizado" 
                               class="btn" 
                               style="background: rgba(46, 204, 113, 0.1); color: #2ecc71; padding: 5px 8px; font-size: 0.8rem; border-radius: 4px; text-decoration: none;" 
                               title="Marcar como Concluído"
                               onclick="return confirm('Deseja marcar este livro como finalizado?');">
                                ✅ Concluir
                            </a>
                        <?php endif; ?>

                        <a href="painel.php?excluir=<?= $livro['id'] ?>" 
                           class="btn btn-danger"
                           style="padding: 5px 8px; font-size: 0.8rem;"
                           onclick="return confirm('Deseja realmente excluir este livro? (<?= $tituloEscapado ?>)');"
                           title="Excluir livro">
                            🗑️
                        </a>
                        
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="icon">📭</div>
                        <?php if ($busca): ?>
                            <p>Nenhum resultado para <strong>"<?= htmlspecialchars($busca) ?>"</strong>.</p>
                        <?php else: ?>
                            <p>O acervo está vazio.</p>
                            <p style="margin-top:6px; font-size:.85rem;">Cadastre livros utilizando o formulário lateral.</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <footer>
        Luminários &nbsp;·&nbsp; PHP + SQLite &nbsp;·&nbsp; <?= date('Y') ?>
    </footer>

</div>

</body>
</html>