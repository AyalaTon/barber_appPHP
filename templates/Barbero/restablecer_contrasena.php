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
<div class="barbero form" style="color: <?php echo $color; ?> !important; ">
    <?= $this->Flash->render() ?>
    <h3 style="color: <?php echo $color; ?> !important; ">Recuperar Contraseña</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend style="color: <?php echo $color; ?> !important; "><?= __('Por favor, ingrese su nueva contraseña') ?>
        </legend>
        <?= $this->Form->control('clave', ['type' => 'password', 'required' => true, 'style' => 'color: ' . $color . '!important;']) ?>
    </fieldset>
    <?= $this->Form->submit(__('Cambiar contraseña')); ?>
    <?= $this->Form->end() ?>
</div>