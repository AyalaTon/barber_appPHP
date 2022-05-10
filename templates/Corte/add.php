<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Corte $corte
 * @var \Cake\Collection\CollectionInterface|string[] $barbero
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Corte'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="corte form content">
            <?= $this->Form->create($corte) ?>
            <fieldset>
                <legend><?= __('Add Corte') ?></legend>
                <?php
                    echo $this->Form->control('barbero_id', ['options' => $barbero]);
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('descripcion');
                    echo $this->Form->control('imagen');
                    echo $this->Form->control('precio');
                    echo $this->Form->control('tiempo_estimado');
                    echo $this->Form->control('tipo');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
