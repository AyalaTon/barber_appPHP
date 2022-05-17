<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbershop $barbershop
 * @var \Cake\Collection\CollectionInterface|string[] $barbero
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Barbershop'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="barbershop form content">
            <?= $this->Form->create($barbershop) ?>
            <fieldset>
                <legend><?= __('Add Barbershop') ?></legend>
                <?php
                echo $this->Form->control('nombre');
                echo $this->Form->control('direccion');
                echo $this->Form->control('tel');
                echo $this->Form->control('email');
                echo $this->Form->control('website');
                echo $this->Form->control('habilitado');
                ?>
                <div hidden>
                    <?php
                    echo $this->Form->control('barbero._ids', ['options' => $barbero, 'default' => $barberoLogeado]);
                    ?>
                </div>

            </fieldset>
            <?= $this->Html->link(__('Volver'), array('controller' => 'Barbero', 'action' => 'index'), ['class' => 'button']) ?>
            <?= $this->Form->button(__('Agregar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>