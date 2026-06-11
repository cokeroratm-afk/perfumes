<?php	
	
	session_start();
	include 'config.php';
	include 'ajudantes.php';
	include 'banco.php';
	include 'classes/Perfumes.php';

	$perfumes = new Perfumes($mysqli);
	$apresentar = true;
	$erros = false;
	$erros_validacao = array();
	
	if(tem_post()){
		
		$controla = array();
		$controla['id'] = $_POST['id'];
		if(!isset($_POST['perfume']) or $_POST['perfume'] == null){
			
			//Caso minha condição não seja a de cima, apresentara erro de variavel não definida
			//pois preciso validar o diferente de possuir e que seja nulo
			$erros = true;
			$erros_validacao['perfume'] = 'Não é permitido cadastro sem nome do perfume.';
		}else{
			$controla['perfume'] = $_POST['perfume'];
			$controla['essencia'] = $_POST['essencia'];
		}
		if(isset($_POST['essencia']) && strlen($_POST['essencia']) > 0){
			$controla['essencia'] = $_POST['essencia'];
		}else{
			$erros = true;
			$erros_validacao['essencia'] = 'Não é permitido cadastro sem essencia.';
		}
		if(isset($_POST['veiculo']) && strlen($_POST['veiculo']) > 0){
			$controla['veiculo'] = $_POST['veiculo'];
		}else{
			$erros = true;
			$erros_validacao['veiculo'] = 'Não é permitido cadastro sem veículo.';
		}
		if(isset($_POST['volumetria']) && strlen($_POST['volumetria']) > 0){
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
		if(isset($_POST['fixacao']) && strlen($_POST['fixacao']) > 0){
			$controla['fixacao'] = $_POST['fixacao'];
		}else{
			$controla['fixacao'] = 'null';
		}
		if(isset($_POST['projecao']) && strlen($_POST['projecao']) > 0){
			$controla['projecao'] = $_POST['projecao'];
		}else{
			$controla['projecao'] = 'null';
		}
		if(isset($_POST['concluida']) && strlen($_POST['concluida']) > 0){
			$controla['concluida'] = $_POST['concluida'];
		}else{
			$controla['concluida'] = 'null';
		}
		if(isset($_POST['prioridade']) && strlen($_POST['prioridade']) > 0){
			$controla['prioridade'] = $_POST['prioridade'];
		}else{
			$controla['prioridade'] = 'null';
		}
		if(isset($_POST['email']) && strlen($_POST['email']) > 0){
			$controla['email'] = $_POST['email'];
		}else{
			$controla['email'] = 'null';
		}

		if(!$erros){
			$perfumes->salvar_perfumes($controla);
			enviar_email($controla, $anexos, $perfumes);
			header('Location: perfumes.php');
		// Ao adicionar o header ele limpa o $_POST, fazendo com que não entre mais na função acima (tem_post()).
			die();
		//die encerra e o sistema começa novamente do topo, agora sem os dados do $_POST devido o header
		//ter limpado ele. o die sem o header fica dando tela em branco em looping infinito, pois ele sempre tera o POST e sempre será encerrado no die.
		}
	}
	$perfumes->le_perfumes();
	if(!$erros){
		$controla['id'] = 0;
		$controla['perfume'] = '';
		$controla['essencia'] = '';
		$controla['veiculo'] = '';
		$controla['volumetria'] = '';
		$controla['data'] = '';	
		$controla['fixacao'] = '';
		$controla['projecao'] = '';
		$controla['concluida'] = '';
		$controla['prioridade'] = '';
		$controla['email'] = '';
	}
	
	include 'template.php';
?>