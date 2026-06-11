<html>
    <head>
        <meta charset="utf-8" />
        <title>Gerenciador de Perfumes</title>
        <link rel="stylesheet" href="folha.css" type="text/css" />
    </head>
    <body>
        <h1>Perfume: <?php echo $perfume->perfume['perfume']; ?></h1>
        <p>
            <a href="perfumes.php">Voltar para a lista de perfumes</a>
        </p>
        <p>
            <strong>Concluída:</strong>
            <?php $perfume->concluida($perfume->perfume['concluida']); $perfume->concluida ? print $perfume->concluida : '' ?>
            <!-- É enviado $perfume->perfume['concluida'], que retornará $perfume->concluida, pois é o atributo do metodo 01/12/2025 -->
        <br>
            <strong>Essência: </strong>
            <?php echo nl2br($perfume->perfume['essencia']); ?>
            <!-- Cada enter entre linhas faz com que o nl2br pule a linha -->
        <br>
            <strong>Volumetria:</strong>
            <?php echo ($perfume->perfume['volumetria']); ?>
        <br>
            <strong>Data da Atividade:</strong>
            <?php $perfume->data($perfume->perfume['data']); print $perfume->datas ?: ''  ?>
        <br>
            <strong>Escala de fixação:</strong>
            <?php $perfume->fixacao($perfume->perfume['fixacao']); print $perfume->fixacao ?: '' ?>
        <br>
            <strong>Escala de Projecão:</strong>
            <?php $perfume->projecao($perfume->perfume['projecao']); print $perfume->projecao ?: '' ?>
            <br>
            <strong>Prioridade:</strong>
            <?php $perfume->prioridade($perfume->perfume['prioridade']); print $perfume->prioridade ?: '' ?>
        <br>
            <strong>Receita:</strong>
            <?php echo $perfume->proporcao ?>
        </p>

        <h2>Anexos</h2>

        <!-- lista de anexos -->
        
        <table>
            <tr>
                <th>Arquivos</th>
                <th>Opções</th>
            </tr>
            <?php if($perfume->perfume['anexo'] != null && count($perfume->perfume['anexo']) > 0) : ?>
                <?php $anexos[] = $perfume->perfume['anexo']; ?>
            <!-- Como o objeto não foi executado no foreach, adicionei o mesmo dentro de um array.
                Criar o array como o exemplo acima e jogar os dados dentro. -->

                <?php foreach($anexos as $anexo) : ?>
                    <tr>
                        <td><?php echo $anexo['nome']; ?></td>
                        <td>
                            <a href="anexos/<?php echo $anexo['arquivo']; ?>" target="_blank">Download</a>
                        </td>
                        <td>
                            <a href="perfume.php?apagar[arquivo]=<?php echo urlencode($anexo['arquivo'])?>&apagar[id_anexo]=<?php echo urlencode($anexo["id"])?>&apagar[id_perfume]=<?php echo urlencode($perfume->perfume['id'])?>" >Apagar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        

        <!-- formulário para um novo anexo -->
        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Anexo</legend>
                <input type="hidden" name="perfume_id" value="<?php echo $perfume->perfume['id']; ?>" />
                <!-- neste momento o objeto $tarefa enviara via post o tarefa_id para o tarefa.php -->

                <label>
                    <?php if($erros && isset($erros_validacao['anexo'])) : ?>
                        <span class="erros">
                            <?php echo $erros_validacao['anexo']; ?>
                        </span>
                    <?php endif; ?>
                    <input type="file" name="anexo" >
                </label>
                <input type="submit" value="Anexar">
            </fieldset>
        </form>
    </body>
</html>