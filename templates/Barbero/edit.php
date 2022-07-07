<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbero $barbero
 * @var string[]|\Cake\Collection\CollectionInterface $barbershop
 */
if ($this->request->getAttributes()['identity'] != null) {
    $user_data = $_SESSION['Auth'];
    $image_url = '/img/perfil/' . $user_data['imagen_perfil'];
}

?>
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
<?= $this->Html->css(['mi_perfil']) ?>
<?php echo $this->Html->script('webroot\js\ocultar_contraseña.js'); ?>

<div class="row">
    <div class="column-responsive ">
        <div class="barbero form content" style="background-color: <?php echo $background2; ?>!important;">
            <?= $this->Form->create($barbero, ['type' => 'file']) ?>
            <fieldset style="color: <?php echo $color; ?> !important; ">
                <legend>Modificar mis datos</legend>

                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="img-foto-usuario" width="150px" src="<?= $image_url ?>">
                    </div>
                </div>

                <?php
                echo $this->Form->control('usuario', ['label' => 'Usuario', 'style' => 'color: ' . $color . ' !important; ']);
                echo $this->Form->control('nombre', ['label' => 'Nombre', 'style' => 'color: ' . $color . ' !important; ']);
                echo $this->Form->control('email', ['label' => 'Email', 'style' => 'color: ' . $color . ' !important; ']);

                echo $this->Form->control('imagen_perfil', ['type' => 'file', 'label' => 'Imagen de Perfil', 'required'
                => true]);
                echo $this->Form->control('tel', ['label' => 'Teléfono', 'style' => 'color: ' . $color . ' !important; ']);
                ?>
                <div hidden>
                    <?php
                    echo $this->Form->control('clave');
                    echo $this->Form->control('barbershop._ids', ['options' => $barbershop]);
                    ?>
                </div>
            </fieldset>

            <?= $this->Html->link(__('Cancelar'), ['action' => 'mi_perfil', $barbero->id], ['class' => 'button']) ?>

            <?= $this->Form->button(__('Guardar cambios')) ?>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>
</div>


</div>