<?php
session_start(); // acessa os dados do carrinho
?>
<!DOCTYPE html>
<html>
<head>
    <title>Meu Carrinho</title>
    <style>
        /* Estilos básicos da página */
        * { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 0 auto; }
        .item-carrinho { display: flex; border: 1px solid #ddd; margin-bottom: 15px; padding: 15px; border-radius: 5px; }
        .item-img { width: 120px; margin-right: 20px; }
        .item-img img { width: 100%; }
        .item-info { flex-grow: 1; }
        .item-quantidade { display: flex; align-items: center; margin: 10px 0; }
        .btn-quantidade { width: 30px; height: 30px; background: #f0f0f0; border: 1px solid #ccc; cursor: pointer; }
        .quantidade { margin: 0 10px; width: 40px; text-align: center; }
        .btn-remover { color: red; text-decoration: none; margin-top: 10px; display: inline-block; }
        .total { font-size: 1.2em; font-weight: bold; margin-top: 20px; text-align: right; }
        .btn-continuar { display: inline-block; padding: 10px 15px; background: #4CAF50; color: white; text-decoration: none; border-radius: 4px; margin-top: 20px; }
        .btn-finalizar { display: inline-block; padding: 10px 15px; background:rgb(245, 5, 5); color: white; text-decoration: none; border-radius: 4px; margin-top: 20px; text-align: right; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Meu Carrinho</h1>

        <?php if (empty($_SESSION['carrinho'])): ?> <!-- Se o carrinho estiver vazio, mostra a mensagem -->
            <p>Seu carrinho está vazio.</p>
        <?php else: ?>
            <?php
            $total = 0; // Variável para guardar o valor total
 
            // Loop pelos itens do carrinho
            foreach ($_SESSION['carrinho'] as $index => $item):
                $subtotal = $item['preco'] * $item['quantidade']; // Calcula subtotal do item
                $total += $subtotal; // Soma ao total geral
            ?>
                <div class="item-carrinho">
                    <div class="item-img">
                        <img src="img/<?php echo $item['imagem']; ?>"> <!-- Mostra imagem do produto -->
                    </div>
                    <div class="item-info">
                        <h3><?php echo $item['nome']; ?></h3> <!-- Mostra nome do produto -->
                        <p>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p> 

                        <div class="item-quantidade">
                            <!-- Botão para diminuir quantidade -->
                            <form action="atualizar_carrinho.php" method="post" style="display:inline;">
                                <input type="hidden" name="acao" value="diminuir"> 
                                <input type="hidden" name="index" value="<?php echo $index; ?>"> 
                                <button type="submit" class="btn-quantidade">-</button>
                            </form>

                            <!-- Quantidade atual -->
                            <span class="quantidade"><?php echo $item['quantidade']; ?></span>

                            <!-- Botão para aumentar quantidade -->
                            <form action="atualizar_carrinho.php" method="post" style="display:inline;">
                                <input type="hidden" name="acao" value="aumentar">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" class="btn-quantidade">+</button>
                            </form>
                        </div>

                        <!-- Mostra o subtotal dos produtos -->
                        <p>Subtotal: R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></p>

                        <!-- remove items do carrinho -->
                        <a href="remover_carrinho.php?index=<?php echo $index; ?>" class="btn-remover">Remover</a>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Mostra o valor total do carrinho -->
            <div class="total">
                Total: R$ <?php echo number_format($total, 2, ',', '.'); ?>
            </div>
        <?php endif; ?>

       
        <a href="produtos.php" class="btn-continuar">Continuar Comprando</a>
        <a href="agradecimento.php" class="btn-finalizar">Finalizar Compra</a>
    </div>
</body>
</html>
