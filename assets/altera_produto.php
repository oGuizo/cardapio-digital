<?php
//recupera dados do formulário
$id = $_POST['id'];
$nome_prato = $_POST['nome_prato'];
$descricao_prato = $_POST['descricao_prato'];
$preco_prato = $_POST['preco_prato'];
$especial_mes = $_POST['especial_mes'];
$categoria_prato = $_POST['categoria_prato'];
$restricao_alimentar = $_POST['restricao_alimentar'];
$foto = $_FILES['foto']['name']; //captura os dados da imagem
$img = $_POST['img'];

//conecta banco de dados
$con = new PDO("mysql:host=localhost;dbname=fridas", "root", "");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //mostra erro se tiver
    if (isset($_POST['altera_cadastro'])){
      
    $stm=$con->prepare("UPDATE tb_pratos SET nome_prato = '$nome_prato', descricao_prato = '$descricao_prato', preco_prato = '$preco_prato', especial_mes = '$especial_mes', imagem = '$foto', categoria_prato = '$categoria_prato',restricao_alimentar='$restricao_alimentar' WHERE id = '$id'");
            $stm->bindValue(1,$_POST['nome_prato']);
            $stm->bindValue(2,$_POST['descricao_prato']);
            $stm->bindValue(3,$_POST['preco_prato']);
            $stm->bindValue(4,$_POST['especial_mes']);
            $stm->bindValue(5,$_FILES['foto']['name']); //salva nome da imagem no banco com a extensão
            $stm->bindValue(6,$_POST['categoria_prato']);
            $stm->bindValue(7,$_POST['restricao_alimentar']);
            //Verificar se os dados foram inseridos com sucesso
         if ($stm->execute()) {
    
          //Diretório onde o arquivo vai ser salvo
             $diretorio = 'uploads/' . $id.'/';
          
          //Move a imagem da pasta temporária para o diretório
          if(move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$foto)){
              header("Location: produto.php");
              //aqui ele analisa se o $foto ta vazio, se tiver vazio ele mantém o nome do banco
          }else if(empty($foto)){
            $stm=$con->prepare("UPDATE tb_pratos SET imagem = '$img' WHERE id = '$id'");
            $stm->execute();
          }
       }
    }
      header("Location: produto.php");
      
    ?>