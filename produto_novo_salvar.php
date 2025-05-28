<?php
    include("banco.php");
    // Inclui o arquivo com a conexão ao banco de dados.

    session_start();
    // Inicia a sessão para verificar se o usuário está autenticado.

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
        header('location:index.php');
        // Se não houver login e senha válidos na sessão, redireciona para a página de login.
    }

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $categoria_id = $_POST["categoria_id"];
    // Coleta os dados enviados pelo formulário via método POST.

    $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    // Lê o conteúdo do arquivo de imagem enviado (como binário).

    $imagem = $con->real_escape_string($imagem);
    // Escapa caracteres especiais da imagem para evitar erros na SQL.

    $sql = "INSERT INTO produtos (`nome`, `preco`, `imagem`, `categoria_id`) 
            VALUES ('$nome', '$preco', '$imagem', '$categoria_id')";
    // Monta a query de inserção do novo produto, incluindo a imagem binária.

    $con->query($sql);
    // Executa a query no banco de dados.

    header('location:produtos.php');
    // Redireciona o usuário de volta para a listagem de produtos.
?>
