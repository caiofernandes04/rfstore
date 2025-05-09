<?php
    include("banco.php");

    session_start();
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
        {
        header('location:index.php');
        }

    $id = @$_GET["id"];

    $sql = "SELECT * FROM categorias WHERE id='$id'";
    $resultado = $con->query($sql);
    $dados = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de categoria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: white;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .cadastro {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"] {
            background-color: white;
            color: black;
            border: 1px solid black;
            padding: 5px;
            margin: 5px;
        }
        .btn {
            color: white;
        }
    </style>
</head>
<body>
    
    <div class="cadastro">
        <form action="categoria_alterar_salvar.php" method="post">
            <h1 style="font-size: 20px; color:rgb(0, 0, 0); margin-bottom: 10px; text-align: center; font-family: Arial, sans-serif;">
                Categoria: <?php echo $dados["nome"] ?>
            </h1>

            <div>
                <span>ID da Categoria:</span>
                <input type="text" name="id" value="<?php echo $dados["id"]; ?>" />
            </div>

            <div>
                <span>Nome da Categoria:</span>
                <input type="text" name="nome" value="<?php echo $dados["nome"]; ?>" />
            </div>

            <div>
                <input type="submit" value="Salvar" class="btn btn-dark"/>
                <a href="categorias.php" class="btn btn-secondary">VOLTAR</a>
            </div>
        </form>
    </div>
</body>
</html>