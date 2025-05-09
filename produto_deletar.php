<?php

    include("banco.php");

    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
    header('location:index.php');
    }

    $id = $_GET['id'];

    $sql = "DELETE FROM produtos WHERE `produtos`.`id` = '$id'";
    $con->query($sql);

    header('location:produtos.php');
?>
