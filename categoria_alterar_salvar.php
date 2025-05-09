<?php
    include("banco.php");

    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
    header('location:index.php');
    }

    $id = @$_POST["id"];
    $nome = @$_POST["nome"];

    $sql = "UPDATE `categorias` 
                SET `nome` = '$nome' 
            WHERE `categorias`.`id` = '$id'";

    $con->query($sql);

    header("location:categorias.php");
?>
