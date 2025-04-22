<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SaleItem $saleItem
 * @var string[]|\Cake\Collection\CollectionInterface $sales
 * @var string[]|\Cake\Collection\CollectionInterface $fruits
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $saleItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $saleItem->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Sale Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="saleItems form content">
            <?= $this->Form->create($saleItem) ?>
            <fieldset>
                <legend><?= __('Edit Sale Item') ?></legend>
                <?php
                    echo $this->Form->control('sale_id', ['options' => $sales]);
                    echo $this->Form->control('fruit_id', ['options' => $fruits]);
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('unit_price');
                    echo $this->Form->control('discount_percent');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
