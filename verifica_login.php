<?php
    
    include("banco.php");

    session_start();

    $login = $_POST['nome'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios
            WHERE nome = '$login' AND senha= '$senha'";
    
    $result = $con->query($sql);

    if( $result->num_rows > 0 )
    {
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        header('location:admin.php');
    }
    else{
        unset ($_SESSION['login']);
        unset ($_SESSION['senha']);
        header('location:index.php');
    }
?>