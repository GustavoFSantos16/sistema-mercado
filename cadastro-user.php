<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cadastro de Usuários</title>
</head>
<body>
<main class="page-card">
    <div class="header">
        <h2>Cadastro de Usuário</h2>
        <p>Insira um nome e uma senha para criação do perfil.</p>
        <div class="btn-primary"><a href="login.php">Ir para login</a></div>
    </div>

    <form method="post" action="" class="form-grid">
        <div class="form-group">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" autocomplete="username" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" autocomplete="new-password" required>
        </div>

        <button type="submit" class="btn-submit">Cadastrar</button>
    </form>

<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os valores enviados pelo formulário
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Dados para conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "gus@2009";
    $dbname = "mercado";

    // Conecta ao MySQL
    $conn = new mysqli($servername, $username, $password);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Cria o banco de dados se não existir
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->query($sql);

    // Seleciona o banco de dados
    $conn->select_db($dbname);

    // Cria a tabela se não existir
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR(100) NOT NULL,
        senha VARCHAR(100) NOT NULL
    )";
    $conn->query($sql);

    // Insere o registro no BD
    $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario','$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: Darkgreen;'>Usuário cadastrado com sucesso!</p>";
        
    } else {
        echo "<p style='color: red;'>Erro ao cadastrar</p>";
    }

    // Fecha a conexão
    $conn->close();
}
?>
</main>
</body>
</html>