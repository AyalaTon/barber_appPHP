<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva[]|\Cake\Collection\CollectionInterface $reserva
 */
?>
<div class="reserva index content">
    <?= $this->Html->link(__('New Reserva'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Reserva') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('cliente_id') ?></th>
                    <th><?= $this->Paginator->sort('corte_id') ?></th>
                    <th><?= $this->Paginator->sort('fecha_corte') ?></th>
                    <th><?= $this->Paginator->sort('hora_comienzo_corte') ?></th>
                    <th><?= $this->Paginator->sort('fecha_reserva') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reserva as $reserva): ?>
                <tr>
                    <td><?= $this->Number->format($reserva->id) ?></td>
                    <td><?= $reserva->has('cliente') ? $this->Html->link($reserva->cliente->id, ['controller' => 'Cliente', 'action' => 'view', $reserva->cliente->id]) : '' ?></td>
                    <td><?= $reserva->has('corte') ? $this->Html->link($reserva->corte->id, ['controller' => 'Corte', 'action' => 'view', $reserva->corte->id]) : '' ?></td>
                    <td><?= h($reserva->fecha_corte) ?></td>
                    <td><?= h($reserva->hora_comienzo_corte) ?></td>
                    <td><?= h($reserva->fecha_reserva) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $reserva->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reserva->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reserva->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reserva->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
