<?php
    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
    header('location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</head>

<body>
    <h1 style="font-size: 32px; color:rgb(0, 0, 0); margin-bottom: 10px; text-align: center; font-family: Arial, sans-serif;">
        Produtos
    </h1>
    <form action="admin.php" method="get" style="text-align: center;">
        <label for="aluno"> Nome do Produto:</label>
        <input type="text" name="nome">

        <button type="submit" value="ENVIAR"> PESQUISAR </button>
        <a href="produto_novo.php" style="background-color: #00FF00" class="btn btn-sucess"> NOVO PRODUTO </a>
        </a>
    </form>

    <form style="position: absolute; top: 10px; left: 10px;">
        <a href="admin.php" style="background-color: red; color: white; border: none; padding: 8px 15px; font-size: 14px; cursor: pointer; border-radius: 20px;" class="btn btn-sucess"> VOLTAR </a>
    </form>
</body>

<body>

    <tbody>

        <?php

        include("banco.php");
        
        $nome = "";
        if (isset($_GET['nome'])) // isset() - essa função significa "existe?"
        {
            $nome = ($_GET['nome']);
        }

        $sql = "SELECT produtos.*, categorias.nome AS categoria_nome
                    FROM produtos
                INNER JOIN categorias ON produtos.categoria_id = categorias.id;";

        $retorno = $con->query($sql);

        if ($retorno->num_rows == 1) {
            echo " 
             <table class = 'table table-hower'>
             <thead>
             <td>ID</td> 
             <td>NOME</td>
             <td>PREÇO</td>
             <td>NOME DA CATEGORIA ID</td>
             <td>IMAGEM</td>
             <td>OPÇÕES</td>
             </thead> 
             <p style='text-align: center;'>
                Encontrado $retorno->num_rows produtos.<br>
            </p>
             ";
        } else if ($retorno->num_rows > 1) {

            echo " 
             <table class = 'table table-hower'>
             <thead>
             <td>ID</td> 
             <td>NOME</td>
             <td>PREÇO</td>
             <td>NOME DA CATEGORIA</td>
             <td>IMAGEM</td>
             <td>OPÇÕES</td>
             </thead> 
             <p style='text-align: center;'>
                Encontrados $retorno->num_rows produtos.<br>
            </p>
             ";
        } else {
            echo "Nenhum produto com o nome \"" . $nome . "\" foi encontrado. Tente novamente outro nome! <br>";
        }

        foreach ($retorno as $linha) {
            echo "
                    <tr>
                        <td>" . $linha['id'] . "</td>
                        <td>" . $linha['nome'] . "</td>
                        <td>" . $linha['preco'] . "</td>   
                        <td>" . $linha['categoria_nome'] . "</td>                        
                        <td>" . $linha['imagem'] . "</td>                        
                        <td>
                            <a href='/rfstore_frontend/produto_deletar.php?id=" . $linha["id"] . "' class='btn btn-danger'> 🗑️ </a>
                            <a href='/rfstore_frontend/produto_alterar.php?id=" . $linha["id"] . "' class='btn btn-primary'> ✏️ </a>
                        </td>         
                    </tr>
                    ";
        }
        ?>
    </tbody>


</body>

</html>