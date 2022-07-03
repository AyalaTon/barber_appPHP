<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva[]|\Cake\Collection\CollectionInterface $reserva
 */
?>
<div class="index content">

    <h3>Mis reservas</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Corte</th>
                    <th>Barbero</th>
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
                                }
                            }
                            ?>
                    </td>
                    <td>

                        <?php
                            foreach ($cortes_reserva as $corte) {
                                foreach ($barberos_reserva as $barbero) {
                                    if ($barbero->id == $corte->barbero_id && $corte->id == $reserva->corte_id) {
                            ?>
                        <p><?= $barbero->nombre ?></p>
                        <img alt="<?php echo $barbero->nombre ?>"
                            src="<?php echo '/img/perfil/' . $barbero->imagen_perfil ?>" class="img_perfil" />
                        <?php

                                        break;
                                    }
                                }
                            }
                            ?>

                    </td>
                    <td><?= h($reserva->hora_comienzo_corte) ?></td>
                    <td><?= h($reserva->fecha_corte) ?></td>
                    <td><?= h($reserva->fecha_reserva) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>