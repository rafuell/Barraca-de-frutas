<?php
/**
 * @var \App\View\AppView $this
 * @var array $vendas
 * @var array $vendedores
 * @var float $totalGeral
 */
?>

<h1>Relatório de Vendas</h1>

<?= $this->Form->create(null) ?>
<fieldset>
    <legend>Filtros</legend>
    <div style="margin-bottom: 10px;">
        <?= $this->Form->control('vendedor_id', [
            'label' => 'Vendedor',
            'options' => $vendedores,
            'empty' => 'Todos',
        ]) ?>
    </div>
    <div style="margin-bottom: 10px;">
        <?= $this->Form->control('data_inicio', [
            'label' => 'Data Início',
            'type' => 'date'
        ]) ?>
    </div>
    <div style="margin-bottom: 10px;">
        <?= $this->Form->control('data_fim', [
            'label' => 'Data Fim',
            'type' => 'date'
        ]) ?>
    </div>
</fieldset>
<?= $this->Form->button('Gerar Relatório') ?>
<?= $this->Form->end() ?>

<?php if (!empty($vendas)): ?>
    <h2>Resultado</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Data</th>
                <th>Vendedor</th>
                <th>Frutas Vendidas</th>
                <th>Total da Venda</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendas as $venda): ?>
                <tr>
                    <td><?= $venda->created->format('d/m/Y H:i') ?></td>
                    <td><?= h($venda->user->name) ?></td>
                    <td>
                        <ul>
                            <?php foreach ($venda->sale_items as $item): ?>
                                <li>
                                    <strong>Fruta:</strong> <?= h($item->fruit->name) ?> <br>
                                    <strong>Quantidade:</strong> <?= $item->quantity ?> <br>
                                    <strong>Preço Unitário:</strong> R$ <?= number_format($item->unit_price, 2, ',', '.') ?> <br>
                                    <strong>Desconto:</strong> <?= $item->discount_percent ?>%
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>R$ <?= number_format($venda->total, 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total Geral:</th>
                <th>R$ <?= number_format($totalGeral, 2, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
<?php elseif ($this->request->is('post')): ?>
    <p><strong>Nenhuma venda encontrada com os filtros selecionados.</strong></p>
<?php endif; ?>
