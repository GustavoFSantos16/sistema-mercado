<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27><text y=%27.9em%27 font-size=%2790%27>🛍️</text></svg>">
    <link rel="stylesheet" href="styles.css">
    <title>Estoque de produtos</title>
</head>

<body>
    <main class="page-card">
        <div class="topbar">
            <a href="index.php">Voltar</a>
        </div>
        <div class="page-heading">
            <h2>Filtro 🔎</h2>

        </div>
        <div class="container-filtro">

            <form action="" method="post" class="form-grid">

                <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" id="nome">
                </div>

                <div class="form-group">
                    <label for="ordem">Filtro: </label>
                    <select name="ordem" id="ordem">
                        <option value="">Selecione uma ordem</option>
                        <option value="id_produto">ID</option>
                        <option value="nome_produto">Nome</option>
                        <option value="tipo_produto">Tipo de Produto</option>
                        <option value="estoque">Quant. de Estoque</option>
                        <option value="preco">Preço por Unidade</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">Filtrar</button><button type="reset">Limpar</button>
            </form>
        </div>
    

    <div class="container-fila">
        <div class="cabecalho">
            <h2>Produtos cadastrados 📋</h2>
            <hr>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $sql = "SELECT * FROM produtos";
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $ordem = $_POST['ordem'];

            if (empty($nome) && empty($ordem)) {
                $sql = "SELECT * FROM produtos";
            } elseif (!empty($nome) && empty($ordem)) {
                $sql = "SELECT * FROM produtos WHERE nome_produto = '$nome'";
            } elseif (!empty($ordem) && empty($nome)) {
                $sql = "SELECT * FROM produtos ORDER BY $ordem ASC";
            } else {
                $sql = "SELECT * FROM produtos WHERE nome_produto = '$nome' ORDER BY $ordem";
            }
        }

        // Conecta com o banco 
        $servername = "localhost";
        $username = "root";
        $password = "Senai@118";
        $dbname = "mercado";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("<p class='erro'>Falha na conexão: " . $conn->connect_error . "</p>");
        }



        // Seleciona o banco de dados
        $conn->select_db($dbname);



        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            echo "<div class='tabela-wrapper'>";
            echo "<table class='tabela-produto'>";
            echo "<thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do Produto</th>
                        <th>Tipo do Produto</th>
                        <th>Quant. em Estoque</th>
                        <th>Preço</th>
                    </tr>
                  </thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {

                echo "<tr>";
                echo "<td>" . $row['id_produto'] . "</td>";
                echo "<td><strong>" . htmlspecialchars($row['nome_produto']) . "</strong></td>";
                echo "<td>" . htmlspecialchars($row['tipo_produto']) . "</td>";
                echo "<td>" . $row['estoque'] . " </td>";
                echo "<td>R$ " . $row['preco'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p class='sem-registros'>Nenhum cadastrado no sistema.</p>";
        }
        // Fecha a conexão
        $conn->close();

        ?>
    </div>
</main>
</body>

</html>