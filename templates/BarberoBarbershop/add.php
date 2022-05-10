<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BarberoBarbershop $barberoBarbershop
 * @var \Cake\Collection\CollectionInterface|string[] $barbero
 * @var \Cake\Collection\CollectionInterface|string[] $barbershop
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Barbero Barbershop'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="barberoBarbershop form content">
            <?= $this->Form->create($barberoBarbershop) ?>
            <fieldset>
                <legend><?= __('Add Barbero Barbershop') ?></legend>
                <?php
                    echo $this->Form->control('barbero_id', ['options' => $barbero]);
                    echo $this->Form->control('barbershop_id', ['options' => $barbershop]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
