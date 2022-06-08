<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HorarioBarbero $horarioBarbero
 * @var \Cake\Collection\CollectionInterface|string[] $barbero
 */
?>
<div class="row">
    <div class="column-responsive">
        <div class="horarioBarbero form content">
            <?= $this->Form->create($horarioBarbero) ?>
            <fieldset>
                <legend><?= __('Agregar horario') ?></legend>
                <label>Tiempo</label>
                <select name="dias" id="dias">
                    <option value="0" selected>1 DIA</option>
                    <option value="1">1 SEMANA</option>
                    <option value="2">1 MES</option>
                    <option value="3">PERSONALIZADO</option>
                </select>
                <label>Fecha desde</label>
                <input type="date" label="Fecha desde" name="fecha_desde" id="fecha_desde" />
                <label hidden id="label_fecha_hasta">Fecha hasta</label>
                <input hidden type="date" label="Fecha hasta" name="fecha_hasta" id="fecha_hasta" />
                <?php
                // echo $this->Form->control('cantidad_dias', ['options' => ['1 DIA', '1 SEMANA', '1 MES', 'PERSONALIZADO'], 'label' => 'Cantidad de dias']);
                // echo $this->Form->control('fecha', ['label' => 'Fecha desde']);
                // echo $this->Form->control('fecha', ['label' => 'Fecha hasta']);
                echo $this->Form->control('hora_inicio', ['label' => 'Hora de inicio de la jornada', 'step' => '1800']);

                echo $this->Form->control('hora_fin', ['label' => 'Hora de fin de la jornada', 'step' => '1800']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Agregar horario')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
$.datePlusMonth = function(dateObject) {
    var d = new Date(dateObject);
    var day = d.getDate() + 1;
    var month = d.getMonth() + 1 + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = year + "-" + month + "-" + day;

    return date;
};
$.datePlusWeek = function(dateObject) {
    var d = new Date(dateObject);
    var day = d.getDate() + 8;
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = year + "-" + month + "-" + day;

    return date;
};

$(function() {
    $('#dias').change(function() {
        if ($(this).val() == '0') {
            $('#fecha_hasta').hide();
            $('#label_fecha_hasta').hide();
        } else if ($(this).val() == '1') {
            $('#fecha_hasta').attr('value', $.datePlusWeek(new Date($('#fecha_desde').val())));
            $('#fecha_hasta').show();
            $('#label_fecha_hasta').show();
        } else if ($(this).val() == '2') {
            $('#fecha_hasta').attr('value', $.datePlusMonth(new Date($('#fecha_desde').val())));
            $('#fecha_hasta').show();
            $('#label_fecha_hasta').show();
        } else if ($(this).val() == '3') {
            $('#fecha_hasta').show();
            $('#label_fecha_hasta').show();
        }
    });

});
</script>