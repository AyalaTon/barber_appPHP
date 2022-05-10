<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CalificacionCliente $calificacionCliente
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Calificacion Cliente'), ['action' => 'edit', $calificacionCliente->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Calificacion Cliente'), ['action' => 'delete', $calificacionCliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calificacionCliente->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Calificacion Cliente'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Calificacion Cliente'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="calificacionCliente view content">
            <h3><?= h($calificacionCliente->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Barbero') ?></th>
                    <td><?= $calificacionCliente->has('barbero') ? $this->Html->link($calificacionCliente->barbero->id, ['controller' => 'Barbero', 'action' => 'view', $calificacionCliente->barbero->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Cliente') ?></th>
                    <td><?= $calificacionCliente->has('cliente') ? $this->Html->link($calificacionCliente->cliente->id, ['controller' => 'Cliente', 'action' => 'view', $calificacionCliente->cliente->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Descripcion') ?></th>
                    <td><?= h($calificacionCliente->descripcion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($calificacionCliente->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Calificacion') ?></th>
                    <td><?= $this->Number->format($calificacionCliente->calificacion) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
