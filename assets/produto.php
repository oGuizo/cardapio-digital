<?php

session_start();

?>
<!DOCTYPE html>
<html lang="pt_Br">
<head>
  <title>Listagem</title>
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
     <a class="navbar-brand" href="index.php">
      <img src="assets/img/fridas_logo.png" width="100" height="30" alt="">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="home.php">Inicio</a></li>
        <li class="active"><a href="#">Pratos cadastrados</a></li>
        <?php
           if(isset($_SESSION['usuario'])){ // se estiver logado
          if($_SESSION['usuario'] == 'admin'){ // compara se usuario for igual a admin então ele mostrará o menu 'cadastro'
            echo '<li><a href="cadastro_produto.php">Cadastros de produtos </a></li>';
            echo '<li><a href="cadastro_user.php">Usuários </a></li>';
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
    <hr>
      <table class="table table-striped">
          <thead>
          <tr class='active'>
            <th style="border-top-left-radius: 10px;">Nome prato</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Promoção</th>
            <th>Categoria</th>
            <th>Especial</th>
            <th></th>
            <th style="border-top-right-radius: 10px;"></th>
            <tbody>
            <?php
            // pra registrar vai ter que usar a seguinte query 
              $con = new PDO("mysql:host=localhost;dbname=fridas", "root",""); 
              // seleciona todos servicoes quando usuario criador for igual a sessão de id correspondente (seta em conexao.php) então faz o fetch para poder exibir como array via foreach (para cada um; faça)
              $stmt = $con->query("SELECT * FROM tb_pratos ")->fetchAll(PDO::FETCH_ASSOC);
              foreach($stmt as $row) //cada item em stmt (que é um array) vai ser setado em $row tipo quando i = 0 $row = array[i], o i está implicito (na verdade isso continua sendo um for por baixo dos panos)
              {
              ?>
              <tr>
                  <td><?php echo $row['nome_prato'];?></td>
                  <td><?php echo $row['descricao_prato']?></td>
                  <td><?php echo $row['preco_prato']; ?></td>
                  <td><?php echo $row['especial_mes']; ?></td>
                  <td><?php echo $row['categoria_prato']; ?></td>
                  <td><?php echo $row['restricao_alimentar']; ?></td>
                  <td><a class="btn btn-danger" href='apagar_produto.php?id=<?php echo $row['id']; ?>' > Apagar Registro</a></td>
                  <td><a class="btn btn-warning" href='muda_produto.php?id=<?php echo $row['id']; ?>' > Editar Registro</a></td>
                </tr>
                <?php
              }
             ?>
            </tbody>
          </tr> 
        </table>
      <hr>
    </div>
    <div class="col-sm-2 sidenav">
    </div>
  </div>
</div>
</body>
</html>
