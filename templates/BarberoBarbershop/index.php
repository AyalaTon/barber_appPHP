<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BarberoBarbershop[]|\Cake\Collection\CollectionInterface $barberoBarbershop
 */
?>
<div class="barberoBarbershop index content">
    <?= $this->Html->link(__('New Barbero Barbershop'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Barbero Barbershop') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('barbero_id') ?></th>
                    <th><?= $this->Paginator->sort('barbershop_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barberoBarbershop as $barberoBarbershop): ?>
                <tr>
                    <td><?= $this->Number->format($barberoBarbershop->id) ?></td>
                    <td><?= $barberoBarbershop->has('barbero') ? $this->Html->link($barberoBarbershop->barbero->id, ['controller' => 'Barbero', 'action' => 'view', $barberoBarbershop->barbero->id]) : '' ?></td>
                    <td><?= $barberoBarbershop->has('barbershop') ? $this->Html->link($barberoBarbershop->barbershop->id, ['controller' => 'Barbershop', 'action' => 'view', $barberoBarbershop->barbershop->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $barberoBarbershop->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $barberoBarbershop->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $barberoBarbershop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barberoBarbershop->id)]) ?>
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
