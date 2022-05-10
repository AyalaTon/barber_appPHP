<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publicacion $publicacion
 * @var string[]|\Cake\Collection\CollectionInterface $barbershop
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $publicacion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $publicacion->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Publicacion'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="publicacion form content">
            <?= $this->Form->create($publicacion) ?>
            <fieldset>
                <legend><?= __('Edit Publicacion') ?></legend>
                <?php
                    echo $this->Form->control('barbershop_id', ['options' => $barbershop]);
                    echo $this->Form->control('contenido');
                    echo $this->Form->control('imagen');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
