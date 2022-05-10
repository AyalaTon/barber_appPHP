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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tipoCorte->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tipoCorte->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Tipo Corte'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tipoCorte form content">
            <?= $this->Form->create($tipoCorte) ?>
            <fieldset>
                <legend><?= __('Edit Tipo Corte') ?></legend>
                <?php
                    echo $this->Form->control('tipo');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
