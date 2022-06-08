<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Corte[]|\Cake\Collection\CollectionInterface $corte
 */
?>
<div class="corte index content">
    <?= $this->Html->link(__('New Corte'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Corte') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('barbero_id') ?></th>
                    <th><?= $this->Paginator->sort('nombre') ?></th>
                    <th><?= $this->Paginator->sort('descripcion') ?></th>
                    <th><?= $this->Paginator->sort('imagen') ?></th>
                    <th><?= $this->Paginator->sort('precio') ?></th>
                    <th><?= $this->Paginator->sort('tiempo_estimado') ?></th>
                    <th><?= $this->Paginator->sort('tipo') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($corte as $corte): ?>
                <tr>
                    <td><?= $this->Number->format($corte->id) ?></td>
                    <td><?= $corte->has('barbero') ? $this->Html->link($corte->barbero->id, ['controller' => 'Barbero', 'action' => 'view', $corte->barbero->id]) : '' ?></td>
                    <td><?= h($corte->nombre) ?></td>
                    <td><?= h($corte->descripcion) ?></td>
                    <td> <img src='<?= h($corte->imagen) ?>'></td>
                    <td><?= $this->Number->format($corte->precio) ?></td>
                    <td><?= h($corte->tiempo_estimado) ?></td>
                    <td><?= $this->Number->format($corte->tipo) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $corte->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $corte->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $corte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $corte->id)]) ?>
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
