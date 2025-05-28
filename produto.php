<?php
  include("banco.php")
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="css/style.css" />
      <style>
        .produto-detalhe {
          max-width: 1200px;
          margin: 2rem auto;
          padding: 0 20px;
          display: flex;
          justify-content: center;
        }

        .produto-detalhe .produto {
          width: 100%;
          max-width: 800px;
          border: none;
          box-shadow: 0 10px 30px rgba(0,0,0,0.1);
          padding: 30px;
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 40px;
          align-items: center;
          background: white;
          border-radius: 12px;
        }

        .produto-detalhe .produto img {
          width: 100%;
          height: 400px;
          object-fit: contain;
          background: #f9f9f9;
          border-radius: 8px;
          padding: 20px;
        }

        .produto-detalhe .produto h2 {
          font-size: 2rem;
          margin-bottom: 1rem;
          color: #333;
          text-align: left;
        }

        .produto-detalhe .preco {
          font-size: 1.8rem;
          color: #e63946;
          margin: 1.5rem 0;
          font-weight: bold;
        }

        .produto-info {
          display: flex;
          flex-direction: column;
        }

        .botao-comprar {
          background-color: #000;
          color: white;
          padding: 15px 30px;
          border: none;
          border-radius: 6px;
          font-size: 1.1rem;
          cursor: pointer;
          transition: all 0.3s;
          margin-top: 20px;
          align-self: flex-start;
        }

        .botao-comprar:hover {
          background-color: #e63946;
          transform: translateY(-3px);
        }

        /* Responsividade */
        @media (max-width: 768px) {
          .produto-detalhe .produto {
            grid-template-columns: 1fr;
            gap: 20px;
          }
          
          .produto-detalhe .produto img {
            height: 300px;
          }
          
          .produto-detalhe .produto h2 {
            font-size: 1.5rem;
          }
        }
      </style>
  </head>
  <body>
    <header>
      <h1>RF Store</h1>
      <nav>
        <a href="index.php">Home</a>
        <a href="carrinho.php">Carrinho</a>
      </nav>
    </header>
    <main>
      <div class="produto-detalhe">
        <?php
          $id = ""; // Inicializa a variável $id como uma string vazia

          if (isset($_GET['id'])) {
            $id = ($_GET['id']); // Se o parâmetro 'id' estiver presente na URL, atribui seu valor à variável $id
          }

          // Cria uma query SQL para buscar o produto com o id fornecido
          $sql = "SELECT * FROM produtos where id='$id'";
          $resultado = $con->query($sql); // Executa a query no banco de dados

          // Verifica se a consulta retornou algum resultado
          if ($resultado->num_rows > 0) {
            // Percorre todos os resultados retornados (neste caso, deve ser apenas um)
            while ($produto = $resultado->fetch_assoc()) {
              // Exibe os dados do produto (imagem, nome, preço e botão de compra)
              echo "<div class='produto'>";
              echo "<img src='data:image/png;base64," . base64_encode($produto['imagem']) . "' class='imagem-produto'>";
              echo "<div class='produto-info'>";
              echo "<h2>" . $produto['nome'] . "</h2>";
              echo "<p class='preco'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>";
              echo "<form action='adicionar_carrinho.php' method='get'>";
              echo "<button class='botao-comprar' type='submit' name='id' value='" . $produto['id'] . "'>Comprar Agora</button>"; 
              echo "</div>";
              echo "</div>";                
            } 
          } else {
            // Caso nenhum produto seja encontrado com o id informado
            echo "<p>Nenhum produto encontrado.</p>";
          }
        ?>
      </div>
    </main>
  </body>
</html>
