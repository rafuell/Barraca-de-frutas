<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Fruit> $fruits
 */

// Configurar o fuso horário para Fortaleza, Ceará (Brasília)
date_default_timezone_set('America/Fortaleza');
?>
<div class="frutas index content">
    <?= $this->Html->link(__('Nova Fruta'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Frutas') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('name', 'Nome') ?></th>
                    <th><?= $this->Paginator->sort('classification', 'Classificação') ?></th>
                    <th><?= $this->Paginator->sort('is_fresh', 'Está Fresca?') ?></th>
                    <th><?= $this->Paginator->sort('quantity', 'Quantidade') ?></th>
                    <th><?= $this->Paginator->sort('price', 'Preço (R$)') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Criado em') ?></th>
                    <th><?= $this->Paginator->sort('modified', 'Atualizado em') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fruits as $fruit): ?>
                <tr>
                    <td><?= $this->Number->format($fruit->id) ?></td>
                    <td><?= h($fruit->name) ?></td>
                    <td><?= h($fruit->classification) ?></td>
                    <td><?= $fruit->is_fresh ? 'Sim' : 'Não' ?></td>
                    <td><?= $this->Number->format($fruit->quantity) ?></td>
                    <td>R$ <?= $this->Number->format($fruit->price) ?></td>
                    <td><?= h($fruit->created->format('d/m/Y H:i:s')) ?></td>
                    <td><?= h($fruit->modified->format('d/m/Y H:i:s')) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fruit->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fruit->id]) ?>
                        <?= $this->Form->postLink(
                            __('Excluir'),
                            ['action' => 'delete', $fruit->id],
                            [
                                'method' => 'post',
                                'confirm' => __('Tem certeza que deseja excluir o registro # {0}?', $fruit->id),
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
