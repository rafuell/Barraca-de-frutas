<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sale> $sales
 */
?>
<div class="sales index content">
    <?= $this->Html->link(__('Nova Venda'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Vendas') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('user_id', 'Usuário') ?></th>
                    <th><?= $this->Paginator->sort('total', 'Total (R$)') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Criado em') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= $this->Number->format($sale->id) ?></td>
                    <td><?= $sale->hasValue('user') ? $this->Html->link($sale->user->name, ['controller' => 'Users', 'action' => 'view', $sale->user->id]) : '' ?></td>
                    <td>R$ <?= number_format($sale->total, 2, ',', '.') ?></td> <!-- Alterado para exibir com 2 casas decimais -->
                    <td><?= h($sale->created->format('d/m/Y H:i:s')) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $sale->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $sale->id]) ?>
                        <?= $this->Form->postLink(
                            __('Excluir'),
                            ['action' => 'delete', $sale->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Tem certeza que deseja excluir a venda # {0}?', $sale->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primeira')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('próxima') . ' >') ?>
            <?= $this->Paginator->last(__('última') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, exibindo {{current}} registro(s) de {{count}} no total')) ?></p>
    </div>
</div>
