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
    
    // Se enviou nova imagem
    if(!empty($_FILES['imagem']['tmp_name'])) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        $imagem = $con->real_escape_string($imagem);
        $sql_imagem = ", `imagem` = '$imagem'";
    } else {
        $sql_imagem = "";
    }

    $sql = "UPDATE `produtos` 
            SET `nome` = '$nome', 
                `preco` = '$preco'
                $sql_imagem,
                `categoria_id` = '$categoria_id' 
            WHERE `produtos`.`id` = '$id'";
    
    $con->query($sql);

    header("location:produtos.php");
?>