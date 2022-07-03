<?php
if ($_COOKIE["theme"] == "dark") {
    $background = "#2a2b2e";
    $background2 = "#121316";
    $color = "#fff";
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
}
?>
<div class="barbero form" style="color: <?php echo $color; ?> !important; ">
    <?= $this->Flash->render() ?>
    <h3 style="color: <?php echo $color; ?> !important; ">Recuperar Contraseña</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend style="color: <?php echo $color; ?> !important; "><?= __('Por favor, ingrese su correo electrónico.') ?>
        </legend>
        <?= $this->Form->control('email', ['label' => 'Email', 'required' => true, 'style' => 'color: ' . $color . '!important;']) ?>
    </fieldset>
    <?= $this->Form->submit(__('Recuperar Contraseña')); ?>
    <?= $this->Html->link(__('Iniciar Sesión'), ['action' => 'login'], ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>