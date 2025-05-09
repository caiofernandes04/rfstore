<?php

    include("banco.php");

    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
    header('location:index.php');
    }

    $nome = $_POST['nome'];
    $id = $_POST['id'];


    $sql = "INSERT INTO categorias (`id`, `nome`) 
            VALUES ('$id', '$nome')";
    
    $con->query($sql);

    header('location:categorias.php');
?>