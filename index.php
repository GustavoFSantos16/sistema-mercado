<?php
// Página restrita.
session_start();

// Verifica se o usuário está logado.
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27><text y=%27.9em%27 font-size=%2790%27>🛍️</text></svg>">
    <link rel="stylesheet" href="styles.css">
    <title>Sistema Mercado</title>
</head>

<body>
    <div class="topbar">
        <a href="logout.php">Logout</a>
    </div>
    <main class="menu-page">
        <div class="menu-heading">
            <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
            <p>Menu Principal - Sistema de Mercado</p>
        </div>

    <div class="menu-grid">

        <div class="menu-card">
            <a href="cadastro-produto.php">
                <div class="menu-card-icon">📝</div> <!-- ícone grande -->
                <div class="menu-card-title">Cadastrar Produtos</div> <!-- título -->
                <div class="menu-card-desc">Cadastre novos produtos</div> <!-- descrição -->
            </a>
        </div>

        <div class="menu-card">
            <a href="listagem-produtos.php">
                <div class="menu-card-icon">📋</div>
                <div class="menu-card-title">Estoque de produtos</div>
                <div class="menu-card-desc">Visualize o estoque disponível</div>
            </a>
        </div>

        <div class="menu-card">
            <a href="venda-produto.php">
                <div class="menu-card-icon">🛒</div>
                <div class="menu-card-title">Venda de produto</div>
                <div class="menu-card-desc">Realize venda de produtos</div>
            </a>
        </div>

    </div>
    </main>

</body>

</html>
