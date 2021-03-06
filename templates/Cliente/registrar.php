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
<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel">
        <h2 class="text-center" style="color: <?php echo $color; ?> !important; ">Registrar</h2>
        <?= $this->Form->create($cliente, ['type' => 'file']) ?>
        <fieldset style="color: <?php echo $color; ?> !important; ">
            <legend>Registrar Cliente</legend>
            <?php
            echo $this->Form->control('usuario', ['label' => 'Usuario', 'required' => true, 'style' => 'color: ' . $color . '!important;']);
            echo $this->Form->control('nombre', ['label' => 'Nombre', 'required' => true, 'style' => 'color: ' . $color . '!important;']);
            echo $this->Form->control('email', ['label' => 'Email', 'required' => true, 'style' => 'color: ' . $color . '!important;']);
            echo $this->Form->control('clave', ['type' => 'password', 'label' => 'Contraseña', 'required' => true, 'style' => 'color: ' . $color . '!important;']);
            echo $this->Form->control('confirmar_clave', ['type' => 'password', 'label' => 'Confirmar Contraseña', 'required' => true, 'style' => 'color: ' . $color . '!important;']);
            echo $this->Form->control('imagen_perfil', ['type' => 'file', 'label' => 'Imagen de Perfil', 'style' => 'color: ' . $color . '!important;']);
            echo $this->Form->control('tel', ['label' => 'Teléfono', 'style' => 'color: ' . $color . '!important;']);
            echo $this->Form->submit('Registrar', array('class' => 'button'));
            ?>
        </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>