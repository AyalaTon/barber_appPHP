<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TipoCorte[]|\Cake\Collection\CollectionInterface $tipoCorte
 */
?>
<div class="tipoCorte index content">
    <?= $this->Html->link(__('New Tipo Corte'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tipo Corte') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('tipo') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tipoCorte as $tipoCorte): ?>
                <tr>
                    <td><?= $this->Number->format($tipoCorte->id) ?></td>
                    <td><?= h($tipoCorte->tipo) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tipoCorte->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tipoCorte->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tipoCorte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipoCorte->id)]) ?>
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
