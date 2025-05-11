<?php
  include("banco.php");
  $sqlcategoria = "SELECT * FROM categorias";

  $resultadocategoria = $con->query($sqlcategoria)
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RF Store - Home</title>
    <link rel="stylesheet" href="css/style.css" />
    <style>
      /* Grid de produtos */
      .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
      }

      /* Card de produto */
      .produto {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
      }

      .produto:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }

      /* Container da imagem - NOVO */
      .img-container {
        width: 100%;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        background: #f5f5f5;
        border-radius: 4px;
        overflow: hidden;
      }

      /* Imagem do produto - MODIFICADO */
      .produto img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
      }

      /* Textos */
      .produto h2 {
        font-size: 1rem;
        margin: 10px 0;
        color: #333;
        flex-grow: 1;
      }

      .preco {
        font-weight: bold;
        color: #e63946;
        margin: 10px 0;
      }

      /* Botões - MODIFICADO */
      .botoes {
        margin-top: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      .botao {
        display: block;
        padding: 8px 15px;
        background-color: #000;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
        border: none;
        cursor: pointer;
        width: 100%;
      }

      .botao:hover {
        background-color: #333;
      }

      /* Barra de categorias */
      .category-bar {
        margin: 1rem 2rem;
        text-align: center;
      }

      .category-bar button {
        margin-right: 1rem;
        padding: 0.5rem 1rem;
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
      }

      .category-bar button:hover {
        background-color: #333;
      }
    </style>
</head>
<body>
    <header>
      <h1>RF Store</h1>
      <nav>
        <a href="index.php">Home</a>
        <a href="carrinho.php">Carrinho</a>
        <a href="login.php">Login</a>
      </nav>
    </header>

    <?php
      echo '<div class="category-bar">';
      echo '<form action="index.php" method="get">';
      echo '<button type="submit" name="id" value="">Todos</button>';

      if ($resultadocategoria->num_rows > 0) {
        while ($categoria = $resultadocategoria->fetch_assoc()) {
            echo '<button type="submit" name="id" value="' . $categoria["id"] . '">' . $categoria["nome"] . '</button>';
        }
      }

      echo '</form>';
      echo '</div>';
    ?>

    <div class="grid">
      <?php
      $id = "";
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
      }

      $sql = "SELECT * FROM produtos where categoria_id like '%$id%'";
      $resultado = $con->query($sql);

      if ($resultado->num_rows > 0) {
          while ($produto = $resultado->fetch_assoc()) {
            echo "<div class='produto'>";
            echo "<div class='img-container'>";
            echo "<img src='img/" . $produto['imagem'] . "' alt='" . $produto['nome'] . "'>";
            echo "</div>";
            echo "<h2>" . $produto['nome'] . "</h2>";
            echo "<p class='preco'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>";
            echo "<div class='botoes'>";
            echo "<a class='botao' href='produto.php?id=" . $produto['id'] . "'>Ver Produto</a>";
            echo "<form action='adicionar_carrinho.php' method='get'>";
            echo "<button class='botao' type='submit' name='id' value='" . $produto['id'] . "'>Adicionar ao carrinho</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";              
          }
      } else {
          echo "<p>Nenhum produto encontrado.</p>";
      }
      ?>
    </div>
</body>
</html>