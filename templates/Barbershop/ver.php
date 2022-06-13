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
                    <img class="img_perfil_barbershop" src="https://i.imgur.com/LuqJuye.jpg" alt="">
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
            <?php
            if (sizeof($barbershop->barbero) > 3) {
                for ($i = 0; sizeof($barbershop->barbero) > $i; $i = $i + 3) {
            ?>
            <div class="row ">
                <?php if (isset($barbershop->barbero[$i])) { ?>
                <div class="column column-33 card_barberos">
                    <div class="row card_barberos_content">
                        <div style="display:flex; align-items: center; justify-content: center;"
                            class="column column-30 ">
                            <?= $this->Html->image('perfil/'.$barbershop->barbero[$i]->imagen_perfil,  array('alt' => '', 'class' => 'img_perfil_barbershop_card')); ?>
                        </div>
                        <div class="column column-40">
                            <h5 style="margin: 0 !important;">
                                <b><?= h($barbershop->barbero[$i]->nombre) ?></b> Reservar
                            </h5>
                        </div>
                        <div class="column column-30">
                            
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if (isset($barbershop->barbero[$i + 1])) { ?>
                <div class="column column-33 card_barberos">
                    <div class="row card_barberos_content">
                        <div style="display:flex; align-items: center; justify-content: center;"
                            class="column column-30 ">
                            <?= $this->Html->image('perfil/'.$barbershop->barbero[$i + 1]->imagen_perfil,  array('alt' => '', 'class' => 'img_perfil_barbershop_card')); ?>
                        </div>
                        <div class="column column-40">
                            <h5 style="margin: 0 !important;">
                                <b><?= h($barbershop->barbero[$i + 1]->nombre) ?></b> Reservar
                            </h5>
                        </div>
                        <div class="column column-30">
                            
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if (isset($barbershop->barbero[$i + 1])) { ?>
                <div class="column column-33 card_barberos">
                    <div class="row card_barberos_content">
                        <div style="display:flex; align-items: center; justify-content: center;"
                            class="column column-30 ">
                            <?= $this->Html->image('perfil/'.$barbershop->barbero[$i + 2]->imagen_perfil,  array('alt' => '', 'class' => 'img_perfil_barbershop_card')); ?>
                        </div>
                        <div class="column-responsive column-40">
                            <h5 style="margin: 0 !important;">
                                <b><?= h($barbershop->barbero[$i + 2]->nombre) ?></b> Reservar
                            </h5>
                        </div>
                        <div class="column column-30">
                            
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php }
            } ?>
            <!--
            <div class="related">
                <h4><?= __('Related Barbero') ?></h4>
                <?php if (!empty($barbershop->barbero)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Usuario') ?></th>
                            <th><?= __('Nombre') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Clave') ?></th>
                            <th><?= __('Imagen Perfil') ?></th>
                            <th><?= __('Tel') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($barbershop->barbero as $barbero) : ?>
                        <tr>
                            <td><?= h($barbero->id) ?></td>
                            <td><?= h($barbero->usuario) ?></td>
                            <td><?= h($barbero->nombre) ?></td>
                            <td><?= h($barbero->email) ?></td>
                            <td><?= h($barbero->clave) ?></td>
                            <td><?= h($barbero->imagen_perfil) ?></td>
                            <td><?= h($barbero->tel) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Barbero', 'action' => 'view', $barbero->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Barbero', 'action' => 'edit', $barbero->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Barbero', 'action' => 'delete', $barbero->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barbero->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Publicacion') ?></h4>
                <?php if (!empty($barbershop->publicacion)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Barbershop Id') ?></th>
                            <th><?= __('Contenido') ?></th>
                            <th><?= __('Imagen') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($barbershop->publicacion as $publicacion) : ?>
                        <tr>
                            <td><?= h($publicacion->id) ?></td>
                            <td><?= h($publicacion->barbershop_id) ?></td>
                            <td><?= h($publicacion->contenido) ?></td>
                            <td><?= h($publicacion->imagen) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Publicacion', 'action' => 'view', $publicacion->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Publicacion', 'action' => 'edit', $publicacion->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Publicacion', 'action' => 'delete', $publicacion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $publicacion->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>-->
        </div>
    </div>
</div>