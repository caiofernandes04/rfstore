<?php

    include("banco.php");

    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
    header('location:index.php');
    }

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];
    $categoria_id = $_POST['categoria'];


    $sql = "INSERT INTO produtos (`id`, `nome`, `preco`, `imagem`, `categoria_id`) 
            VALUES (NULL, '$nome', '$preco', '$imagem', '$categoria_id')";
    
    $con->query($sql);

    header('location:produtos.php');
?>