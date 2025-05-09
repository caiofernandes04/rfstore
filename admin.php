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

</html>