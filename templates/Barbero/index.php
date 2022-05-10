<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbero[]|\Cake\Collection\CollectionInterface $barbero
 */
?>
<div class="barbero index content">
    <?= $this->Html->link(__('New Barbero'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Barbero') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('usuario') ?></th>
                    <th><?= $this->Paginator->sort('nombre') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('clave') ?></th>
                    <th><?= $this->Paginator->sort('imagen_perfil') ?></th>
                    <th><?= $this->Paginator->sort('tel') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barbero as $barbero): ?>
                <tr>
                    <td><?= $this->Number->format($barbero->id) ?></td>
                    <td><?= h($barbero->usuario) ?></td>
                    <td><?= h($barbero->nombre) ?></td>
                    <td><?= h($barbero->email) ?></td>
                    <td><?= h($barbero->clave) ?></td>
                    <td><?= h($barbero->imagen_perfil) ?></td>
                    <td><?= h($barbero->tel) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $barbero->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $barbero->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $barbero->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barbero->id)]) ?>
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
