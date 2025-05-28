<?php
    // Inicia a sessão para acessar as variáveis de sessão
    session_start();

    // Verifica se o usuário está logado. Se não estiver, redireciona para a página de login (index.php)
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        header('location:index.php');
    }

    include("banco.php");

    // Obtém a data e hora atual 
    $data = date('Y-m-d h:i:s');

    // Cria um novo registro na tabela 'vendas' com a data atual
    $sql_adicionar_vendas = "INSERT INTO vendas (data_venda) 
                            VALUES ('$data')";
    
    // Executa o comando SQL para inserir a venda
    $con->query($sql_adicionar_vendas);

     // Recupera o ID da venda recém-inserida no banco de dados
    $venda_id = $con->insert_id;

    // Loop que percorre todos os itens do carrinho
    foreach($_SESSION['carrinho'] as $item)
    {
         // Pega o ID do produto e a quantidade comprada
        $produto_id = $item['id'];
        $quantidade = $item['quantidade'];

         // Insere os itens da venda na tabela 'vendas_itens', associando à venda recém-criada
        $con->query("INSERT INTO vendas_itens (venda_id, produto_id, quantidade) 
                 VALUES ($venda_id, $produto_id, $quantidade)");
    }

    // Redireciona o usuário para a página de agradecimento após concluir a venda
    header("Location:agradecimento.php")
?>