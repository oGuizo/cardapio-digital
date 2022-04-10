<?php

session_start();
  $mensagens = array(
    "usuario" => "<h1>Painel administrativo</h1>"
  );
?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <title>Painel administrativo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/styled.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> <!--importa jquery-->
  <script>
    $(document).ready(()=>{
      $('#sair').click(()=>{
        $(location).attr('href', 'sair.php')
      })
      $('#entrar').click(()=>{
        $(location).attr('href', 'login.php')
      })
    })
  </script>
</head>
<body>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="home.php">
      <img src="assets/img/fridas_logo.png" width="100" height="30" alt="">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="">Inicio</a></li>
        <li><a href="produto.php">Pratos cadastrados</a></li>
        <?php
           if(isset($_SESSION['usuario'])){ // se estiver logado
          if($_SESSION['usuario'] == 'admin'){ // compara se usuario logado for igual a admin então ele mostrará os menus de 'cadastro'
            echo '<li><a href="cadastro_produto.php">Cadastros de produtos </a></li>';
            echo '<li><a href="cadastro_user.php">Usuários</a></li>';
          }
        }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(isset($_SESSION['usuario'])){ 
          echo '<li><a href="#" id="sair"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>';
        } else {
          echo '<li><a href="#" id="entrar"><span class="glyphicon glyphicon-log-in"></span> Logar</a></li>';
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Painel administrativo</h1>
      <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if(isset($_SESSION['usuario'])){ // se estiver logado
          if($_SESSION['usuario'] != 'admin'){ // pode tirar o if e madnar direto se nao se importar em ver a msg, ta ligado?
            echo $mensagens['usuario'];
          }
        }
      ?>
      <p>
      <hr>
    </div>
    <div class="col-sm-2 sidenav">
    </div>
  </div>
</div>
</body>
</html>
