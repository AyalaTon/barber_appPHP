<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CalificacionCorte[]|\Cake\Collection\CollectionInterface $calificacionCorte
 */
?>
<div class="calificacionCorte index content">
    <?= $this->Html->link(__('New Calificacion Corte'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Calificacion Corte') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('cliente_id') ?></th>
                    <th><?= $this->Paginator->sort('corte_id') ?></th>
                    <th><?= $this->Paginator->sort('calificacion') ?></th>
                    <th><?= $this->Paginator->sort('descripcion') ?></th>
                    <th><?= $this->Paginator->sort('foto') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($calificacionCorte as $calificacionCorte): ?>
                <tr>
                    <td><?= $this->Number->format($calificacionCorte->id) ?></td>
                    <td><?= $calificacionCorte->has('cliente') ? $this->Html->link($calificacionCorte->cliente->id, ['controller' => 'Cliente', 'action' => 'view', $calificacionCorte->cliente->id]) : '' ?></td>
                    <td><?= $calificacionCorte->has('corte') ? $this->Html->link($calificacionCorte->corte->id, ['controller' => 'Corte', 'action' => 'view', $calificacionCorte->corte->id]) : '' ?></td>
                    <td><?= $this->Number->format($calificacionCorte->calificacion) ?></td>
                    <td><?= h($calificacionCorte->descripcion) ?></td>
                    <td><?= h($calificacionCorte->foto) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $calificacionCorte->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $calificacionCorte->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $calificacionCorte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calificacionCorte->id)]) ?>
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
