<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publicacion[]|\Cake\Collection\CollectionInterface $publicacion
 */
?>


<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<div class="barbero form">
    <?= $this->Flash->render() ?>
    <h3>Publicaciones</h3>
</div>
<?= $this->Html->css(['publicaciones']) ?>
<div class="publicacion index content">
    <?php
    if ($allowAddPost) {
    ?>
        <div class="tweet-wrap">
            <?= $this->Form->create($publicacion, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('CREAR PUBLICACIÓN') ?></legend>
                <?php
                echo $this->Form->control('contenido', array('label' => false));
                echo $this->Form->control('imagen', array('type' => 'file','label'=>false));
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
        <div class="tweet-wrap">
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
                <div class="tweet-header-info">
                    <?= $publicacion->barbershopInfo->nombre; ?> <span>@<?= $publicacion->barbershopInfo->nombre; ?></span><span><?= $publicacion_fecha_creacion; ?>
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