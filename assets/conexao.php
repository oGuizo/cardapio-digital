<?php 
// session_start inicia a sessão
session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
echo $usuario;
echo $senha;
// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.

//USANDO PDO (MYSQL_CONNECT TÁ OBSOLETO problemas com sqlinject, PHP parou de dar suporte)
$con = new PDO("mysql:host=localhost;dbname=fridas", "root", ""); 
$stmt = $con->prepare("SELECT * FROM tb_usuarios WHERE usuario = ? AND senha = ? LIMIT 1");
$stmt->bindParam(1, $usuario); // o primeiro ? recebe usuario
$stmt->bindParam(2, $senha); // o segundo ? recebe senha
$stmt->execute();
$row = $stmt->fetch();

if($row==null){ //ve se nao tem retorno
	echo "Por favor, entre com usuario e senha corretos";
	return; // retorna (interrompe execucao aqui pode tirar o echo e chamar uma pagina de erro)
}
// n precisa else pq ja retornei
$id = $row[0]; //id
$nome = $row[1]; //nome redundancia pois já tem no $_POST nao precisa
$senha = $row[2]; //senha redundancia pois já tem no $_POST nao precisa
$_SESSION['usuario'] = $usuario; // seta sessão
$_SESSION['id'] = $id; // seta user id

header('location:home.php'); // redireciona

?>