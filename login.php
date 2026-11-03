<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <link rel="icon" href="data:image/svg+xml,<svg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27><text y=%27.9em%27 font-size=%2790%27>🛍️</text></svg>">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body>
<main class="page-card">
<div class="header">
<h2>Login de Usuário</h2>
<p>Insira suas credenciais para efetuar o login</p>
<div class="btn-primary">
    <a href="cadastro-user.php">Cadastro</a>
</div>

    <form method="post" action="" class="form-grid">
        <div class="form-group">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" autocomplete="username" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" autocomplete="current-password" required>
        </div>

        <button type="submit">Entrar</button>
    </form>

<?php

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os valores enviados pelo formulário
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mercado";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta o usuário no BD
    $sql = "SELECT * FROM usuarios
            WHERE usuario = '$usuario' AND senha = '$senha'";

    $result = $conn->query($sql);

    // Verifica se encontrou o usuário
    if ($result->num_rows > 0) {
        $_SESSION['usuario'] = $usuario;

        header("Location: index.php");
        exit();
        echo "<script>
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<p style='color: red;'>Usuário ou senha incorretos!</p>";
    }

    // Fecha a conexão
    $conn->close();
}
?>
</div>
</main>
</body>
</html>