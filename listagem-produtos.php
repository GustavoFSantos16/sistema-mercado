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

    <div class="topbar">
        <a href="index.php">Voltar</a>
    </div>

    <div class="container-fila">
        <div class="cabecalho">
            <h2>Produtos cadastrados 📋</h2>
            <hr>
        </div>

        <?php
        // Conecta com o banco 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mercado";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("<p class='erro'>Falha na conexão: " . $conn->connect_error . "</p>");
        }

        // Seleciona o banco de dados
        $conn->select_db($dbname);

        $sql = "SELECT * FROM produtos";
        $result = $conn->query($sql);

        // Verifica se existem registros e os exibe em formato de tabela
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
</body>

</html>