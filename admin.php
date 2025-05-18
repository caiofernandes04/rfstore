<?php
session_start();

if (!isset($_SESSION['login']) || !isset($_SESSION['senha'])) {
    header('location:index.php');
    exit();
}

if (isset($_POST['reset_session'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Segura</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</head>

<body>
    <h1 style="font-size: 32px; color:rgb(0, 0, 0); margin-bottom: 10px; text-align: center; font-family: Arial, sans-serif;">
        Área de administração
    </h1>
    <form action="area_segura.php" method="get" style="text-align: center;">
        <label for="aluno"> Id da venda:</label>
        <input type="text" name="id">

        <button type="submit" value="ENVIAR"> PESQUISAR </button>
        <a href="produtos.php" style="background-color: #00FF00" class="btn btn-success"> PRODUTOS </a>
        <a href="categorias.php" style="background-color: #00FF00" class="btn btn-success"> CATEGORIAS </a>
    </form>

    <form method="post" style="position: absolute; top: 10px; left: 10px;">
        <button type="submit" name="reset_session" style="background-color: red; color: white; border: none; padding: 8px 15px; font-size: 14px; cursor: pointer; border-radius: 20px;">
            DESCONECTAR
        </button>
    </form>

</body>

<body>
    <tbody>
        <?php
        include("banco.php");

        $sql = "SELECT vendas.id AS venda_id,
                       vendas.data_venda,
                       produtos.nome AS nome_produto,
                       produtos.preco,
                       vendas_itens.quantidade
                FROM vendas
                INNER JOIN vendas_itens ON vendas.id = vendas_itens.venda_id
                INNER JOIN produtos ON vendas_itens.produto_id = produtos.id
                ORDER BY vendas.id, vendas.data_venda";

        $retorno = $con->query($sql);

        if ($retorno->num_rows > 0) {
            echo "
            <table class='table table-hover'>
                <thead>
                    <tr>
                        <th>ID da Venda</th>
                        <th>Data</th>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
            ";

            $ultima_venda = "";

            foreach ($retorno as $linha) {
                $venda_id = $linha['venda_id'];
                $subtotal = $linha['preco'] * $linha['quantidade'];

                if ($venda_id !== $ultima_venda) {
                    echo "<tr><td colspan='6'><strong>Venda #$venda_id - " . date('d/m/Y H:i', strtotime($linha['data_venda'])) . "</strong></td></tr>";
                    $ultima_venda = $venda_id;
                }

                echo "
                    <tr>
                        <td>" . $linha['venda_id'] . "</td>
                        <td>" . date('d/m/Y H:i', strtotime($linha['data_venda'])) . "</td>
                        <td>" . $linha['nome_produto'] . "</td>
                        <td>R$ " . number_format($linha['preco'], 2, ',', '.') . "</td>
                        <td>" . $linha['quantidade'] . "</td>
                        <td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>
                    </tr>
                ";
            }

            echo "</tbody></table>";
        } else {
            echo "<p style='text-align:center;'>Nenhuma venda encontrada.</p>";
        }
        ?>
    </tbody>
</body>

</html>