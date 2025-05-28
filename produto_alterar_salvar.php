<?php
    include("banco.php");
    // Inclui o arquivo banco.php, contendo a conexão com o banco de dados.

    session_start();
    // Inicia a sessão para controle de acesso.

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
        header('location:index.php');
        // Se o usuário não estiver logado (login e senha não definidos na sessão), redireciona para a página de login.
    }

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $categoria_id = $_POST["categoria_id"];
    // Recebe os dados do formulário enviados via POST: id do produto, nome, preço e categoria.

    // Se enviou nova imagem no formulário
    if(!empty($_FILES['imagem']['tmp_name'])) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        // Lê o conteúdo binário da imagem enviada.

        $imagem = $con->real_escape_string($imagem);
        // Escapa caracteres especiais para evitar problemas na query.

        $sql_imagem = ", `imagem` = '$imagem'";
        // Prepara a parte da query para atualizar a imagem no banco, se houver.
    } else {
        $sql_imagem = "";
        // Caso não tenha enviado imagem, não altera o campo `imagem`.
    }

    $sql = "UPDATE `produtos` 
            SET `nome` = '$nome', 
                `preco` = '$preco'
                $sql_imagem,
                `categoria_id` = '$categoria_id' 
            WHERE `produtos`.`id` = '$id'";
    // Monta a query de atualização do produto com os novos dados.
    // O campo `imagem` só é atualizado se uma nova imagem foi enviada.

    $con->query($sql);
    // Executa a query no banco.

    header("location:produtos.php");
    // Redireciona para a página produtos.php após a atualização.
?>
