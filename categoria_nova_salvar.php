<?php

     
    include("banco.php");

     
    session_start();
    
    // Verifica se o usuário está autenticado (se 'login' e 'senha' estão definidos na sessão)
    // Se não estiver, redireciona para a página de login
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        header('location:index.php');
    }

    // Recebe os dados do formulário via método POST
    $nome = $_POST['nome'];  // Nome da categoria
    $id = $_POST['id'];      // ID da categoria

    // Cria uma instrução SQL para inserir uma nova categoria no banco de dados
    $sql = "INSERT INTO categorias (`id`, `nome`) 
            VALUES ('$id', '$nome')";
    
    // Executa a query no banco de dados
    $con->query($sql);

    // Redireciona de volta para a página de categorias após a inserção
    header('location:categorias.php');
?>
