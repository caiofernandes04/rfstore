<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Meu Carrinho</title>
    <style>
        * {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .item-carrinho {
            display: flex;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 5px;
        }
        .item-img {
            width: 120px;
            margin-right: 20px;
        }
        .item-img img {
            width: 100%;
        }
        .item-info {
            flex-grow: 1;
        }
        .item-quantidade {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .btn-quantidade {
            width: 30px;
            height: 30px;
            background: #f0f0f0;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        .quantidade {
            margin: 0 10px;
            width: 40px;
            text-align: center;
        }
        .btn-remover {
            color: red;
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
        }
        .btn-continuar {
            display: inline-block;
            padding: 10px 15px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Meu Carrinho</h1>
        
        <?php if(empty($_SESSION['carrinho'])): ?>
            <p>Seu carrinho está vazio.</p>
        <?php else: ?>
            <?php 
            $total = 0;
            foreach($_SESSION['carrinho'] as $index => $item): 
                $subtotal = $item['preco'] * $item['quantidade'];
                $total += $subtotal;
            ?>
                <div class="item-carrinho">
                    <div class="item-img">
                        <img src="img/<?php echo $item['imagem']; ?>">
                    </div>
                    <div class="item-info">
                        <h3><?php echo $item['nome']; ?></h3>
                        <p>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                        
                        <div class="item-quantidade">
                            <form action="atualizar_carrinho.php" method="post" style="display:inline;">
                                <input type="hidden" name="acao" value="diminuir">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" class="btn-quantidade">-</button>
                            </form>
                            
                            <span class="quantidade"><?php echo $item['quantidade']; ?></span>
                            
                            <form action="atualizar_carrinho.php" method="post" style="display:inline;">
                                <input type="hidden" name="acao" value="aumentar">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" class="btn-quantidade">+</button>
                            </form>
                        </div>
                        
                        <p>Subtotal: R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></p>
                        <a href="remover.php?index=<?php echo $index; ?>" class="btn-remover">Remover</a>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="total">
                Total: R$ <?php echo number_format($total, 2, ',', '.'); ?>
            </div>
        <?php endif; ?>
        
        <a href="produtos.php" class="btn-continuar">Continuar Comprando</a>
    </div>
</body>
</html>