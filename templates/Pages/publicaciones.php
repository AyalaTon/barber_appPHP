<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publicacion[]|\Cake\Collection\CollectionInterface $publicacion
 */
?>
<?php
if ($_COOKIE["theme"] == "dark") {
    $background = "#2a2b2e";
    $background2 = "#121316";
    $color = "#fff";
    $publicacion_bg = "#424952";
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
    $publicacion_bg = "#fff";
}
?>

<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<div class="barbero form">
    <?= $this->Flash->render() ?>
    <h3 style="color: <?php echo $color; ?> !important; ">Publicaciones</h3>
</div>
<?= $this->Html->css(['publicaciones']) ?>
<div class="publicacion index content" style="background-color: <?php echo $background2; ?>!important;">
    <?php
    if ($allowAddPost) {
    ?>
    <div class="tweet-wrap" style="background-color: <?php echo $publicacion_bg; ?>!important;">
        <?= $this->Form->create($publicacion, ['type' => 'file']) ?>
        <fieldset>
            <legend style="color: <?php echo $color; ?> !important; "><?= __('CREAR PUBLICACIÓN') ?></legend>
            <?php
                echo $this->Form->control('contenido', array('label' => false, 'placeholder' => '¿Qué está pasando?', 'style' => 'color: ' . $color . '!important;'));
                echo $this->Form->control('imagen', array('type' => 'file', 'label' => false));
                ?>
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
    if ($allowAddPost) {
    ?>
    <!--<a href="http://localhost:8765/publicacion/add"><button class="float-right" style="height: 70px"> <img src="/img/NewPost.png" style="width: 65px; height: 65px"></img> </button></a>-->
    <?php
    }
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
            <?= $this->Html->image($image_perfil_barbershop,  array('alt' => 'default.png', 'class' => 'avator')); ?>
            <div class="tweet-header-info" style="color: <?php echo $color; ?> !important; ">
                <?= $publicacion->barbershopInfo->nombre; ?>
                <span>@<?= $publicacion->barbershopInfo->nombre; ?></span><span><?= $publicacion_fecha_creacion; ?>
                </span>
                <p> <?= $publicacion->contenido; ?> </p>
            </div>
        </div>
        <div class="tweet-img-wrap">

            <?= !file_exists($publicacion->image_urlServer) ? $this->Html->image($publicacion->image_urlServer,  array('alt' => '', 'class' => 'tweet-img')) : '' ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>