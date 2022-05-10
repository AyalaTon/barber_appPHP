<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbershop $barbershop
 * @var string[]|\Cake\Collection\CollectionInterface $barbero
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $barbershop->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $barbershop->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Barbershop'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="barbershop form content">
            <?= $this->Form->create($barbershop) ?>
            <fieldset>
                <legend><?= __('Edit Barbershop') ?></legend>
                <?php
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('direccion');
                    echo $this->Form->control('tel');
                    echo $this->Form->control('email');
                    echo $this->Form->control('website');
                    echo $this->Form->control('habilitado');
                    echo $this->Form->control('barbero._ids', ['options' => $barbero]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
