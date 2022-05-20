<div class="barbero form">
    <?= $this->Flash->render() ?>
    <h3>Recuperar Contraseña</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Por favor, ingrese su nueva contraseña') ?></legend>
        <?= $this->Form->control('clave',['type'=>'password'], ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Cambiar contraseña')); ?>
    <?= $this->Form->end() ?>
</div>