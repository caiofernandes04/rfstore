<?php
    session_start();
    // Inicia a sessão PHP para manter o usuário autenticado entre as páginas.

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
        header('location:index.php');
        // Se as variáveis de sessão 'login' e 'senha' não estiverem definidas, redireciona para a página de login.
    }

    include("banco.php");
    // Inclui o arquivo de conexão com o banco de dados.

    $sql = "SELECT 
                produtos.*,
                categorias.nome as categoria_nome
            FROM 
                produtos
            INNER JOIN 
                categorias ON produtos.categoria_id = categorias.id";
    // Consulta SQL para buscar todos os produtos com seus respectivos nomes de categoria.

    $resultado = $con->query($sql);
    // Executa a consulta SQL no banco de dados.

    $dados = mysqli_fetch_assoc($resultado);
    // Recupera a primeira linha do resultado da consulta como um array associativo.
    // OBS: Isso pode causar erro lógico se não houver produto ou se estiver criando um novo — talvez essa linha nem seja necessária aqui.

    // Consulta para buscar todas as categorias disponíveis no banco de dados.
    $sql_categorias = "SELECT * FROM categorias";
    $categorias = $con->query($sql_categorias);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
    <style>
        body {
            background-color: white;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .cadastro {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"] {
            background-color: white;
            color: black;
            border: 1px solid black;
            padding: 5px;
            margin: 5px;
        }
        .btn {
            color: white;
        }
    </style>
</head>
<body>
    <div class="cadastro">
        <form action="produto_novo_salvar.php" method="post" enctype="multipart/form-data">
            <div>
                <span>Nome do Produto</span>
                <input type="text" name="nome"/>
            </div>

            <div>
                <span>Preço do produto</span>
                <input type="text" name="preco"/>
            </div>
            
            <div>
                <span>Categoria:</span>
                <select name="categoria_id">
                    <?php while($categoria = mysqli_fetch_assoc($categorias)): ?>
                        <option value="<?php echo $categoria['id']; ?>" 
                            <?php echo ($categoria['id'] == $dados['categoria_id']) ?>>
                            <?php echo $categoria['nome']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div>
                <span>Imagem do Produto</span>
                <input type="file" name="imagem" required/>
            </div>

            <div>
                <input type="submit" value="Salvar" class="btn btn-dark"/>
                <a href="produtos.php" class="btn btn-secondary">VOLTAR</a>
            </div>
        </form>
    </div>
</body>
</html>