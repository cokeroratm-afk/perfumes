<?php 
    session_start();
    include 'config.php';
    include 'banco.php';
    include 'ajudantes.php';
    include 'classes/Perfumes.php';

    $perfume = new Perfumes($mysqli);

    $erros = false;
	$erros_validacao = array();

    if(!isset($_GET['id'])){
        $_GET['id'] = $_SESSION['id'];
    }
    if(contem_get($_GET)){
        if(file_exists("anexos/{$_GET["apagar"]["arquivo"]}")){
            unlink("anexos/{$_GET["apagar"]["arquivo"]}");
            echo "Apagado!";
            $perfume->anexo_apagar($_GET["apagar"]["id_anexo"]);
            $_SESSION['id'] = $_GET["apagar"]["id_perfume"];
            header('location:perfume.php');
            unset($_GET['apagar']);
            die();
        }else{
            $perfume->anexo_apagar($_GET["apagar"]["id_anexo"]);
            $_SESSION['id'] = $_GET["apagar"]["id_perfume"];
            echo "Arquivo não encontrado!";
            unset($_GET['apagar']);
            header('location:perfume.php');
            die();
        }
    }

    if(tem_post()){
        // upload dos anexos

        $perfume_id = $_POST['perfume_id'];

        if(!isset($_FILES['anexo'])){
            $tem_erros = true;
            $erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar';
        }else{
            if(tratar_anexo($_FILES['anexo'])){
                //Se executar anexo dar certo, que é a movimentação de pegar o arquivo temporario e salvar no diretório indicado, pode continuar a salvar o nome no banco de dados.
                $anexo = array();
                $anexo['perfume_id'] = $perfume_id;
                $anexo['nome'] = $_FILES['anexo']['name'];
                $anexo['arquivo'] = $_FILES['anexo']['name'];
            }else{
                $erros = true;
                $erros_validacao['anexo'] = 'Envie apenas anexos nos formatos zip ou pdf';
            }
        }
        if(! $erros){
            $perfume->gravar_anexo($anexo);
        }
    }

    if(isset($_GET['id']) || isset($_SESSION['id'])){
        if($_GET['id']){
            $perfume->le_perfume($_GET['id']);
            $perfume->buscar_anexo($_GET['id']);
        }else{
            $perfume->le_perfume($_SESSION['id']);
            $perfume->buscar_anexo($_SESSION['id']);
            unset($_SESSION['id']);
        }
        $perfume->proporcao($perfume->perfume["veiculo"], 20);
    }

    include 'template_perfume.php';

?>