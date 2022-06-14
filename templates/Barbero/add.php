<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbero $barbero
 * @var \Cake\Collection\CollectionInterface|string[] $barbershop
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Barbero'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="barbero form content">
            <?= $this->Form->create($barbero) ?>
            <fieldset>
                <legend><?= __('Add Barbero') ?></legend>
                <?php
                    echo $this->Form->control('usuario');
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('email');
                    echo $this->Form->control('clave');
                    echo $this->Form->control('imagen_perfil');
                    echo $this->Form->control('tel');
                    echo $this->Form->control('barbershop._ids', ['options' => $barbershop]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

