<!-- in /templates/Users/login.php -->
<?php
$isTheme = isset($_COOKIE["theme"]);
if ($isTheme) {
    if ($_COOKIE["theme"] == "dark") {
        $background = "#2a2b2e";
        $background2 = "#34373B";
        $color = "#fff";
    } else {
        $background = "#f5f7fa";
        $background2 = "#f9f9f9";
        $color = "#363637";
    }
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
}
?>
<div class="barbero form">
    <?= $this->Flash->render() ?>
    <h3 style="color: <?php echo $color; ?> !important; ">Acceder</h3>
    <?= $this->Form->create() ?>
    <fieldset style="color: <?php echo $color; ?> !important; ">
        <legend style="color: <?php echo $color; ?> !important; "><?= __('Por favor ingresa tu email y contraseña.') ?>
        </legend>
        <?= $this->Form->control('email', ['required' => true, 'style' => 'color: ' . $color . '!important;']) ?>
        <?= $this->Form->control('clave', ['label' => 'Contraseña', 'type' => 'password', 'required' => true, 'style' => 'color: ' . $color . '!important;'],) ?>
    </fieldset>
    <?= $this->Form->submit(__('Ingresar')); ?>
    <?= $this->Html->link(__('Olvide mi contraseña'), ['action' => 'olvidarContrasena'], ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
    <!-- 
     -->
</div>