<div class="barbero form">
    <?= $this->Flash->render() ?>
    <h3>Recuperar Contraseña</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Por favor, ingrese su correo electrónico.') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Recuperar Contraseña')); ?>
    <?= $this->Html->link(__('Iniciar Sesión'), ['action' => 'login'], ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>