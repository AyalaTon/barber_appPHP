<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Corte[]|\Cake\Collection\CollectionInterface $corte
 */
?>
<div class="corte index content">
    <h1>Cortes disponibles</h1>

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