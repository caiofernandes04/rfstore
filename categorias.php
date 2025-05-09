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
    <title>Categorias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</head>

<body>
    <h1 style="font-size: 32px; color:rgb(0, 0, 0); margin-bottom: 10px; text-align: center; font-family: Arial, sans-serif;">
        Categorias
    </h1>
    <form action="categorias.php" method="get" style="text-align: center;">
        <label for="aluno"> Nome da categoria:</label>
        <input type="text" name="nome">

        <button type="submit" value="ENVIAR"> PESQUISAR </button>
        
        <a href="categoria_nova.php" style="background-color: #00FF00" class="btn btn-sucess"> NOVA CATEGORIA </a>
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

        $sql = "SELECT * FROM categorias WHERE nome like '%$nome%' ";

        $retorno = $con->query($sql);

        if ($retorno->num_rows == 1) {
            echo " 
             <table class = 'table table-hower'>
             <thead>
             <td>ID</td> 
             <td>NOME</td>
             <td>OPÇÕES</td>
             </thead> 
             <p style='text-align: center;'>
                Encontrada $retorno->num_rows categorias.<br>
            </p>
             ";
        } else if ($retorno->num_rows > 1) {

            echo " 
             <table class = 'table table-hower'>
             <thead>
             <td>ID</td> 
             <td>NOME</td>
             <td>OPÇÕES</td>
             </thead> 
             <p style='text-align: center;'>
                Encontradas $retorno->num_rows categorias.<br>
            </p>
             ";
        } else {
            echo "Nenhuma categoria com o nome \"" . $nome . "\" foi encontrado. Tente novamente outro nome! <br>";
        }

        foreach ($retorno as $linha) {
            echo "
                    <tr>
                        <td>" . $linha['id'] . "</td>
                        <td>" . $linha['nome'] . "</td>                       
                        <td>
                            <a href='/rfstore_frontend/categoria_deletar.php?id=" . $linha["id"] . "' class='btn btn-danger'> 🗑️ </a>
                            <a href='/rfstore_frontend/categoria_alterar.php?id=" . $linha["id"] . "' class='btn btn-primary'> ✏️ </a>
                        </td>         
                    </tr>
                    ";
        }
        ?>
    </tbody>


</body>

</html>