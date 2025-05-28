<?php
     
    include("banco.php");

    // Inicia a sessão para verificar se o usuário está autenticado
    session_start();

    // Verifica se as variáveis de sessão 'login' e 'senha' estão definidas.
    // Caso contrário, redireciona para a página de login (index.php)
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        header('location:index.php');
    }

    // Recebe o ID da categoria e o novo nome enviados via formulário (método POST)
    // O operador @ evita a exibição de mensagens de erro caso as variáveis não existam
    $id = @$_POST["id"];
    $nome = @$_POST["nome"];

    // Monta a instrução SQL para atualizar o nome da categoria com o ID correspondente
    $sql = "UPDATE `categorias` 
                SET `nome` = '$nome' 
            WHERE `categorias`.`id` = '$id'";

    // Executa a consulta no banco de dados
    $con->query($sql);

    // Redireciona de volta para a página de categorias após a atualização
    header("location:categorias.php");
?>

