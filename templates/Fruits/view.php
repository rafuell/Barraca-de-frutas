<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fruit $fruit
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Fruit'), ['action' => 'edit', $fruit->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Fruit'), ['action' => 'delete', $fruit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fruit->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Fruits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Fruit'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="fruits view content">
            <h3><?= h($fruit->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($fruit->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Classification') ?></th>
                    <td><?= h($fruit->classification) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($fruit->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($fruit->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($fruit->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($fruit->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($fruit->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Fresh') ?></th>
                    <td><?= $fruit->is_fresh ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Sale Items') ?></h4>
                <?php if (!empty($fruit->sale_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Sale Id') ?></th>
                            <th><?= __('Fruit Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Unit Price') ?></th>
                            <th><?= __('Discount Percent') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($fruit->sale_items as $saleItem) : ?>
                        <tr>
                            <td><?= h($saleItem->id) ?></td>
                            <td><?= h($saleItem->sale_id) ?></td>
                            <td><?= h($saleItem->fruit_id) ?></td>
                            <td><?= h($saleItem->quantity) ?></td>
                            <td><?= h($saleItem->unit_price) ?></td>
                            <td><?= h($saleItem->discount_percent) ?></td>
                            <td><?= h($saleItem->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SaleItems', 'action' => 'view', $saleItem->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SaleItems', 'action' => 'edit', $saleItem->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'SaleItems', 'action' => 'delete', $saleItem->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $saleItem->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>