<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publicacion[]|\Cake\Collection\CollectionInterface $publicacion
 */

use Seld\JsonLint\Undefined;

?>
<?php
$isTheme = isset($_COOKIE["theme"]);
if ($isTheme) {
    if ($_COOKIE["theme"] == "dark") {
        $background = "#2a2b2e";
        $background2 = "#34373B";
        $color = "#becdd9";
        $publicacion_bg = "#424952";
    } else {
        $background = "#f5f7fa";
        $background2 = "#f9f9f9";
        $color = "#363637";
        $publicacion_bg = "#fff";
    }
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
    $publicacion_bg = "#fff";
}
?>

<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<div class="barbero form">
    <?= $this->Flash->render() ?>
    <h3 style="color: <?php echo $color; ?> !important; ">Publicaciones</h3>
</div>
<?php
if ($isTheme) {
    if ($_COOKIE["theme"] == "dark") { ?>
        <?= $this->Html->css(['publicacionesDarkMode']) ?>
    <?php } else { ?>
        <?= $this->Html->css(['publicaciones']) ?>
    <?php
    }
} else { ?>
    <?= $this->Html->css(['publicaciones']) ?>
<?php
}
?>

<div class="publicacion index content" style="background-color: <?php echo $background2; ?>!important;">
    <?php
    if ($allowAddPost) {
    ?>
        <div class="tweet-wrap">
            <?= $this->Form->create($publicacion, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('CREAR PUBLICACIÓN') ?></legend>
                <?php
                echo $this->Form->control('contenido', array('label' => false, 'placeholder' => '¿Qué está pasando?'));
                //echo $this->Form->control('imagen', array('type' => 'file', 'label' => false));
                ?>
                <div class="arrastrarysubir" for="imagen" id="image-event-label">
                    <div id="drop_zone">Arrastra y suelta la imagen aquí</div>
                    <input type="file" name="imagen" id="imagen">
                </div>
                <output id="list"></output>



                <div hidden>
                    <?php
                    echo $this->Form->control('barbershop_id', ['options' => $barbershop, 'default' => $barbershopDeBarberoLogeado]);
                    ?>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Publicar')) ?>
            <?= $this->Form->end() ?>
        </div>
    <?php
    }
    ?>
    <?php
    ?>
    <?php foreach ($publicacionesInvertidas as $publicacion) : ?>
        <div class="tweet-wrap" style="background-color: <?php echo $publicacion_bg; ?>!important;">
            <div class="tweet-header">
                <?php
                $image_perfil_barbershop = "barbershop/default.png";
                $publicacion_fecha_creacion = '';
                if ($publicacion->barbershopInfo->imagen_perfil != null) {
                    $image_perfil_barbershop = 'barbershop/' . $publicacion->barbershopInfo->imagen_perfil;
                }
                if ($publicacion->created != null) {
                    $publicacion_fecha_creacion = $publicacion->created->format('d/m/Y');
                }

                ?>
                <a href="/barbershop/ver/<?= $publicacion->barbershopInfo->id; ?>"><?= $this->Html->image($image_perfil_barbershop,  array('alt' => 'default.png', 'class' => 'avator')); ?></a>
                <div class="tweet-header-info">
                    <div class="horizontal-container">
                        <div>
                            <b class="tweet-publicacion-nombre"><a href="http://localhost:8765/barbershop/ver/<?= $publicacion->barbershopInfo->id; ?>"><?= $publicacion->barbershopInfo->nombre; ?></a></b>
                            <span>@<?= $publicacion->barbershopInfo->nombre; ?></span><span><?= $publicacion_fecha_creacion; ?>
                            </span>
                        </div>
                        <?php
                        $isBarberoLogeadoID = isset($barbershopDeBarberoLogeado);
                        if ($isBarberoLogeadoID) {
                            if ($barbershopDeBarberoLogeado == $publicacion->barbershopInfo->id) {
                                echo $this->Form->create($publicacion, array('action' => 'Pages/eliminarPublicacion'));
                                //echo $this->Form->create($publicacion, ['type' => 'put']);
                        ?>

                                <input type="hidden" name="publicacion_to_delete_id" value="<?= $publicacion->id; ?>">

                                <div>
                                    <button class="btnEliminar" type="submit"><i class="material-icons">delete</i></button>
                                </div>
                        <?php
                                echo $this->Form->end();
                            }
                        } ?>
                    </div>
                    <p style="color: <?php echo $color; ?> !important; "> <?= $publicacion->contenido; ?> </p>
                </div>
            </div>
            <div class="tweet-img-wrap">
                <?= !file_exists($publicacion->image_urlServer) ? $this->Html->image($publicacion->image_urlServer,  array('alt' => '', 'class' => 'tweet-img')) : '' ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>


<script>
    // only to show it did change
    $('#imagen').on('change', function upload(evt) {
        console.log(this.files[0]);
        document.getElementById('list').innerHTML = '<div id="ProgressBar"><div id="Progress"></div></div>';
    });

    // only to show where is the drop-zone:
    $('#image-event-label').on('dragenter', function() {
            this.classList.add('dragged-over');
        })
        .on('dragend drop dragexit dragleave', function() {
            this.classList.remove('dragged-over');
        });
</script>