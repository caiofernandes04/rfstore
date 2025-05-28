<?php
    session_start(); // Inicia a sessão

    // Verifica se as variáveis de sessão 'login' e 'senha' estão definidas.
    // Caso não estejam, redireciona o usuário para a página de login (index.php).
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
    <title>Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
    <style>
    .imagem-produto {
        max-width: 80px;
        max-height: 80px;
        width: auto;
        height: auto;
        display: block;
        margin: 0 auto;
    }
    
    /* Garante que a célula da tabela tenha tamanho fixo */
    table td:nth-child(5) {
        width: 100px;
        height: 100px;
        padding: 5px !important;
    }
</style>
</head>

<body>
    <h1 style="font-size: 32px; color:rgb(0, 0, 0); margin-bottom: 10px; text-align: center; font-family: Arial, sans-serif;">
        Produtos
    </h1>
    <form action="produtos.php" method="get" style="text-align: center;">
        <label for="aluno"> Nome do Produto:</label>
        <input type="text" name="nome">

        <button type="submit" value="ENVIAR"> PESQUISAR </button>
        <a href="produto_novo.php" style="background-color: #00FF00" class="btn btn-sucess"> NOVO PRODUTO </a>
        </a>
    </form>

    <form style="position: absolute; top: 10px; left: 10px;">
        <a href="admin.php" style="background-color: red; color: white; border: none; padding: 8px 15px; font-size: 14px; cursor: pointer; border-radius: 20px;" class="btn btn-sucess"> VOLTAR </a>
    </form>
</body>

<body>

    <tbody>

        <?php
    include("banco.php"); // Inclui o arquivo de conexão com o banco de dados

    $nome = "";
    if (isset($_GET['nome'])) // Verifica se o parâmetro 'nome' foi enviado via GET
    {
        $nome = ($_GET['nome']); // Atribui o valor à variável $nome
    }

    // Cria a query SQL com join entre produtos e categorias, buscando pelo nome do produto
    $sql = "SELECT produtos.*, categorias.nome AS categoria_nome
            FROM produtos
            INNER JOIN categorias ON produtos.categoria_id = categorias.id
            WHERE produtos.nome like '%$nome%'";

    $retorno = $con->query($sql); // Executa a query

    // Exibe cabeçalho da tabela conforme o número de resultados encontrados
    if ($retorno->num_rows == 1) {
        echo " 
         <table class = 'table table-hower'>
         <thead>
         <td>ID</td> 
         <td>NOME</td>
         <td>PREÇO</td>
         <td>NOME DA CATEGORIA ID</td>
         <td>IMAGEM</td>
         <td>OPÇÕES</td>
         </thead> 
         <p style='text-align: center;'>
            Encontrado $retorno->num_rows produtos.<br>
        </p>
         ";
    } else if ($retorno->num_rows > 1) {
        echo " 
         <table class = 'table table-hower'>
         <thead>
         <td>ID</td> 
         <td>NOME</td>
         <td>PREÇO</td>
         <td>NOME DA CATEGORIA</td>
         <td>IMAGEM</td>
         <td>OPÇÕES</td>
         </thead> 
         <p style='text-align: center;'>
            Encontrados $retorno->num_rows produtos.<br>
        </p>
         ";
    } else {
        // Caso nenhum produto seja encontrado com o nome pesquisado
        echo "Nenhum produto com o nome \"" . $nome . "\" foi encontrado. Tente novamente outro nome! <br>";
    }

    // Exibe cada produto encontrado em uma linha da tabela
    foreach ($retorno as $linha) {
        echo "
                <tr>
                    <td>" . $linha['id'] . "</td>
                    <td>" . $linha['nome'] . "</td>
                    <td>" . $linha['preco'] . "</td>   
                    <td>" . $linha['categoria_nome'] . "</td>                        
                    <td><img src='data:image/png;base64," . base64_encode($linha['imagem']) . "' class='imagem-produto'></td>                        
                    <td>
                        <a href='/rfstore_frontend/produto_deletar.php?id=" . $linha["id"] . "' class='btn btn-danger'> 🗑️ </a>
                        <a href='/rfstore_frontend/produto_alterar.php?id=" . $linha["id"] . "' class='btn btn-primary'> ✏️ </a>
                    </td>         
                </tr>
                ";
    }
?>

    </tbody>


</body>

</html>