<?php
require_once("conexao/conexao.php");

$filtro = $_POST['filtro']; //captura dado do filtro
    
if($filtro == "burritos"){ //se a condição for burritos, mostra somente os burritos
    $sql = 'SELECT id,nome_prato, descricao_prato, preco_prato, imagem FROM tb_pratos WHERE categoria_prato = "burritos"';
    $query = $pdo->prepare($sql);
    $query->execute();
    $pratos = $query->fetchAll();

}else if($filtro == 'hamburguer'){ //se a condição for hamburguer, mostra somente os hamburguer
    $sql = 'SELECT id,nome_prato, descricao_prato, preco_prato, imagem FROM tb_pratos WHERE categoria_prato = "hamburguer"';
    $query = $pdo->prepare($sql);
    $query->execute();
    $pratos = $query->fetchAll();

}else if($filtro == "bebidas"){ //se a condição for bebidas, mostra somente os bebidas
    $sql = 'SELECT id,nome_prato, descricao_prato, preco_prato, imagem FROM tb_pratos WHERE categoria_prato = "bebidas"';
    $query = $pdo->prepare($sql);
    $query->execute();
    $pratos = $query->fetchAll();
    
}else if($filtro == "tacos"){ //se a condição for bebidas, mostra somente os bebidas
    $sql = 'SELECT id,nome_prato, descricao_prato, preco_prato, imagem FROM tb_pratos WHERE categoria_prato = "tacos"';
    $query = $pdo->prepare($sql);
    $query->execute();
    $pratos = $query->fetchAll();
    
}else{ //se nenhuma opção for do filtro mostra tudo no cardápio
    $sql = 'SELECT id,nome_prato, descricao_prato, preco_prato, imagem FROM tb_pratos';
    $query = $pdo->prepare($sql);
    $query->execute();
    $pratos = $query->fetchAll();
}
header('location: filtros.php');
?>