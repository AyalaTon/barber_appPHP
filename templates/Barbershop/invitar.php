<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbershop $barbershop
 * @var \Cake\Collection\CollectionInterface|string[] $barbero
 */
?>
<?php


?>
<div class="row">
    <div class="column-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Invitar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barberosSinBarberias as $barberoSinBarberia) { ?>
                <tr>
                    <td><?= $barberoSinBarberia->id ?></td>
                    <td><?= $barberoSinBarberia->usuario ?></td>
                    <td><?= $barberoSinBarberia->nombre ?></td>
                    <td>
                        <img alt="<?php echo $barberoSinBarberia->nombre ?>"
                            src="<?php echo '/img/perfil/' . $barberoSinBarberia->imagen_perfil ?>"
                            class="img_perfil" />
                    </td>
                    <td>

                        <?=
                            $this->Html->link('Invitar', array(
                                'controller' => 'BarberoBarbershop',
                                'action' => 'barberoInvitado',
                                $barberoSinBarberia->id,
                            ));

                            ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>


    </div>
</div>