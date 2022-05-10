<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BarberoBarbershop $barberoBarbershop
 * @var string[]|\Cake\Collection\CollectionInterface $barbero
 * @var string[]|\Cake\Collection\CollectionInterface $barbershop
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $barberoBarbershop->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $barberoBarbershop->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Barbero Barbershop'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="barberoBarbershop form content">
            <?= $this->Form->create($barberoBarbershop) ?>
            <fieldset>
                <legend><?= __('Edit Barbero Barbershop') ?></legend>
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
