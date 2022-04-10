<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Sao_Paulo');
//dados do banco no servidor local

$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'fridas';

try {

	$pdo = new PDO("mysql:dbname=$banco;host=$servidor", "$usuario", "$senha");
	
} catch (Exception $e) {
	echo 'Erro ao conectar com o banco!! '. $e;
}
 ?>