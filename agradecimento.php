<?php
session_start(); //acessa os dados do carrinho

// se o carrinho está vazio, redireciona para a página principal
if (empty($_SESSION['carrinho'])) {
    header("Location: produtos.php");
    exit;
}

// limpa o carrinho após a compra
unset($_SESSION['carrinho']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>RF Store agradece!</title>
    <style>
        * { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 0 auto; text-align: center; padding: 20px; }
        .btn-voltar { padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 4px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Obrigado pela sua compra!</h1>
        <p>Seu pedido foi realizado com sucesso e está sendo processado. Em breve, você receberá um e-mail com mais informações sobre o status da sua compra.</p>
        <a href="produtos.php" class="btn-voltar">Voltar para a loja</a>
    </div>
</body>
</html>
