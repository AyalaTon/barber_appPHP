<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbershop[]|\Cake\Collection\CollectionInterface $barbershop
 */
?>
<div class="barbershop index content">
    <?= $this->Html->link(__('New Barbershop'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Barbershop') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nombre') ?></th>
                    <th><?= $this->Paginator->sort('direccion') ?></th>
                    <th><?= $this->Paginator->sort('tel') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('website') ?></th>
                    <th><?= $this->Paginator->sort('habilitado') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barbershop as $barbershop): ?>
                <tr>
                    <td><?= $this->Number->format($barbershop->id) ?></td>
                    <td><?= h($barbershop->nombre) ?></td>
                    <td><?= h($barbershop->direccion) ?></td>
                    <td><?= h($barbershop->tel) ?></td>
                    <td><?= h($barbershop->email) ?></td>
                    <td><?= h($barbershop->website) ?></td>
                    <td><?= h($barbershop->habilitado) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $barbershop->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $barbershop->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $barbershop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barbershop->id)]) ?>
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
