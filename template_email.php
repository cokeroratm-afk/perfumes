<html>
    <head>
        <meta charset="utf-8" />
        <title>Gerenciador de Perfumes</title>
        <link rel="stylesheet" href="folha.css" type="text/css" />
    </head>
    <body>
        <p>
            <h1>Perfume: <?php echo $controla['perfume']; ?></h1>
        </p>
        <p>
            <strong>Concluída:</strong>
            <?php $perfumes->concluida($controla['concluida']); $perfumes->concluida ? print $perfumes->concluida : '' ?>
            <!-- É enviado $controla['concluida'], que retornará $perfume->concluida, pois é o atributo do metodo 01/12/2025 -->
        <br>
            <strong>Essência</strong>
            <?php echo nl2br($controla['essencia']); ?>
            <!-- Cada enter entre linhas faz com que o nl2br pule a linha -->
        <br>
            <strong>Veículo:</strong>
            <?php $perfumes->veiculo($controla['veiculo']); $perfumes->veiculo ? print $perfumes->veiculo : "" ?>
        <br>
            <strong>Volumetria:</strong>
            <?php echo ($controla['volumetria']); ?>
        <br>
            <strong>Data da Atividade:</strong>
            <?php $perfumes->data($controla['data']); print $perfumes->datas ?: 'Indefinida'  ?>
        <br>
            <strong>Escala de fixação:</strong>
            <?php $perfumes->fixacao($controla['fixacao']); print $perfumes->fixacao ?: '' ?>
        <br>
            <strong>Escala de Projecão:</strong>
            <?php $perfumes->projecao($controla['projecao']); print $perfumes->projecao ?: '' ?>
        <br>
            <strong>Prioridade:</strong>
            <?php $perfumes->prioridade($controla['prioridade']); print $perfumes->prioridade ?: 'Baixa' ?>
        <br>
            <strong>Receita:</strong>
            <?php echo $perfumes->proporcao($controla["veiculo"], 20); ?>
        </p>
        <?php if(isset($anexos) && count($anexos) > 0) : ?>
            <p><strong>Atenção!</strong>Esta tarefa contém anexos!</p>
        <?php endif; ?>
    </body>
</html>