<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CalificacionCliente $calificacionCliente
 * @var \Cake\Collection\CollectionInterface|string[] $barbero
 * @var \Cake\Collection\CollectionInterface|string[] $cliente
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Calificacion Cliente'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="calificacionCliente form content">
            <?= $this->Form->create($calificacionCliente) ?>
            <fieldset>
                <legend><?= __('Add Calificacion Cliente') ?></legend>
                <?php
                    echo $this->Form->control('barbero_id', ['options' => $barbero]);
                    echo $this->Form->control('cliente_id', ['options' => $cliente]);
                    echo $this->Form->control('calificacion');
                    echo $this->Form->control('descripcion');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
