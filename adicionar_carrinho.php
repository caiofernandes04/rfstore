<?php
// Liga a sessão
session_start();

// Conecta no banco (supondo que banco.php já faz isso)
include("banco.php");

// Pega o ID do produto
$id = $_GET['id'];

// Busca o produto no banco
$sql = "SELECT * FROM produtos WHERE id = $id";
$result = $con->query($sql);
$produto = mysqli_fetch_assoc($result);

// Se o carrinho não existe, cria
if(!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

// Adiciona o produto no carrinho
$_SESSION['carrinho'][] = array(
    'id' => $produto['id'],
    'nome' => $produto['nome'],
    'preco' => $produto['preco'],
    'imagem' => $produto['imagem'],
    'quantidade' => 1
);

// Volta pra página anterior
header("Location:index.php");
?>