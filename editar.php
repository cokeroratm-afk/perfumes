<?php	
	
	session_start();
	include 'config.php';
	include 'ajudantes.php';
	include 'banco.php';
	include 'classes/Perfumes.php';

	$perfumes = new Perfumes($mysqli);
	$apresentar = false;
	$erros = false;
	$erros_validacao = array();

	if(tem_post()){
		
		$controla = array();
		
		if(!isset($_POST['perfume']) or $_POST['perfume'] == null){
			
			//Caso minha condição não seja a de cima, apresentara erro de variavel não definida
			//pois preciso validar o diferente de possuir e que seja nulo
            $erros = true;
			$erros_validacao['perfume'] = 'Não é permitido cadastro sem nome do perfume.';
		}else{
			$controla['perfume'] = $_POST['perfume'];
		}
		if(isset($_POST['essencia']) && strlen($_POST['essencia'])){
			$controla['essencia'] = $_POST['essencia'];
		}else{
			$erros=true;
			$erros_validacao['essencia'] = 'Não é permitido cadastro sem base.';
		}
			
		if(isset($_POST['veiculo'])){
			$controla['veiculo'] = $_POST['veiculo'];
		}else{
            $erros = true;
            $erros_validacao['essencia'] = 'Não é permitido cadastro sem declarar qual veículo.';
		}
		if(isset($_POST['volumetria'])){
			$controla['volumetria'] = $_POST['volumetria'];
		}else{
			$controla['volumetria'] = '';
		}
		if(isset($_POST['data']) && !$_POST['data'] == ""){
            $perfumes->data_salvar($_POST['data']);
            if($perfumes->result)
            {
                $controla['data'] = $_POST['data'];
            }else{
                $erros = true;
                $erros_validacao['data'] = 'Data informada é inválida';
            }
		}else{
			$controla['data'] = '0000-00-00';
		}
		if(isset($_POST['fixacao'])){
			$controla['fixacao'] = $_POST['fixacao'];
		}else{
			$controla['fixacao'] = '';
		}
		if(isset($_POST['projecao'])){
			$controla['projecao'] = $_POST['projecao'];
		}else{
			$controla['projecao'] = 'null';
		}
		if(isset($_POST['prioridade'])){
			$controla['prioridade'] = $_POST['prioridade'];
		}else{
			$controla['prioridade'] = 'null';
		}
		if(isset($_POST['concluida'])){
			$controla['concluida'] = $_POST['concluida'];
		}else{
			$controla['concluida'] = 'null';
		}
		if(isset($_POST['email'])){
			$controla['email'] = $_POST['email'];
		}else{
			$controla['email'] = 'null';
		}
        if(!$erros){
            $perfumes->alterar_perfumes($controla, $_GET['id']);

			if(isset($controla['email']) && $controla['email'] == 1){
				$perfumes->buscar_anexo($_GET['id']);
				$anexo = $perfumes->perfume;
				enviar_email($controla, $anexo,$perfumes);
			}
		    header('Location: perfumes.php');
		// Ao adicionar o header ele limpa o $_POST, fazendo com que não entre mais na função acima.
		    die();
		//die encerra e o sistema começa novamente do topo, agora sem os dados do $_POST devido o header
		//ter limpado ele. o die sem o header fica dando tela em branco em looping infinito, pois ele sempre tera o POST e sempre será encerrado no die.
        }
		
	}
	$perfumes->le_perfume($_GET['id']);
	if(!$erros){
		$controla['id'] = $perfumes->perfume['id'] ?: 0;
		$controla['perfume'] = $perfumes->perfume['perfume'] ?: '';
		$controla['essencia'] = $perfumes->perfume['essencia'] ?: '';
		$controla['veiculo'] = $perfumes->perfume['veiculo'] ?: '';
		$controla['volumetria'] = $perfumes->perfume['volumetria'] ?: '';
		$controla['data'] = $perfumes->perfume['data'] ?: '';	
		$controla['fixacao'] = $perfumes->perfume['fixacao'] ?: '';
		$controla['projecao'] = $perfumes->perfume['projecao'] ?: '';
		$controla['prioridade'] = $perfumes->perfume['prioridade'] ?: '';
		$controla['concluida'] = $perfumes->perfume['concluida'] ?: '';
		$controla['email'] = $perfumes->perfume['email'] ?: '';
	}
	
	include 'template.php';
?>