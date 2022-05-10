<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HorarioBarbero[]|\Cake\Collection\CollectionInterface $horarioBarbero
 */
?>
<div class="horarioBarbero index content">
    <?= $this->Html->link(__('New Horario Barbero'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Horario Barbero') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('barbero_id') ?></th>
                    <th><?= $this->Paginator->sort('fecha') ?></th>
                    <th><?= $this->Paginator->sort('hora_inicio') ?></th>
                    <th><?= $this->Paginator->sort('hora_fin') ?></th>
                    <th><?= $this->Paginator->sort('disponible') ?></th>
                    <th><?= $this->Paginator->sort('turno') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horarioBarbero as $horarioBarbero): ?>
                <tr>
                    <td><?= $this->Number->format($horarioBarbero->id) ?></td>
                    <td><?= $horarioBarbero->has('barbero') ? $this->Html->link($horarioBarbero->barbero->id, ['controller' => 'Barbero', 'action' => 'view', $horarioBarbero->barbero->id]) : '' ?></td>
                    <td><?= h($horarioBarbero->fecha) ?></td>
                    <td><?= h($horarioBarbero->hora_inicio) ?></td>
                    <td><?= h($horarioBarbero->hora_fin) ?></td>
                    <td><?= h($horarioBarbero->disponible) ?></td>
                    <td><?= h($horarioBarbero->turno) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $horarioBarbero->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $horarioBarbero->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $horarioBarbero->id], ['confirm' => __('Are you sure you want to delete # {0}?', $horarioBarbero->id)]) ?>
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
