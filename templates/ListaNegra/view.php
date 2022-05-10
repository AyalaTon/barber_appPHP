<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListaNegra $listaNegra
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lista Negra'), ['action' => 'edit', $listaNegra->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lista Negra'), ['action' => 'delete', $listaNegra->id], ['confirm' => __('Are you sure you want to delete # {0}?', $listaNegra->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lista Negra'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lista Negra'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="listaNegra view content">
            <h3><?= h($listaNegra->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Barbero') ?></th>
                    <td><?= $listaNegra->has('barbero') ? $this->Html->link($listaNegra->barbero->id, ['controller' => 'Barbero', 'action' => 'view', $listaNegra->barbero->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Cliente') ?></th>
                    <td><?= $listaNegra->has('cliente') ? $this->Html->link($listaNegra->cliente->id, ['controller' => 'Cliente', 'action' => 'view', $listaNegra->cliente->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Descripcion') ?></th>
                    <td><?= h($listaNegra->descripcion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($listaNegra->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= $listaNegra->estado ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
