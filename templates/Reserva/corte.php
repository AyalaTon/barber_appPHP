<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 * @var \Cake\Collection\CollectionInterface|string[] $cliente
 * @var \Cake\Collection\CollectionInterface|string[] $corte
 */
?>
<div class="row">
    <div class="column-responsive">
        <div class="reserva form content">
            <?= $this->Form->create($reserva) ?>
            <fieldset>
                <legend>Reservar hora</legend>
                <?php
                echo $this->Form->control('cliente_id', ['options' => $cliente]);
                echo $this->Form->control('fecha_corte');
                echo $this->Form->control('hora_comienzo_corte');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>