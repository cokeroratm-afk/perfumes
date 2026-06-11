<form method="POST">
    <fieldset>
        <legend>Perfume</legend>
        <label>
            Nome do Perfume:
            <input type="text" name="perfume" value="<?php echo $controla['perfume'] ?>" />
        </label>
        <label>
            Essência:
            <input type="text" name="essencia" value="<?php echo $controla['essencia'] ?>" />
        </label>
        <label>
            Veículo:
            <select name="veiculo" required="required">
                <option value = "1" <?php echo $controla['veiculo'] == 1 ? 'selected' : ''; ?> >Base</option>
                <option value = "2" <?php echo $controla['veiculo'] == 2 ? 'selected' : ''; ?>>Água + Álcool</option>
            </select>
        </label>
        <label>
            Volumetria: Descreva porcentagem usada de cada insumo
            <textarea name="volumetria" value="<?php echo $controla['volumetria']; ?>" ></textarea>
        </label>
        <label>
            Data da atividade:
            <input type="date" name="data" value="<?php echo $controla['volumetria']?>"/>
        </label>
        <label>
            Escala de fixação:
            <input type="radio" name="fixacao" value="1" <?php echo $controla['fixacao'] ? 'checked' : ''?> />Baixa
            <input type="radio" name="fixacao" value="2" <?php echo $controla['fixacao'] ? 'checked' : ''?> />Média
            <input type="radio" name="fixacao" value="3" <?php echo $controla['fixacao'] ? 'checked' : ''?> />Alta
        </label>
        <label>
            Escala de Projeção:
            <input type="radio" name="projecao" value="1" <?php echo $controla['projecao'] ? 'checked' : '' ?> />Baixa
            <input type="radio" name="projecao" value="2" <?php echo $controla['projecao'] ? 'checked' : '' ?> />Média
            <input type="radio" name="projecao" value="3" <?php echo $controla['projecao'] ? 'checked' : '' ?> />Alta
        </label>
    </fieldset>

</form>