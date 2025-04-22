<h1>Vender Fruta</h1>

<?= $this->Form->create() ?>
<?= $this->Form->control('fruit_id', ['label' => 'Fruta', 'options' => $fruits]) ?>
<?= $this->Form->control('quantity', ['label' => 'Quantidade']) ?>
<?= $this->Form->control('discount', [
    'label' => 'Desconto (%)',
    'type' => 'select',
    'options' => ['0' => 'Sem desconto', '5' => '5%', '10' => '10%', '15' => '15%', '20' => '20%', '25' => '25%']
]) ?>
<?= $this->Form->button('Finalizar Venda') ?>
<?= $this->Form->end() ?>
