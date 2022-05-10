<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Cliente'), ['action' => 'edit', $cliente->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Cliente'), ['action' => 'delete', $cliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cliente->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cliente'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Cliente'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cliente view content">
            <h3><?= h($cliente->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Usuario') ?></th>
                    <td><?= h($cliente->usuario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($cliente->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($cliente->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Clave') ?></th>
                    <td><?= h($cliente->clave) ?></td>
                </tr>
                <tr>
                    <th><?= __('Imagen Perfil') ?></th>
                    <td><?= h($cliente->imagen_perfil) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tel') ?></th>
                    <td><?= h($cliente->tel) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($cliente->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Calificacion Cliente') ?></h4>
                <?php if (!empty($cliente->calificacion_cliente)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Barbero Id') ?></th>
                            <th><?= __('Cliente Id') ?></th>
                            <th><?= __('Calificacion') ?></th>
                            <th><?= __('Descripcion') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($cliente->calificacion_cliente as $calificacionCliente) : ?>
                        <tr>
                            <td><?= h($calificacionCliente->id) ?></td>
                            <td><?= h($calificacionCliente->barbero_id) ?></td>
                            <td><?= h($calificacionCliente->cliente_id) ?></td>
                            <td><?= h($calificacionCliente->calificacion) ?></td>
                            <td><?= h($calificacionCliente->descripcion) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CalificacionCliente', 'action' => 'view', $calificacionCliente->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CalificacionCliente', 'action' => 'edit', $calificacionCliente->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'CalificacionCliente', 'action' => 'delete', $calificacionCliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calificacionCliente->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Calificacion Corte') ?></h4>
                <?php if (!empty($cliente->calificacion_corte)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Cliente Id') ?></th>
                            <th><?= __('Corte Id') ?></th>
                            <th><?= __('Calificacion') ?></th>
                            <th><?= __('Descripcion') ?></th>
                            <th><?= __('Foto') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($cliente->calificacion_corte as $calificacionCorte) : ?>
                        <tr>
                            <td><?= h($calificacionCorte->id) ?></td>
                            <td><?= h($calificacionCorte->cliente_id) ?></td>
                            <td><?= h($calificacionCorte->corte_id) ?></td>
                            <td><?= h($calificacionCorte->calificacion) ?></td>
                            <td><?= h($calificacionCorte->descripcion) ?></td>
                            <td><?= h($calificacionCorte->foto) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CalificacionCorte', 'action' => 'view', $calificacionCorte->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CalificacionCorte', 'action' => 'edit', $calificacionCorte->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'CalificacionCorte', 'action' => 'delete', $calificacionCorte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calificacionCorte->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Lista Negra') ?></h4>
                <?php if (!empty($cliente->lista_negra)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Barbero Id') ?></th>
                            <th><?= __('Cliente Id') ?></th>
                            <th><?= __('Descripcion') ?></th>
                            <th><?= __('Estado') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($cliente->lista_negra as $listaNegra) : ?>
                        <tr>
                            <td><?= h($listaNegra->id) ?></td>
                            <td><?= h($listaNegra->barbero_id) ?></td>
                            <td><?= h($listaNegra->cliente_id) ?></td>
                            <td><?= h($listaNegra->descripcion) ?></td>
                            <td><?= h($listaNegra->estado) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ListaNegra', 'action' => 'view', $listaNegra->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ListaNegra', 'action' => 'edit', $listaNegra->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ListaNegra', 'action' => 'delete', $listaNegra->id], ['confirm' => __('Are you sure you want to delete # {0}?', $listaNegra->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Reserva') ?></h4>
                <?php if (!empty($cliente->reserva)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Cliente Id') ?></th>
                            <th><?= __('Corte Id') ?></th>
                            <th><?= __('Fecha Corte') ?></th>
                            <th><?= __('Hora Comienzo Corte') ?></th>
                            <th><?= __('Fecha Reserva') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($cliente->reserva as $reserva) : ?>
                        <tr>
                            <td><?= h($reserva->id) ?></td>
                            <td><?= h($reserva->cliente_id) ?></td>
                            <td><?= h($reserva->corte_id) ?></td>
                            <td><?= h($reserva->fecha_corte) ?></td>
                            <td><?= h($reserva->hora_comienzo_corte) ?></td>
                            <td><?= h($reserva->fecha_reserva) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Reserva', 'action' => 'view', $reserva->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Reserva', 'action' => 'edit', $reserva->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reserva', 'action' => 'delete', $reserva->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reserva->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
