<?php
    include("banco.php");

    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
    header('location:index.php');
    }

    $id = @$_POST["id"];
    $nome = @$_POST["nome"];
    $preco = @$_POST["preco"];
    $categoria_id = @$_POST["categoria_id"];
    $imagem = @$_POST["imagem"];

    $sql = "UPDATE `produtos` 
                SET `nome` = '$nome', 
                    `preco` = '$preco', 
                    `imagem` = '$imagem', 
                    `categoria_id` = '$categoria_id' 
            WHERE `produtos`.`id` = '$id'
            ";

    $con->query($sql);

    header("location:produtos.php");
?>
