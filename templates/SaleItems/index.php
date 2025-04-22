<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\SaleItem> $saleItems
 */
?>
<div class="saleItems index content">
    <?= $this->Html->link(__('New Sale Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sale Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('sale_id') ?></th>
                    <th><?= $this->Paginator->sort('fruit_id') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('unit_price') ?></th>
                    <th><?= $this->Paginator->sort('discount_percent') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($saleItems as $saleItem): ?>
                <tr>
                    <td><?= $this->Number->format($saleItem->id) ?></td>
                    <td><?= $saleItem->hasValue('sale') ? $this->Html->link($saleItem->sale->id, ['controller' => 'Sales', 'action' => 'view', $saleItem->sale->id]) : '' ?></td>
                    <td><?= $saleItem->hasValue('fruit') ? $this->Html->link($saleItem->fruit->name, ['controller' => 'Fruits', 'action' => 'view', $saleItem->fruit->id]) : '' ?></td>
                    <td><?= $this->Number->format($saleItem->quantity) ?></td>
                    <td><?= $this->Number->format($saleItem->unit_price) ?></td>
                    <td><?= $saleItem->discount_percent === null ? '' : $this->Number->format($saleItem->discount_percent) ?></td>
                    <td><?= h($saleItem->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $saleItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $saleItem->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $saleItem->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $saleItem->id),
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
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>