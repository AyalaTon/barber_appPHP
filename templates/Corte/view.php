<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Corte $corte
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Corte'), ['action' => 'edit', $corte->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Corte'), ['action' => 'delete', $corte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $corte->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Corte'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Corte'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="corte view content">
            <h3><?= h($corte->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Barbero') ?></th>
                    <td><?= $corte->has('barbero') ? $this->Html->link($corte->barbero->id, ['controller' => 'Barbero', 'action' => 'view', $corte->barbero->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($corte->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Descripcion') ?></th>
                    <td><?= h($corte->descripcion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Imagen') ?></th>
                    <td><?= h($corte->imagen) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($corte->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Precio') ?></th>
                    <td><?= $this->Number->format($corte->precio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tipo') ?></th>
                    <td><?= $this->Number->format($corte->tipo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tiempo Estimado') ?></th>
                    <td><?= h($corte->tiempo_estimado) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Calificacion Corte') ?></h4>
                <?php if (!empty($corte->calificacion_corte)) : ?>
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
                        <?php foreach ($corte->calificacion_corte as $calificacionCorte) : ?>
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
                <h4><?= __('Related Reserva') ?></h4>
                <?php if (!empty($corte->reserva)) : ?>
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
                        <?php foreach ($corte->reserva as $reserva) : ?>
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
