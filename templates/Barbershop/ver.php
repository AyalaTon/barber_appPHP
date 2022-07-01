<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbershop $barbershop
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
<div style="background-color: <?php echo $background2; ?>!important;" class="barbershop view content">
    <div class="row">
        <div class="column column-25">
            <img class="img_perfil_barbershop" src="/img/barbershop/<?= $barbershop->imagen_perfil ?>" alt="">
        </div>
        <div class="column column-75">
            <div class="row">
                <h5>
                    <b style="color: <?php echo $color; ?> !important; "><?= h($barbershop->nombre) ?></b>
                </h5>
            </div>
            <div class="row" style="color: <?php echo $color; ?> !important; "><b>Dirección:</b>
                <?= h($barbershop->direccion) ?></div>
            <div class="row" style="color: <?php echo $color; ?> !important; "><b>Teléfono:</b>
                <?= h($barbershop->tel) ?>
            </div>
            <div class="row" style="color: <?php echo $color; ?> !important; "><b>Sitio web:</b> <a
                    href="<?= h($barbershop->website) ?>"> <?= h($barbershop->website) ?>
                </a>
            </div>
        </div>
    </div>
    <section class="cards">
        <?php foreach ($barbershop->barbero as $barbero) : ?>
        <div class="card_barberos" onclick="window.location.href = '/corte/listado/<?= $barbero->id; ?>';">
            <?= $this->Html->image('perfil/' . $barbero->imagen_perfil,  array('alt' => '', 'class' => 'img_perfil_barbershop_card')); ?>
            <div class="column_nombre_reserva">
                <b><?= h($barbero->nombre) ?></b>
                <p>Ver cortes</p>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
</div>