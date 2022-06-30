<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbershop $barbershop
 */
?>
<div class="row">
    <div class="column-responsive">
        <div class="barbershop view content">
            <div class="row">
                <div class="column column-25">
                    <img class="img_perfil_barbershop" src="/img/barbershop/<?= $barbershop->imagen_perfil ?>" alt="">
                </div>
                <div class="column column-75">
                    <div class="row">
                        <h5>
                            <b><?= h($barbershop->nombre) ?></b>
                        </h5>
                    </div>
                    <div class="row">Dirección: <?= h($barbershop->direccion) ?></div>
                    <div class="row">Teléfono: <?= h($barbershop->tel) ?> </div>
                    <div class="row">Sitio web: <a href="<?= h($barbershop->website) ?>"> <?= h($barbershop->website) ?>
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
    </div>
</div>

<script>
function irACortes() {

}
</script>