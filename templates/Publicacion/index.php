<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publicacion[]|\Cake\Collection\CollectionInterface $publicacion
 */
?>
<div class="publicacion index content">
    <?= $this->Html->link(__('New Publicacion'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Publicacion') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('barbershop_id') ?></th>
                    <th><?= $this->Paginator->sort('contenido') ?></th>
                    <th><?= $this->Paginator->sort('imagen') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($publicacion as $publicacion): ?>
                <tr>
                    <td><?= $this->Number->format($publicacion->id) ?></td>
                    <td><?= $publicacion->has('barbershop') ? $this->Html->link($publicacion->barbershop->id, ['controller' => 'Barbershop', 'action' => 'view', $publicacion->barbershop->id]) : '' ?></td>
                    <td><?= h($publicacion->contenido) ?></td>
                    <td><?= h($publicacion->imagen) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $publicacion->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $publicacion->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $publicacion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $publicacion->id)]) ?>
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
