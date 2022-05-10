<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TipoCorte $tipoCorte
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tipo Corte'), ['action' => 'edit', $tipoCorte->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tipo Corte'), ['action' => 'delete', $tipoCorte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipoCorte->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tipo Corte'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tipo Corte'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tipoCorte view content">
            <h3><?= h($tipoCorte->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Tipo') ?></th>
                    <td><?= h($tipoCorte->tipo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tipoCorte->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
