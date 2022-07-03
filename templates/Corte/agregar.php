<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Corte $corte
 * @var \Cake\Collection\CollectionInterface|string[] $barbero
 */
?>
<?php
if ($_COOKIE["theme"] == "dark") {
    $background = "#2a2b2e";
    $background2 = "#121316";
    $color = "#fff";
    $colorDropdown = "#424952";
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
    $colorDropdown = "#363637";
}
?>
<div class="row">
    <!-- <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Corte'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside> -->
    <div class="column-responsive">
        <div class="corte form content" style="background-color: <?php echo $background2; ?>!important;">
            <?= $this->Form->create($corte) ?>
            <fieldset style="color: <?php echo $color; ?> !important; ">
                <legend><?= __('Añadir corte') ?></legend>
                <div hidden>
                    <?php
                    echo $this->Form->control('barbero_id', ['options' => $barbero, 'default' => $barberoLogeado]);
                    echo $this->Form->control('imagen', ['id' => 'imagenFinal', 'default' => $listaImagenes[164]]);
                    ?>
                </div>
                <img src='<?= $listaImagenes[164] ?>' id='imagenMuestra' alt='imagen de corte'>

                <?php
                echo $this->Form->control('tipo', ['options' => $listaNombre, 'value' => $listaNombre, 'id' => 'tipoCorteTxt', 'style' => 'color: ' . $colorDropdown . ' !important; ']);
                echo $this->Form->control('nombre', [/*'readonly' => 'readonly', */'id' => 'nombre', 'autocomplete' => 'off', 'style' => 'color: ' . $color . ' !important; ']);
                echo $this->Form->control('descripcion', [/*'readonly' => 'readonly',*/'id' => 'descripcion', 'autocomplete' => 'off', 'type' => 'textarea', 'rows' => '10', 'style' => 'color: ' . $color . ' !important; ']);
                echo $this->Form->control('precio', ['autocomplete' => 'off', 'min' => '0', 'style' => 'color: ' . $color . ' !important; ']);
                echo $this->Form->control('tiempo_estimado', ['step' => '1800', 'default' => '00:30:00', 'min' => '00:30:00', 'max' => '05:00:00']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
            <!-- <?php
                    // echo $this->html->link('tipoCorte', ['options' => $tipoCorte]);
                    ?> -->
        </div>
    </div>
</div>

<script type="text/javascript">
// jQuery(document).ready(function($) {
var imgenes = <?php echo json_encode($listaImagenes); ?>;
var descripciones = <?php echo json_encode($listaDescripciones); ?>;
$(function() {
    $('#tipoCorteTxt').change(function() {
        // $( "#tipoCorteTxt option:selected" ).text())
        $('#nombre').val($("#tipoCorteTxt option:selected").text());
        // var imgen = $("#tipoCorteTxt option:selected"); 
        // imgenes[$("#tipoCorteTxt option:selected").val()];
        $('#imagenMuestra').attr("src", imgenes[$("#tipoCorteTxt option:selected").val()]);
        $('#descripcion').val(descripciones[$("#tipoCorteTxt option:selected").val()]);
        $('#imagenFinal').val(imgenes[$("#tipoCorteTxt option:selected").val()]);
    });
});
</script>