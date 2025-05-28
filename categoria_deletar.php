<?php

     
    include("banco.php");
 
    session_start();

    // Verifica se o usuário está autenticado (se 'login' e 'senha' estão definidos na sessão)
    // Caso não esteja, redireciona para a página de login (index.php)
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        header('location:index.php');
    }

    // Recupera o valor do ID da categoria a ser excluída, passado pela URL (método GET)
    $id = $_GET['id'];

    // Monta a consulta SQL para deletar a categoria com o ID especificado
    $sql = "DELETE FROM categorias WHERE `categorias`.`id` = '$id'";

    // Executa a consulta no banco de dados
    $con->query($sql);

    // Após a exclusão, redireciona o usuário de volta para a página de categorias
    header('location:categorias.php');
?>
