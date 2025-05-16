<?php
session_start(); // Inicia a sessão para acessar o carrinho

// Verifica se foi passado um índice pela URL
if (isset($_GET['index'])) {
    $index = $_GET['index']; // Pega o índice

    // Verifica se o índice existe no carrinho
    if (isset($_SESSION['carrinho'][$index])) {
        unset($_SESSION['carrinho'][$index]); // Remove o item do carrinho
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reorganiza os índices
    }
}

// Volta para a página do carrinho
header("Location: carrinho.php");
exit();
?>
