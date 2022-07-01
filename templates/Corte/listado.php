<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Corte[]|\Cake\Collection\CollectionInterface $corte
 */
?>

<?php
if ($_COOKIE["theme"] == "dark") {
    $background = "#2a2b2e";
    $background2 = "#121316";
    $color = "#fff";
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
}
?>
<div style="background-color: <?php echo $background2; ?>!important;" class="corte index content">
    <h1 style="color: <?php echo $color; ?> !important; ">Cortes disponibles</h1>

    <section class="cards">
        <?php foreach ($cortes as $corte) : ?>
        <div class="card" onclick="window.location.href = '/reserva/corte/<?= $corte->id; ?>';">
            <img src='<?= h($corte->imagen) ?>'>
            <h2><?= h($corte->nombre) ?></h2>
            <h4>Precio: <b>$<?= $this->Number->format($corte->precio) ?></b></h4>
        </div>
        <?php endforeach; ?>
    </section>
</div>