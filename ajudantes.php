<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
	function tem_post(){
		if(count($_POST) > 0){
			return true;
		}
			return false;
	}

	/*Warning: Undefined array key "apagar" in C:\xampp\htdocs\Curso PHP\PHP_e_MySQL\nova_tarefa\Perfumes\ajudantes.php on line 10
	Para resolver isso deve veriicar com o isset, pois se não ele alegará que não existe o apagar. Pode ser feito um if ternario também, que neste caso não se aplica. Seria $validar['apagar']['arquivo'] ? $variavel : null; ou $apagar = $_GET['apagar'] ?? null;
	*/
	function contem_get($validar){
		if(isset($validar['apagar']['arquivo']) && isset($validar['apagar']['id_anexo'])){
			return true;
		}else{
			return false;
		}
	}

	function tratar_anexo($anexo){
		$padrao = '/^.+(\.pdf|\.zip)$/';
		$resultado = preg_match($padrao,$anexo['name']);

		if(! $resultado){
			return false;
		}

		move_uploaded_file($anexo['tmp_name'], "anexos/{$anexo['name']}");

		return true;
	}

	function proporção($veiculo, $frasco){
		//ex do calculo: 20% * 20ml = 4ml (fragrancia) e 80% * 20ml = 16ml (base)
		if($veiculo == 1){
			$fragrancia = (20/100) * $frasco;
			$base = (80/100) * $frasco;
			return "A fabricação utilizando \"Base\" requer: $fragrancia ml de fragrância e $base ml de base";
		}else{
			// 6% agua, 74% alcool, 20% essencia.
			$agua = (6/100) * $frasco;
			$alcool = (74/100) * $frasco;
			$essencia = (20/100) * $frasco;
			return "A fabricação utilizando \"Alcool + Água\" requer: $agua ml de água, $alcool ml de álcool e $essencia ml de essência.";
		}
	}

	function enviar_email($controla, $anexos = array(), $perfumes){

        require ('../bibliotecas/PHPMailer/src/PHPMailer.php');
        require ('../bibliotecas/PHPMailer/src/SMTP.php');
        require ('../bibliotecas/PHPMailer/src/Exception.php');

        // Acessar o sistema de e-mails;
        // Fazer a autenticacao com usuário e senha;
        // Usar a opção para fazer um e-mail;

        $email = new PHPMailer(true); // Esta é a criação do objeto
        try{
            //$email->SMTPDebug = SMTP::DEBUG_SERVER;
            //Ativar acima somente se o sistema der erro, para ter o debug
            $email->isSMTP();
            $email->Host = "smtp.gmail.com";
            $email->Port = 587;
            $email->SMTPSecure = 'tls';
            $email->SMTPAuth = true;
            $email->Username = "cokeroratm@gmail.com"; 
            $email->Password = "pujc lgud emkg mvse";
            $email->setFrom("cokeroratm@gmail.com", "Avisador de Tarefas");
            // Digitar o e-mail do destinatário;
            $email->addAddress("cokeroratm@hotmail.com"); 
            // Digitar o assunto do e-mail;
            $email->Subject = "Aviso de tarefa: {$controla['perfume']}";
            // Escrever o corpo do e-mail;
            $corpo = preparar_corpo_email($controla,$anexos, $perfumes);
            $email->msgHTML($corpo);
            // Adicionar os anexos quando necessário;
			if($anexos['anexo'] != null && count($anexos['anexo']) > 0){
				foreach($anexos as $anexo){
                	$email->addAttachment("anexos/{$anexo['arquivo']}");
            	}
			}
            
            // Usar a opção de enviar o e-mail.
            if($email->send()){
                echo 'Email enviado com sucesso';
            }else{
                echo 'Email não enviado';
            }
        }catch(Exception $e){
            echo "Erro ao enviar mensagem: {$email->ErrorInfo}";
        }
    }

	function preparar_corpo_email($controla, $anexos,$perfumes){
        // Aqui vamos pegar o conteúdo processado do template_email.php

        // Falar para o PHP que não é para enviar o processamento para o navegador:
        ob_start();

        // Incluir o arquivo template_email.php:
        include "template_email.php";

        // Guardar o conteúdo do arquivo em uma variável;
        $corpo = ob_get_contents();

        // Falar para o PHP que ele pode voltar a mandar conteúdos para o navegador:
        ob_end_clean();

        return $corpo;
    }

	/*function salvar_perfumes($mysqli, $controla){
		$salva = "INSERT INTO perfumes (perfume, essencia, veiculo, volumetria, data, fixacao, projecao) VALUES (
		'{$controla['perfume']}',
		'{$controla['essencia']}',
		{$controla['veiculo']},'
		{$controla['volumetria']}',
		'{$controla['data']}',
		{$controla['fixacao']},
		{$controla['projecao']})";
	}
		*/
?>