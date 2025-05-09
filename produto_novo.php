<?php
    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
    header('location:index.php');
    }
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
        <form action="produto_novo_salvar.php" method="post">
            <div>
                <span>Nome do Produto</span>
                <input type="text" name="nome"/>
            </div>

            <div>
                <span>Preço do produto</span>
                <input type="text" name="preco"/>
            </div>
            
            <div>
                <span>ID da categoria</span>
                <input type="text" name="categoria"/>
            </div>

            <div>
                <span>Nome da imagem</span>
                <input type="text" name="imagem"/>
            </div>

            <div>
                <input type="submit" value="Salvar" class="btn btn-dark"/>
                <a href="produtos.php" class="btn btn-secondary">VOLTAR</a>
            </div>
        </form>
    </div>
</body>
</html>