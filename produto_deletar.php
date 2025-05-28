<?php

    include("banco.php");
     

    session_start();
     

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        header('location:index.php');
        // Se as variáveis de sessão 'login' e 'senha' não estiverem definidas, redireciona para index.php (página de login).
    }

    $id = $_GET['id'];
    // Recebe o parâmetro 'id' enviado via URL (método GET), que identifica o produto a ser deletado.

    $sql = "DELETE FROM produtos WHERE `produtos`.`id` = '$id'";
    // Monta a consulta SQL para deletar o produto com o id especificado.

    $con->query($sql);
    // Executa a consulta de exclusão no banco de dados.

    header('location:produtos.php');
    // Após a exclusão, redireciona o usuário para a página produtos.php.

?>

