<table>
    <tr>
        <th>Nome do Perfume</th>
        <th>Essência</th>
        <th>Veículo</th>
        <th>Volumetria</th>
        <th>Data</th>
        <th>Escala de fixação</th>
        <th>Escala de Projeção</th>
        <th>Prioridade</th>
        <th>Tarefa Concluída</th>
        <th>E-mail</th>
        
    </tr>
    <?php foreach($perfumes->perfumes as $perfume) : ?>
        <tr>
            <td><a href='perfume.php?id=<?php echo $perfume['id'] ?>'><?php echo $perfume['perfume'] ?></a></td>
            <td><?php echo $perfume['essencia'] ?></td>
            <td><?php $perfumes->veiculo($perfume['veiculo']); $perfumes->veiculo ? print $perfumes->veiculo : '' ?></td>
            <td><?php echo $perfume['volumetria'] ?></td>
            <td><?php $perfumes->data($perfume['data']); $perfumes->datas ? print $perfumes->datas : '' ?></td>
            <td><?php $perfumes->fixacao($perfume['fixacao']); $perfumes->fixacao ? print $perfumes->fixacao : '' ?></td>
            <td><?php $perfumes->projecao($perfume['projecao']); $perfumes->projecao ? print $perfumes->projecao : '' ?></td>
            <td><?php $perfumes->prioridade($perfume['prioridade']); $perfumes->prioridade ? print $perfumes->prioridade : '' ?></td>
            <td><?php $perfumes->concluida($perfume['concluida']); $perfumes->concluida ? print $perfumes->concluida : '' ?></td>
            <td><?php $perfumes->email($perfume['email']); $perfumes->email ? print $perfumes->email : '' ?></td>

            <td><a href='editar.php?id=<?php echo $perfume['id'] ?>'>Editar</a></td>
            <td><a href='remover.php?id=<?php echo $perfume['id'] ?>'>Remover</a></td>
        </tr>
    <?php endforeach; ?>
</table>