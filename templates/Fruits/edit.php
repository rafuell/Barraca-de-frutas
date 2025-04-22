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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $fruit->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $fruit->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Fruits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="fruits form content">
            <?= $this->Form->create($fruit) ?>
            <fieldset>
                <legend><?= __('Edit Fruit') ?></legend>
                <?php
                    echo $this->Form->control('name', ['label' => 'Nome da Fruta']);
                    echo $this->Form->control('classification', [
                        'label' => 'Classificação',
                        'type' => 'select',
                        'options' => [
                            'Extra' => 'Extra',
                            'Primeira' => 'Primeira',
                            'Segunda' => 'Segunda',
                            'Terceira' => 'Terceira'
                        ],
                        'empty' => 'Selecione a classificação'
                    ]);
                    echo $this->Form->control('is_fresh', ['label' => 'Está fresca?']);
                    echo $this->Form->control('quantity', ['label' => 'Quantidade em Estoque']);
                    echo $this->Form->control('price', ['label' => 'Preço (R$)']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
