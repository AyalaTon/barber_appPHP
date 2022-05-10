<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CalificacionCliente[]|\Cake\Collection\CollectionInterface $calificacionCliente
 */
?>
<div class="calificacionCliente index content">
    <?= $this->Html->link(__('New Calificacion Cliente'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Calificacion Cliente') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('barbero_id') ?></th>
                    <th><?= $this->Paginator->sort('cliente_id') ?></th>
                    <th><?= $this->Paginator->sort('calificacion') ?></th>
                    <th><?= $this->Paginator->sort('descripcion') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($calificacionCliente as $calificacionCliente): ?>
                <tr>
                    <td><?= $this->Number->format($calificacionCliente->id) ?></td>
                    <td><?= $calificacionCliente->has('barbero') ? $this->Html->link($calificacionCliente->barbero->id, ['controller' => 'Barbero', 'action' => 'view', $calificacionCliente->barbero->id]) : '' ?></td>
                    <td><?= $calificacionCliente->has('cliente') ? $this->Html->link($calificacionCliente->cliente->id, ['controller' => 'Cliente', 'action' => 'view', $calificacionCliente->cliente->id]) : '' ?></td>
                    <td><?= $this->Number->format($calificacionCliente->calificacion) ?></td>
                    <td><?= h($calificacionCliente->descripcion) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $calificacionCliente->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $calificacionCliente->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $calificacionCliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calificacionCliente->id)]) ?>
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
