<html>
	<head>
		<link rel="stylesheet" href="folha.css" type="text/css">
	</head>
<form method="POST">
	<fieldset>
		<input type="hidden" name="id" value=<?php echo $controla['id'] ?: 0; ?>>
		<legend>Perfume</legend>
		<label>
			Nome do perfume:
			<?php if($erros && isset($erros_validacao['perfume'])) : ?>
				<span class="erros">
					<?php echo $erros_validacao['perfume']; ?>
				</span>
			<?php endif; ?>
			<br>
			<input type="text" name="perfume" value="<?php isset($controla['perfume']) ? print($controla['perfume']): '' ?>" />
			<!-- Não se usa echo no térnario e sim print. Input acima -->
		</label>
		<br>
		<label>
			Essência:
			<?php if($erros && isset($erros_validacao['essencia'])) : ?>
				<span class="erros">
					<?php echo $erros_validacao['essencia']; ?>
				</span>
			<?php endif; ?>
			<br>
			<input type="text" name="essencia" value="<?php isset($controla['essencia']) ? print($controla['essencia']): '' ?>" />
		</label>
		<br>
		<label>
			Veículo:
			<?php if($erros && isset($erros_validacao['veiculo'])) : ?>
				<span class="erros">
					<?php echo $erros_validacao['veiculo']; ?>
				</span>
			<?php endif; ?>
			<select name="veiculo" required="required">
				<option selected value="">Escolha o Veículo</option>
				<option value="1" <?php echo ($controla['veiculo'] == 1) ? 'selected' : '' ;?> >Base</option>
				<option value="2" <?php echo ($controla['veiculo'] == 2) ? 'selected' : '' ;?> >Água + Álcool</option>
			</select>
		</label>
		<br>
		<label>
			Volumetria: Descreva porcentagem usada de cada insumo
			<textarea name="volumetria"><?php echo $controla['volumetria']; ?></textarea>
		</label>
		<label>
			Data da atividade:
			<?php if($erros && isset($erros_validacao['date'])) : ?>
				<span class="erros">
					<?php echo $erros_validacao['date']; ?>
				</span>
			<?php endif; ?>
			<input type="date" name="data" value="<?php print $controla['data']; ?>" />
			<!-- o formato da data para retornar corretamente deve ser "YYYY-mm-dd", ex: 2024-06-30 
			 não podendo haver espaço entre as aspas do value e abertura e fechamento do PHP-->
		</label>
		<fieldset>
				<legend>Escala de fixação:</legend>
				<input type="radio" name="fixacao" value="1" <?php echo $controla['fixacao'] == 1 ? 'checked' : ''; ?> />Baixa
				<input type="radio" name="fixacao" value="2" <?php echo $controla['fixacao'] == 2 ? 'checked' : ''; ?> />Média
				<input type="radio" name="fixacao" value="3" <?php echo $controla['fixacao'] == 3 ? 'checked' : ''; ?> />Alta
		</fieldset>
		<fieldset>
				<legend>Escala de Projeção:</legend>
				<input type="radio" name="projecao" value="1" <?php echo $controla['projecao'] == 1 ? 'checked' : ''; ?> />Baixa
				<input type="radio" name="projecao" value="2" <?php echo $controla['projecao'] == 2 ? 'checked' : ''; ?> />Média
				<input type="radio" name="projecao" value="3" <?php echo $controla['projecao'] == 3 ? 'checked' : ''; ?> />Alta
		</fieldset>
		<fieldset>
			<legend>Prioridade:</legend>
			<input type="radio" name="prioridade" value="1" <?php echo $controla['prioridade'] == 1 ? 'checked' : ''; ?>/>Baixa
			<input type="radio" name="prioridade" value="2" <?php echo $controla['prioridade'] == 2 ? 'checked' : ''; ?>/>Média
			<input type="radio" name="prioridade" value="3" <?php echo $controla['prioridade'] == 3 ? 'checked' : ''; ?> />Alta
		</fieldset>
		<label>
			Tarefa Concluída:
			<input type="checkbox" name="concluida" value="1"
			<?php echo ($controla['concluida'] == 1) ? 'checked' : '' ?>
			/>
		</label>
		<br>
		<label>
			E-mail:
			<input type="checkbox" name="email" value="1"
			<?php echo ($controla['email'] == 1) ? 'checked' : '' ?>
			/>
		</label>
	</fieldset>
	<input type="submit" value=<?php echo ($controla['id'] >0) ? "Atualizar" : "Cadastrar" ?>>
</form>
</html>