<!-- in /templates/Users/login.php -->
<div class="barbero form">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Por favor ingresa tu email y contraseña.') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('clave', ['label' => 'Contraseña', 'type' => 'password', 'required' => true],) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login')); ?>
    <?= $this->Html->link(__('Olvide mi contraseña'), ['action' => 'olvidarContrasena'], ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
    <!-- 
     -->
</div>