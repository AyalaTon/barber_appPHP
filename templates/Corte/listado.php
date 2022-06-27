<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Corte[]|\Cake\Collection\CollectionInterface $corte
 */
?>
<div class="row">
    <div class="column-responsive">
        <div class="corte index content">
            <div class="row">
                <div class="column column-25">
                    <?php 
                        $image_url = '/img/perfil/' . $barbero[0]['imagen_perfil']; 
                    ?>
                    <img class="img_perfil_barbershop" src="<?= $image_url ?>" alt="">
                </div>
                <div class="column column-75">
                     <div class="row">
                        <h5>
                            <b><?= h($barbero[0]['usuario']) ?></b>
                        </h5>
                    </div>
                    <div class="row">Nombre: <?= h($barbero[0]['nombre']) ?> </div>
                    <div class="row">Correo eléctronico: <?= h($barbero[0]['email']) ?></div>
                </div>
            </div>
            <section class="cards">
                <?php foreach ($cortes as $corte) : ?>
                <div class="card" onclick="window.location.href = '/reserva/corte/<?= $corte->id; ?>';">
                    <img src='<?= h($corte->imagen) ?>'>
                    <h2><?= h($corte->nombre) ?></h2>
                    <h4>Precio: <b>$<?= $this->Number->format($corte->precio) ?></b></h4>
                    <!--            
                    <div class="detalles">
                        <p><b>Descripción:</b> <?= h($corte->descripcion) ?></p>
                    </div> -->
                </div>
                <?php endforeach; ?>
            </section>
        </div>
    </div>
</div>