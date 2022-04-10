<?php 

//recupera dados do formulário
$nome_prato = $_POST['nome_prato'];
$descricao_prato = $_POST['descricao_prato'];
$preco_prato = $_POST['preco_prato'];
$especial_mes = $_POST['especial_mes'];
$categoria_prato = $_POST['categoria_prato'];
$restricao_alimentar = $_POST['restricao_alimentar'];
$foto = $_FILES['foto']['name']; //captura os dados da imagem

//conecta banco de dados
$con = new PDO("mysql:host=localhost;dbname=fridas", "root", "");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //mostra erro se tiver

    if (isset($_POST['cadastrar'])) {
      
        // Se existir, o form já foi enviado
            $stm = $con->prepare("INSERT INTO tb_pratos(nome_prato,descricao_prato,preco_prato,especial_mes,imagem,categoria_prato,restricao_alimentar) values (?,?,?,?,?,?,?)");
            $stm->bindValue(1,$_POST['nome_prato']);
            $stm->bindValue(2,$_POST['descricao_prato']);
            $stm->bindValue(3,$_POST['preco_prato']);
            $stm->bindValue(4,$_POST['especial_mes']);
            $stm->bindValue(5,$_FILES['foto']['name']); //salva nome da imagem no banco com a extensão
            $stm->bindValue(6,$_POST['categoria_prato']);
            $stm->bindValue(7,$_POST['restricao_alimentar']);

      //Verificar se os dados foram inseridos com sucesso
         if ($stm->execute()){
           
      //Recuperar último ID inserido no banco de dados
         $ultimo_id = $con->lastInsertId();

      //Diretório onde o arquivo vai ser salvo
         $diretorio = 'uploads/' . $ultimo_id.'/';

      //Cria a pasta de foto a partir do ultimo
      mkdir($diretorio, 777);
      
      //Move a imagem da pasta temporária para o diretório
      if(move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$foto)){
        $_SESSION['msg'] = "<p style='color:green;'>Dados salvo com sucesso e upload da imagem realizado com sucesso</p>";
          header("Location: home.php");
          
      }else{
          $_SESSION['msg'] = "<p><span style='color:green;'>Dados salvo com sucesso. </span><span style='color:red;'>Erro ao realizar o upload da imagem</span></p>";
          header("Location: home.php");
          }        
        }
    }else{
      echo 'Não foi possivel salvar dados no banco de dados';
    }
      
    ?>