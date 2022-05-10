<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListaNegra[]|\Cake\Collection\CollectionInterface $listaNegra
 */
?>
<div class="listaNegra index content">
    <?= $this->Html->link(__('New Lista Negra'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Lista Negra') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('barbero_id') ?></th>
                    <th><?= $this->Paginator->sort('cliente_id') ?></th>
                    <th><?= $this->Paginator->sort('descripcion') ?></th>
                    <th><?= $this->Paginator->sort('estado') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaNegra as $listaNegra): ?>
                <tr>
                    <td><?= $this->Number->format($listaNegra->id) ?></td>
                    <td><?= $listaNegra->has('barbero') ? $this->Html->link($listaNegra->barbero->id, ['controller' => 'Barbero', 'action' => 'view', $listaNegra->barbero->id]) : '' ?></td>
                    <td><?= $listaNegra->has('cliente') ? $this->Html->link($listaNegra->cliente->id, ['controller' => 'Cliente', 'action' => 'view', $listaNegra->cliente->id]) : '' ?></td>
                    <td><?= h($listaNegra->descripcion) ?></td>
                    <td><?= h($listaNegra->estado) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $listaNegra->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $listaNegra->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $listaNegra->id], ['confirm' => __('Are you sure you want to delete # {0}?', $listaNegra->id)]) ?>
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
