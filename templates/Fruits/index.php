<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Fruit> $fruits
 */
?>
<div class="fruits index content">
    <?= $this->Html->link(__('New Fruit'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Fruits') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('classification') ?></th>
                    <th><?= $this->Paginator->sort('is_fresh') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fruits as $fruit): ?>
                <tr>
                    <td><?= $this->Number->format($fruit->id) ?></td>
                    <td><?= h($fruit->name) ?></td>
                    <td><?= h($fruit->classification) ?></td>
                    <td><?= h($fruit->is_fresh) ?></td>
                    <td><?= $this->Number->format($fruit->quantity) ?></td>
                    <td><?= $this->Number->format($fruit->price) ?></td>
                    <td><?= h($fruit->created) ?></td>
                    <td><?= h($fruit->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $fruit->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fruit->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $fruit->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $fruit->id),
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