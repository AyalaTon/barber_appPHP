<!-- in /templates/Users/login.php -->
<div class="barbero form">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('clave',['type'=>'password'], ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login')); ?>
    <?= $this->Html->link(__('Olvide mi contraseña'), ['action' => 'olvidarContrasena'], ['class'=>'button']) ?>
    <?= $this->Form->end() ?>
<!-- 
     -->
</div>