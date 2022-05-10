<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CalificacionCorte $calificacionCorte
 * @var \Cake\Collection\CollectionInterface|string[] $cliente
 * @var \Cake\Collection\CollectionInterface|string[] $corte
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Calificacion Corte'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="calificacionCorte form content">
            <?= $this->Form->create($calificacionCorte) ?>
            <fieldset>
                <legend><?= __('Add Calificacion Corte') ?></legend>
                <?php
                    echo $this->Form->control('cliente_id', ['options' => $cliente]);
                    echo $this->Form->control('corte_id', ['options' => $corte]);
                    echo $this->Form->control('calificacion');
                    echo $this->Form->control('descripcion');
                    echo $this->Form->control('foto');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
