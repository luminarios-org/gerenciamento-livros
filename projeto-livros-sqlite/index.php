<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luminários – Bem-vindo</title>
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
            --card-bg:     rgba(232, 241, 242, 0.06);
            --border:      rgba(232, 241, 242, 0.15);
            --radius:      12px;
        }

        html { scroll-behavior: smooth; }

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

        .page {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 0;
            border-bottom: 1px solid var(--border);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-dark);
        }

        .logo img {
            height: 42px;
            width: auto;
        }

        .logo-text {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .btn-primary-action {
            background-color: var(--btn-primary);
            color: #ffffff;
            padding: 12px 24px;
            border-radius: var(--radius);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary-action:hover {
            background-color: var(--secondary);
            transform: translateY(-1px);
        }

        .hero-section {
            padding: 100px 0 80px 0;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-section h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 3.5rem;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -1.5px;
            margin-bottom: 24px;
            color: var(--text-dark);
        }

        .hero-section p {
            font-size: 1.25rem;
            color: var(--text-dark);
            opacity: 0.8;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 80px;
        }

        .feature-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            padding: 32px;
            border-radius: var(--radius);
            transition: all 0.2s ease;
        }

        .feature-card:hover {
            border-color: var(--active-info);
            transform: translateY(-2px);
        }

        .feature-card .icon {
            font-size: 2rem;
            margin-bottom: 16px;
            color: var(--active-info);
            display: inline-block;
        }

        .feature-card h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.3rem;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .feature-card p {
            opacity: 0.75;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .cta-section {
            margin-bottom: 80px;
        }

        .cta-box {
            background: linear-gradient(135deg, rgba(0, 100, 148, 0.15), rgba(36, 123, 160, 0.08));
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 50px 40px;
            text-align: center;
        }

        .cta-box h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2rem;
            margin-bottom: 16px;
        }

        .cta-box p {
            opacity: 0.8;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        footer {
            border-top: 1px solid var(--border);
            padding: 40px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            opacity: 0.8;
            font-size: 0.95rem;
        }

        footer a {
            color: var(--active-info);
            text-decoration: none;
            font-weight: 500;
        }
        footer a:hover { text-decoration: underline; }

        @media (max-width: 768px) {
            .hero-section h1 { font-size: 2.5rem; }
            footer { flex-direction: column; gap: 16px; text-align: center; }
        }
    </style>
</head>
<body>

<div class="page">
    
    <header>
        <a href="index.php" class="logo">
            <img src="IMG/_Logo sem fundo.png" alt="Logo Luminários">
            <span class="logo-text">Luminários</span>
        </a>
        <a href="login.php" class="btn-primary-action">Acessar Sistema →</a>
    </header>

    <section class="hero-section">
        <h1>Gerencie sua biblioteca de forma inteligente</h1>
        <p>
            Pesquise títulos, monte sua lista de desejos e organize suas leituras em um só lugar. 
            Desenvolvido sob medida para leitores exigentes.
        </p>
        <a href="login.php" class="btn-primary-action" style="font-size: 1.1rem; padding: 14px 36px;">
            🚀 Começar Agora Grátis
        </a>
    </section>

    <section class="features-grid">
        <div class="feature-card">
            <div class="icon">⚡</div>
            <h3>Agilidade com SQLite</h3>
            <p>Banco de dados local ultra-rápido incorporado diretamente na aplicação. Sem lentidão ou configurações complexas.</p>
        </div>
        <div class="feature-card">
            <div class="icon">🔍</div>
            <h3>Busca Avançada</h3>
            <p>Filtre livros instantaneamente por título ou autor. Ache o que procura sem perder tempo navegando por menus.</p>
        </div>
        <div class="feature-card">
            <div class="icon">🛠️</div>
            <h3>CRUD Completo</h3>
            <p>Cadastre novos títulos, veja a lista atualizada em tempo real e remova volumes com segurança através de alertas visuais.</p>
        </div>
    </section>

    <section class="cta-section">
        <div class="cta-box">
            <h2>Pronto para organizar seus livros? 📚</h2>
            <p>
                Não precisa instalar nada. Não precisa criar conta em redes sociais.
                É só entrar e começar.
            </p>
            <a href="login.php" class="btn-primary-action">
                🚀 Acessar minha biblioteca
            </a>
        </div>
    </section>

    <footer>
    <div>
        "Atividade com Fins Acadêmicos"
    </div>
    
    <span>Grupo: Kauan Barboza, Kauã Everton, Luan,<br> Hyago, Felipe, Riquelme, Nicolas</span><br>
    <span>📚 Luminários &mdash; <?= date('Y') ?></span><br>
    <span>Feito com PHP + SQLite &nbsp;·&nbsp; <a href="painel.php">Ir direto ao acervo</a></span>
</footer>

</div>

</body>
</html>