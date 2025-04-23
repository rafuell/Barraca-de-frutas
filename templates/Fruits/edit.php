<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fruit $fruit
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Form->postLink(
                __('Excluir'),
                ['action' => 'delete', $fruit->id],
                ['confirm' => __('Tem certeza de que deseja excluir # {0}?', $fruit->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Listar Frutas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="fruits form content">
            <?= $this->Form->create($fruit) ?>
            <fieldset>
                <legend><?= __('Editar Fruta') ?></legend>
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
                    
                    // Exibir a data de modificação no formato em português
                    echo $this->Form->control('last_modified', [
                        'label' => 'Última Modificação',
                        'type' => 'text',
                        'value' => $fruit->last_modified ? $fruit->last_modified->format('d/m/Y H:i:s') : 'Nunca'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
