<?php

session_start();

// Recebe o índice do item no carrinho que será atualizado
$index = $_POST['index'];

// Recebe a ação a ser executada: "aumentar" ou "diminuir"
$acao = $_POST['acao'];

// Verifica se existe um item no carrinho com o índice recebido
if(isset($_SESSION['carrinho'][$index])) {
    
    // Se a ação for 'aumentar', incrementa a quantidade do item
    if($acao == 'aumentar') {
        $_SESSION['carrinho'][$index]['quantidade']++;
    
    // Se a ação for 'diminuir', diminui a quantidade apenas se for maior que 1
    } elseif($acao == 'diminuir' && $_SESSION['carrinho'][$index]['quantidade'] > 1) {
        $_SESSION['carrinho'][$index]['quantidade']--;
    }
}

// Redireciona o usuário de volta para a página do carrinho após a atualização
header("Location: carrinho.php");
?>
