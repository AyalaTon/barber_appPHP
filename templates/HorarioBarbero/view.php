<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HorarioBarbero $horarioBarbero
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Horario Barbero'), ['action' => 'edit', $horarioBarbero->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Horario Barbero'), ['action' => 'delete', $horarioBarbero->id], ['confirm' => __('Are you sure you want to delete # {0}?', $horarioBarbero->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Horario Barbero'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Horario Barbero'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="horarioBarbero view content">
            <h3><?= h($horarioBarbero->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Barbero') ?></th>
                    <td><?= $horarioBarbero->has('barbero') ? $this->Html->link($horarioBarbero->barbero->id, ['controller' => 'Barbero', 'action' => 'view', $horarioBarbero->barbero->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Turno') ?></th>
                    <td><?= h($horarioBarbero->turno) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($horarioBarbero->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha') ?></th>
                    <td><?= h($horarioBarbero->fecha) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora Inicio') ?></th>
                    <td><?= h($horarioBarbero->hora_inicio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora Fin') ?></th>
                    <td><?= h($horarioBarbero->hora_fin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Disponible') ?></th>
                    <td><?= $horarioBarbero->disponible ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
