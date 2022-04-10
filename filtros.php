<?php
include_once("conexao/conexao.php");
ini_set('display_errors',0); //esconde mensagem de erro, NÃO DEIXAR. Fazer o tratamento do erro depois

$filtro = $_POST['filtro']; //captura dado do filtro
    
if($filtro != null){ //se a condição for algum dos filtros selecionados diferente de nulo, mostra somente os filtrados
    $sql = "SELECT id,nome_prato, descricao_prato, preco_prato, imagem, restricao_alimentar FROM tb_pratos WHERE categoria_prato = '$filtro'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $pratos = $query->fetchAll();

}else{ //se nenhuma opção for do filtro mostra tudo que tem no cardápio
    $sql = 'SELECT id,nome_prato, descricao_prato, preco_prato, imagem, restricao_alimentar FROM tb_pratos';
    $query = $pdo->prepare($sql);
    $query->execute();
    $pratos = $query->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="pt_Br">
<head>
    <title>Cardápio digital</title>
    <!-- Tags obrigatórias -->
    <meta charset="UTF-8">
    <meta name="generator" content="Cardápio Mexicano - Fridas Food Mexican - Criciúma - SC">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" lang="pt_Br" content="O melhor cardápio da cidade de Criciúma">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <meta name="description" content="">
    <!--Font Awesome-->
    <link rel="stylesheet" href="dist/font-awesome/css/font-awesome.min.css" />
    <!-- CSS Customizada -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
    <div class="loader"></div>
    <header id="header">
        <div class="collapse" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-12 py-4">
                    <h4>Filtros</h4>
        <form action="filtros.php" method="POST">        
        <select class="custom-select custom-select-lg" id="gender2" name='filtro'>
          <option selected value="">Todos</option>
          <option value="burritos">Burritos</option>
          <option value="hamburguer">Hambúrguer</option>
          <option value="tacos">Tacos</option>
          <option value="bebidas">Bebidas</option>
        </select>
            <div class="d-flex justify-content-center align-items-center mt-2">
            <button type="submit" name="pesquisa" class="btn btn-success btn btn-block">Pesquisar</button>
        </div>
</form>
        </div>
                </div>
                    </div>
                    <div class="col-sm-2 offset-md-1 py-4" id="contact-info">
                        <h4>Contato</h4>
                        <ul class="list-unstyled">
                            <li>
                                <a href="https://www.instagram.com/fridasmexfood/?hl=pt-br" target="_top">
                                    <i class="fa fa-instagram"></i>@fridasmexfood</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-light box-shadow">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand" href="index.php" id="header-logo">
                    <img src="img/fridas_logo.png" class="img-fluid" alt="fridas_logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>
    <main id="main" role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" id="collection-heading">
                        <span>Faça sua melhor escolha</span>
                    </div>
                </div>
                <div class="row">
                <?php foreach($pratos as $prato): ?>
                     <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <?php
                 //Se nome da imagem for nulo, vai mostrar uma imagem padrão, senão, mostra imagem que foi upada
                             if($prato['imagem']==null){
                                echo '<img class="card-img-top" src="assets/uploads/thumbnail.jpg">';
                              }else{
                                echo '<img class="card-img-top" src="assets/uploads/'.$prato['id'].'/'. $prato['imagem'].'">';
                              }
                            ?>
                            <div class="card-body">                               
                                <h3 class="text-muted"><?php echo $prato["nome_prato"]; ?></h3>
                                <p class="card-text"><?php echo mb_strtolower($prato["descricao_prato"]); ?></p>
                                <h4 class="text-muted">R$<?php echo $prato["preco_prato"]; ?></h4>
                                <?php 
                                    if($prato['restricao_alimentar']=='Sim'){
                                        echo '<p class="card-text">Opção sem glúten:<b>+R$3,00</b></p>';
                                    }
                                    else{
                                        echo '<p class="card-text" id="texto-gluten">Não possui opção sem glúten</p>';
                                    }
                                ?>
                                  <!--Futura atualização vai ser usada
                                  <div class="btn-group">
                                  <button type="button" class="btn btn-sm btn-outline-danger">Fazer pedido</button>
                                  </div>-->
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-primary scrollUp">
            <i class="fa fa-arrow-circle-o-up"></i>
        </a>
    </main>
    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">Todos os direitos reservados - &copy;
            <span id="currentYear"></span> - Fridas Food Mexican.
        </p>
    </footer>
    <!-- jQuery primeiro, então Bootstrap JS. -->
    <script src="dist/jquery/jquery.min.js"></script>
    <script src="dist/popper/popper.min.js" integrity=""></script>
    <script src="dist/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.min.js"></script>
</body>

</html>