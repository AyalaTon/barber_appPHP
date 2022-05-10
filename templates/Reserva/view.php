<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Reserva'), ['action' => 'edit', $reserva->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Reserva'), ['action' => 'delete', $reserva->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reserva->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Reserva'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Reserva'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="reserva view content">
            <h3><?= h($reserva->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Cliente') ?></th>
                    <td><?= $reserva->has('cliente') ? $this->Html->link($reserva->cliente->id, ['controller' => 'Cliente', 'action' => 'view', $reserva->cliente->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Corte') ?></th>
                    <td><?= $reserva->has('corte') ? $this->Html->link($reserva->corte->id, ['controller' => 'Corte', 'action' => 'view', $reserva->corte->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($reserva->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha Corte') ?></th>
                    <td><?= h($reserva->fecha_corte) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora Comienzo Corte') ?></th>
                    <td><?= h($reserva->hora_comienzo_corte) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha Reserva') ?></th>
                    <td><?= h($reserva->fecha_reserva) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
