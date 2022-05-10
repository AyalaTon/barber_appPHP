<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BarberoBarbershop $barberoBarbershop
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Barbero Barbershop'), ['action' => 'edit', $barberoBarbershop->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Barbero Barbershop'), ['action' => 'delete', $barberoBarbershop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barberoBarbershop->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Barbero Barbershop'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Barbero Barbershop'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="barberoBarbershop view content">
            <h3><?= h($barberoBarbershop->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Barbero') ?></th>
                    <td><?= $barberoBarbershop->has('barbero') ? $this->Html->link($barberoBarbershop->barbero->id, ['controller' => 'Barbero', 'action' => 'view', $barberoBarbershop->barbero->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Barbershop') ?></th>
                    <td><?= $barberoBarbershop->has('barbershop') ? $this->Html->link($barberoBarbershop->barbershop->id, ['controller' => 'Barbershop', 'action' => 'view', $barberoBarbershop->barbershop->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($barberoBarbershop->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
