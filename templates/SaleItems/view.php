<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SaleItem $saleItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Sale Item'), ['action' => 'edit', $saleItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Sale Item'), ['action' => 'delete', $saleItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saleItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Sale Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Sale Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="saleItems view content">
            <h3><?= h($saleItem->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Sale') ?></th>
                    <td><?= $saleItem->hasValue('sale') ? $this->Html->link($saleItem->sale->id, ['controller' => 'Sales', 'action' => 'view', $saleItem->sale->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Fruit') ?></th>
                    <td><?= $saleItem->hasValue('fruit') ? $this->Html->link($saleItem->fruit->name, ['controller' => 'Fruits', 'action' => 'view', $saleItem->fruit->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($saleItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($saleItem->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Unit Price') ?></th>
                    <td><?= $this->Number->format($saleItem->unit_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discount Percent') ?></th>
                    <td><?= $saleItem->discount_percent === null ? '' : $this->Number->format($saleItem->discount_percent) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($saleItem->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>