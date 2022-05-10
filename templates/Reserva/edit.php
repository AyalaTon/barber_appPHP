<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 * @var string[]|\Cake\Collection\CollectionInterface $cliente
 * @var string[]|\Cake\Collection\CollectionInterface $corte
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $reserva->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $reserva->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Reserva'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="reserva form content">
            <?= $this->Form->create($reserva) ?>
            <fieldset>
                <legend><?= __('Edit Reserva') ?></legend>
                <?php
                    echo $this->Form->control('cliente_id', ['options' => $cliente]);
                    echo $this->Form->control('corte_id', ['options' => $corte]);
                    echo $this->Form->control('fecha_corte');
                    echo $this->Form->control('hora_comienzo_corte');
                    echo $this->Form->control('fecha_reserva');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
