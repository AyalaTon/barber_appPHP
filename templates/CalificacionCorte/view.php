<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CalificacionCorte $calificacionCorte
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Calificacion Corte'), ['action' => 'edit', $calificacionCorte->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Calificacion Corte'), ['action' => 'delete', $calificacionCorte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calificacionCorte->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Calificacion Corte'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Calificacion Corte'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="calificacionCorte view content">
            <h3><?= h($calificacionCorte->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Cliente') ?></th>
                    <td><?= $calificacionCorte->has('cliente') ? $this->Html->link($calificacionCorte->cliente->id, ['controller' => 'Cliente', 'action' => 'view', $calificacionCorte->cliente->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Corte') ?></th>
                    <td><?= $calificacionCorte->has('corte') ? $this->Html->link($calificacionCorte->corte->id, ['controller' => 'Corte', 'action' => 'view', $calificacionCorte->corte->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Descripcion') ?></th>
                    <td><?= h($calificacionCorte->descripcion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Foto') ?></th>
                    <td><?= h($calificacionCorte->foto) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($calificacionCorte->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Calificacion') ?></th>
                    <td><?= $this->Number->format($calificacionCorte->calificacion) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
