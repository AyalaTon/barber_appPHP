<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HorarioBarbero $horarioBarbero
 * @var string[]|\Cake\Collection\CollectionInterface $barbero
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $horarioBarbero->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $horarioBarbero->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Horario Barbero'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="horarioBarbero form content">
            <?= $this->Form->create($horarioBarbero) ?>
            <fieldset>
                <legend><?= __('Edit Horario Barbero') ?></legend>
                <?php
                    echo $this->Form->control('barbero_id', ['options' => $barbero]);
                    echo $this->Form->control('fecha');
                    echo $this->Form->control('hora_inicio');
                    echo $this->Form->control('hora_fin');
                    echo $this->Form->control('disponible');
                    echo $this->Form->control('turno');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
