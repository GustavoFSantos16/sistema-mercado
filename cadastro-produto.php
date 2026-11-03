<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="data:image/svg+xml,<svg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27><text y=%27.9em%27 font-size=%2790%27>🛍️</text></svg>">
    <link rel="stylesheet" href="styles.css">
    <title>Cadastro de Produtos</title>
</head>

<body>

    <div class="topbar">
        <a href="index.php">Voltar</a>
    </div>

    <main class="page-card">
    <div class="page-heading">
        <h2>📝 Cadastro de Produtos</h2>
        <p>Insira os dados do produto para cadastrá-lo.</p>
    </div>

    <form action="" method="post" class="form-grid">
        <div class="form-group">
        <label for="nome">Nome do Produto: </label>
        <input type="text" name="nome" id="nome" placeholder="Insira o nome do produto" required>
        </div>

        <div class="form-group">
        <label for="tipo">Tipo do Produto: </label>
        <select name="tipo" id="tipo" required>
            <option value="">Selecione um tipo de Produto</option>
            <option value="Alimentos">Alimentos</option>
            <option value="Bebidas">Bebidas</option>
            <option value="Frutas, Verduras e Legumes">Frutas, Verduras e Legumes</option>
            <option value="Leites e Derivados">Leites e Derivados</option>
            <option value="Carnes e Frios">Carnes e Frios</option>
            <option value="Limpeza e Higiene Pessoal">Limpeza e Higiene Pessoal</option>
            <option value="Outros">Outros</option>
        </select>
        </div>

        <div class="form-group">
        <label for="estoque">Quantidade em estoque: </label>
        <input type="number" name="estoque" id="estoque" required>
        </div>

        <div class="form-group">
        <label for="preco">Preço por Unidade: </label>
        <input type="text" name="preco" id="preco" placeholder="Ex: 20.00" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Cadastrar produto</button>
            <button type="reset">Limpar</button>
        </div>
    </form>

    </main>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomeProduto = trim($_POST["nome"]);
        $tipoProduto = $_POST["tipo"];
        $estoque = (int)($_POST["estoque"] ?? 0);
        $preco = str_replace(",", ".", $_POST["preco"]);

        if (!is_numeric($preco) || (float)$preco <= 0 || $estoque <= 0 || $nomeProduto === "" || $tipoProduto === "") {
            echo "<p class='erro'>Insira valores válidos para todos os campos.</p>";
        } else {

        // Dados para conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "Senai@118";
        $dbname = "mercado";

        // Conecta ao MySQL
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
        // Cria o banco de dados se não existir
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $conn->query($sql);

        // Seleciona o banco de dados
        $conn->select_db($dbname);

        $sql = "CREATE TABLE IF NOT EXISTS produtos (
            id_produto INT AUTO_INCREMENT PRIMARY KEY,
            nome_produto VARCHAR(100) NOT NULL,
            tipo_produto VARCHAR(100) NOT NULL,
            estoque INT(10) NOT NULL,
            preco FLOAT(10) NOT NULL
        )";
        $conn->query($sql);

        // Insere o registro no BD
        $sql = "INSERT INTO produtos (nome_produto, tipo_produto, estoque, preco) VALUES ('$nomeProduto','$tipoProduto', $estoque, $preco)";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: Darkgreen;'>Produto cadastrado com sucesso!</p>";

        } else {
            echo "<p style='color: red;'>Erro ao cadastrar</p>";
        }

        // Fecha a conexão
        $conn->close();
        }
    }
    ?>
    </main>
</body>

</html>