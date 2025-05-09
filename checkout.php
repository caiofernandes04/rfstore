<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RF Store - Checkout</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <header>
      <h1>Finalizar Compra</h1>
      <nav>
        <a href="index.html">Home</a>
        <a href="carrinho.html">Carrinho</a>
      </nav>
    </header>
    <main>
      <h2>Resumo do Pedido</h2>
      <p>Produto: Camiseta Preta - R$ 59,90</p>
      <form action="processa_compra.php" method="POST">
        <label for="nome">Nome completo:</label><br />
        <input type="text" id="nome" name="nome" required /><br /><br />
        <label for="endereco">Endereço:</label><br />
        <input type="text" id="endereco" name="endereco" required /><br /><br />
        <label for="pagamento">Forma de pagamento:</label><br />
        <select id="pagamento" name="pagamento">
          <option value="pix">PIX</option>
          <option value="cartao">Cartão de Crédito</option>
          <option value="boleto">Boleto</option></select
        ><br /><br />
        <button type="submit">Confirmar Pedido</button>
      </form>
    </main>
  </body>
</html>
