<?php
    include("banco.php");

    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
        header('location:index.php');
    }

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $categoria_id = $_POST["categoria_id"];
    
    $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    $imagem = $con->real_escape_string($imagem);

    $sql = "INSERT INTO produtos (`nome`, `preco`, `imagem`, `categoria_id`) 
            VALUES ('$nome', '$preco', '$imagem', '$categoria_id')";
    
    $con->query($sql);

    header('location:produtos.php');
?>