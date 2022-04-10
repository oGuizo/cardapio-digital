<?php
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$con = new PDO("mysql:host=localhost;dbname=fridas", "root", "");
$pdo_statement=$con->prepare("delete from tb_pratos where id=" . $_GET['id']);
$pdo_statement->execute();
header('location: produto.php')
?>