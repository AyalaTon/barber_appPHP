<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListaNegra $listaNegra
 * @var string[]|\Cake\Collection\CollectionInterface $barbero
 * @var string[]|\Cake\Collection\CollectionInterface $cliente
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $listaNegra->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $listaNegra->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Lista Negra'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="listaNegra form content">
            <?= $this->Form->create($listaNegra) ?>
            <fieldset>
                <legend><?= __('Edit Lista Negra') ?></legend>
                <?php
                    echo $this->Form->control('barbero_id', ['options' => $barbero]);
                    echo $this->Form->control('cliente_id', ['options' => $cliente]);
                    echo $this->Form->control('descripcion');
                    echo $this->Form->control('estado');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
