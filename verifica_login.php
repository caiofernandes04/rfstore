<?php

    // Inclui o arquivo responsável pela conexão com o banco de dados
    include("banco.php");

    // Inicia uma nova sessão ou continua a existente
    session_start();

    // Recupera os dados enviados via POST do formulário de login
    $login = $_POST['nome'];
    $senha = $_POST['senha'];

    // Monta a consulta SQL para verificar se existe um usuário com o login e senha informados
    $sql = "SELECT * FROM usuarios
            WHERE nome = '$login' AND senha= '$senha'";
    
    // Executa a consulta no banco de dados
    $result = $con->query($sql);

    // Se encontrar pelo menos um usuário correspondente
    if( $result->num_rows > 0 )
    {
        // Armazena as credenciais na sessão
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;

        // Redireciona o usuário para a página administrativa
        header('location:admin.php');
    }
    else {
        // Se não encontrar o usuário, limpa qualquer dado da sessão
        unset ($_SESSION['login']);
        unset ($_SESSION['senha']);

        // Redireciona de volta para a página de login
        header('location:index.php');
    }
?>
