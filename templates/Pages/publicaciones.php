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
    <?php foreach ($publicacionesInvertidas as $publicacion) : ?>
        <div class="tweet-wrap">
            <div class="tweet-header">
                <img src="https://i.imgur.com/NtMjMeh.jpg" alt="" class="avator">
                <div class="tweet-header-info">
                    <?= $publicacion->barbershopInfo->nombre ?> <span>@BarberoDueño</span><span>01/18/2001 (En un futuro...)
                    </span>
                    <p><?= $publicacion->contenido ?></p>
                </div>
            </div>
            <div class="tweet-img-wrap">
                <img src="<?= $publicacion->imagen ?>" alt="" class="tweet-img">
            </div>
        </div>
    <?php endforeach; ?>
</div>