<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 * @var \Cake\Collection\CollectionInterface|string[] $fruits
 * @var float $total
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Listar Vendas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="sales form content">
            <?= $this->Form->create($sale) ?>
            <fieldset>
                <legend><?= __('Adicionar Venda') ?></legend>

                <!-- Campo para selecionar o vendedor (automaticamente usa o vendedor logado) -->
                <?= $this->Form->control('user_id', ['type' => 'hidden', 'value' => $this->request->getSession()->read('user.id')]); ?>

                <!-- Campo para selecionar a fruta -->
                <?= $this->Form->control('fruit_id', [
                    'label' => 'Fruta',
                    'type' => 'select',
                    'options' => $fruits,  // Certifique-se de que $fruits está sendo passado corretamente da controller
                    'empty' => 'Selecione uma fruta',
                ]) ?>

                <!-- Campo para quantidade -->
                <?= $this->Form->control('quantity', [
                    'label' => 'Quantidade',
                    'type' => 'number',
                    'min' => 1
                ]) ?>

                <!-- Campo para desconto -->
                <?= $this->Form->control('discount', [
                    'label' => 'Desconto (%)',
                    'type' => 'select',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                        25 => '25%'
                    ],
                    'empty' => 'Selecione o desconto'
                ]) ?>

                <!-- Exibição do valor total -->
                <div>
                    <p><strong>Total:</strong> R$ <?= number_format($total, 2, ',', '.') ?></p> <!-- Exibe o total com formatação de centavos -->
                </div>

            </fieldset>
            <?= $this->Form->button(__('Registrar Venda')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
