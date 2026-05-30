<?php
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha   = trim($_POST['senha']   ?? '');

    if ($usuario === 'leitor' && $senha === '1234') {
        header("Location: painel.php?sucesso=bem_vindo");
        exit;
    } else {
        $erro = 'Usuário ou senha incorretos. Tente: leitor / 1234';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar – Luminários</title>
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
            --radius:      16px;
            --danger:      #ef4444;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .card-header img {
            height: 80px; /* Aumentado de 52px para dar bastante destaque */
            width: auto;
            margin-bottom: 16px;
        }

        .card-header h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2rem; /* Aumentado sutilmente para acompanhar a logo */
            font-weight: 800;
            margin-bottom: 6px;
        }

        .card-header p {
            opacity: 0.7;
            font-size: 0.95rem;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            color: #ff8888;
            border: 1px solid var(--danger);
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 0.85rem;
            opacity: 0.8;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            background: rgba(232, 241, 242, 0.05);
            border: 1px solid var(--border);
            padding: 12px 16px;
            border-radius: 8px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: var(--active-info);
        }

        .btn-login {
            width: 100%;
            background: var(--btn-primary);
            color: #fff;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
            font-family: 'Inter', sans-serif;
        }

        .btn-login:hover { background: var(--secondary); }

        .demo-hint {
            background: rgba(232, 241, 242, 0.02);
            border: 1px dashed var(--border);
            padding: 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-top: 24px;
            opacity: 0.7;
            line-height: 1.4;
        }

        .demo-hint strong { color: #fff; }

        .card-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            opacity: 0.7;
        }

        .card-footer a {
            color: var(--active-info);
            text-decoration: none;
            font-weight: 500;
        }
        .card-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="login-card">

    <div class="card-header">
        <img src="IMG/_Logo sem fundo.png" alt="Logo Luminários">
        <h1>Luminários</h1>
        <p>Entre para acessar seu acervo pessoal</p>
    </div>

    <?php if ($erro): ?>
    <div class="alert-error">
        ⚠️ <?= htmlspecialchars($erro) ?>
    </div>
    <?php endif; ?>

    <form method="POST" novalidate>
        <div class="form-group">
            <label for="usuario">Usuário</label>
            <input
                type="text"
                id="usuario"
                name="usuario"
                placeholder="Digite seu usuário"
                value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>"
                autocomplete="username"
                required
            >
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input
                type="password"
                id="senha"
                name="senha"
                placeholder="Digite sua senha"
                autocomplete="current-password"
                required
            >
        </div>
        <button type="submit" class="btn-login">Entrar na biblioteca →</button>
    </form>

    <div class="demo-hint">
        ℹ️ <strong>Acesso demonstração:</strong><br>
        Usuário: <strong>leitor</strong> &nbsp;·&nbsp; Senha: <strong>1234</strong>
    </div>

    <div class="card-footer">
        Ainda sem conta? <a href="index.php">Saiba mais sobre o sistema</a>
    </div>

</div>

</body>
</html>