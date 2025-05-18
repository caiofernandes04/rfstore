<?php
    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
    header('location:index.php');
    }

    include("banco.php");

    $data = date('Y-m-d h:i:s');

    $sql_adicionar_vendas = "INSERT INTO vendas (data_venda) 
                            VALUES ('$data')";
    
    $con->query($sql_adicionar_vendas);

    $venda_id = $con->insert_id;

    foreach($_SESSION['carrinho'] as $item)
    {
        $produto_id = $item['id'];
        $quantidade = $item['quantidade'];

        $con->query("INSERT INTO vendas_itens (venda_id, produto_id, quantidade) 
                 VALUES ($venda_id, $produto_id, $quantidade)");
    }

    header("Location:agradecimento.php")
?>