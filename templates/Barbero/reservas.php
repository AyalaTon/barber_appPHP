<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva[]|\Cake\Collection\CollectionInterface $reserva
 */
?>
<?php
$isTheme = isset($_COOKIE["theme"]);
if ($isTheme) {
    if ($_COOKIE["theme"] == "dark") {
        $background = "#2a2b2e";
        $background2 = "#34373B";
        $color = "#fff";
        $colorDropdown = "#80868f";
    } else {
        $background = "#f5f7fa";
        $background2 = "#f9f9f9";
        $color = "#363637";
        $colorDropdown = "#363637";
    }
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
}
?>

<div class="index content" style="background-color: <?php echo $background2; ?>!important;">
    <h3 style="color: <?php echo $color; ?> !important; ">Mis reservas</h3>
    <?php if (sizeof($reservas) <= 0) { ?>
    <div class="alert alert-info" style="display: flex; justify-content:center">
        <h4 style="color: <?php echo $color; ?> !important; ">Aún no tienes reservas</h4>
    </div>
    <?php } else { ?>
    <div class="table-responsive">
        <table style="color: <?php echo $color; ?> !important; ">
            <thead>
                <tr>
                    <th>Corte</th>
                    <th>Cliente</th>
                    <th>Hora inicio</th>
                    <th>Fecha</th>
                    <th>Fecha de reserva</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva) : ?>
                <tr>
                    <td>
                        <?php
                                foreach ($cortes_reserva as $corte) {
                                    if ($corte->id == $reserva->corte_id) {
                                        echo $corte->nombre;
                                        break;
                                    }
                                }
                                ?>
                    </td>
                    <td>

                        <?php

                                foreach ($clientes_reserva as $cliente) {
                                    if ($cliente->id == $reserva->cliente_id) {
                                ?>
                        <p><?= $cliente->nombre ?></p>
                        <img alt="<?php echo $cliente->nombre ?>"
                            src="<?php echo '/img/perfil/' . $cliente->imagen_perfil ?>" class="img_perfil" />
                        <?php

                                        break;
                                    }
                                }

                                ?>

                    </td>
                    <td><?= h($reserva->hora_comienzo_corte) ?></td>
                    <td><?= h($reserva->fecha_corte->i18nFormat('dd-MM-yyyy')) ?></td>
                    <td><?= h($reserva->fecha_reserva->i18nFormat('dd-MM-yyyy')) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>