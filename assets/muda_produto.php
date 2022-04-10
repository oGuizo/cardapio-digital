<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=fridas", "root", "");
$sql = 'SELECT id,nome_prato, descricao_prato, preco_prato, imagem, categoria_prato FROM tb_pratos WHERE id ='.$_GET['id'];
    $query = $con->prepare($sql);
    $query->execute();
    $pratos = $query->fetchAll();

?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <title>Cadastro de produto</title>
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
      <img src="assets/img/cloudlogo.png" width="100" height="30" alt="">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="home.php">Inicio</a></li>
        <li><a href="produto.php">Pratos cadastrados</a></li>
        <?php
           if(isset($_SESSION['usuario'])){ // se estiver logado
          if($_SESSION['usuario'] == 'admin'){ // compara se usuario for igual a admin então ele mostrará o menu 'cadastro'
            echo '<li class="active"><a href="#">Cadastros de produtos</a></li>';
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
    <div class="col-sm-8 text-left"></br>

  <!-- Formulario de cadastro -->
  <?php foreach($pratos as $prato): ?>
   <form enctype="multipart/form-data" action="altera_produto.php" method="POST">
   <div class="form-group">
    <label for="exampleFormControlInput1">Código: </label>
    <input type="text" class="form-control" name="id" value=<?php echo $prato['id']; ?> readonly>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Nome do prato</label>
    <input type="text" class="form-control" name="nome_prato" id="titulo" value="<?php echo $prato['nome_prato']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Descrição</label>
    <textarea class="form-control" name="descricao_prato" id="descricao" rows="3"><?php echo $prato['descricao_prato']; ?></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Preço do prato</label>
    <input type="number" class="form-control" name="preco_prato" id="preco_prato" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any" value="<?php echo $prato['preco_prato'];?>">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Promoção do mês</label>
    <select class="form-control" name="especial_mes" id="especial_mes"> 
       <option value="Sim">Sim</option>
       <option selected value="Não">Não</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Categoria</label>
    <select class="form-control" name="categoria_prato" required> 
       <option><?php echo $prato['categoria_prato'];?></option>
       <option value="tacos">Tacos</option>
       <option value="burritos">Burritos</option>
       <option value="hamburguer">Hamburguer</option>
       <option value="tacos">Tacos</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Sem Glutén?</label>
    <select class="form-control" name="restricao_alimentar" id="restricao_alimentar"> 
       <option value="Sim">Sim</option>
       <option selected value="Não">Não</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Imagem</label>
    <input type="file" class="form-control" name="foto">
    <input type="hidden" class="form-control" name="img" value=<?php echo $prato['imagem'] ?>>
  </div>
  <?php endforeach; ?>
  <button type="submit" name="altera_cadastro" class="btn btn-success">Alterar registro</button>
  <button type="submit" name="volta" class="btn btn-danger">Cancelar alteração</button>
</form>
<!-- Fim formulário -->  
      <hr>
    </div>
    <div class="col-sm-2 sidenav">
  </div>
  </div>
</div>
</body>
</html>
