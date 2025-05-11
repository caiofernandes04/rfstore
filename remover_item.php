<?php
session_start();

$index = $_GET['index'];

if(isset($_SESSION['carrinho'][$index])) {
    unset($_SESSION['carrinho'][$index]);
    // Reorganiza os índices
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
}

header("Location: carrinho.php");
?>