<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TipoCorte $tipoCorte
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Tipo Corte'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tipoCorte form content">
            <?= $this->Form->create($tipoCorte) ?>
            <fieldset>
                <legend><?= __('Add Tipo Corte') ?></legend>
                <?php
                    echo $this->Form->control('tipo');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
