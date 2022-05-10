<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CalificacionCorte $calificacionCorte
 * @var string[]|\Cake\Collection\CollectionInterface $cliente
 * @var string[]|\Cake\Collection\CollectionInterface $corte
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $calificacionCorte->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $calificacionCorte->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Calificacion Corte'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="calificacionCorte form content">
            <?= $this->Form->create($calificacionCorte) ?>
            <fieldset>
                <legend><?= __('Edit Calificacion Corte') ?></legend>
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
