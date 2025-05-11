<?php
session_start();

$index = $_POST['index'];
$acao = $_POST['acao'];

if(isset($_SESSION['carrinho'][$index])) {
    if($acao == 'aumentar') {
        $_SESSION['carrinho'][$index]['quantidade']++;
    } elseif($acao == 'diminuir' && $_SESSION['carrinho'][$index]['quantidade'] > 1) {
        $_SESSION['carrinho'][$index]['quantidade']--;
    }
}

header("Location: carrinho.php");
?>