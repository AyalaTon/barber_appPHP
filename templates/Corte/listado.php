<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Corte[]|\Cake\Collection\CollectionInterface $corte
 */
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
<div class="row">
    <div class="column-responsive">
        <div style="background-color: <?php echo $background2; ?>!important;" class="corte index content">
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
                            <b style="color: <?php echo $color; ?> !important; "><?= h($barbero[0]['usuario']) ?></b>
                        </h5>
                    </div>
                    <div class="row" style="color: <?php echo $color; ?> !important; ">Nombre:
                        <?= h($barbero[0]['nombre']) ?> </div>
                    <div class="row" style="color: <?php echo $color; ?> !important; ">Correo eléctronico:
                        <?= h($barbero[0]['email']) ?></div>
                </div>
            </div>
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
    </div>
</div>