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
                <select name="dias" id="dias" required>
                    <option value="0" selected>1 DIA</option>
                    <option value="1">1 SEMANA</option>
                    <option value="2">1 MES</option>
                    <option value="3">PERSONALIZADO</option>
                </select>
                <label>Fecha desde</label>
                <input required type="date" label="Fecha desde" name="fecha_desde" id="fecha_desde" />
                <label hidden id="label_fecha_hasta">Fecha hasta</label>
                <input hidden type="date" label="Fecha hasta" name="fecha_hasta" id="fecha_hasta" />
                <?php
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
    switch (month - 1) {
        case 1:
            if (day == 31) {
                day = day - 3;
            } else if (day == 30) {
                day = day - 2;
            }
            break;
        case 3:
            if (day == 31) {
                day = day - 1;
            }
            break;
        case 5:
            if (day == 31) {
                day = day - 1;
            }
            break;
        case 7:
            if (day == 31) {
                day = day - 1;
            }
            break;
        case 8:
            if (day == 31) {
                day = day - 1;
            }
            break;
        case 10:
            if (day == 31) {
                day = day - 1;
            }
            break;
        case 12:
            if (day == 31) {
                day = day - 1;
            }
            month = 1;
            break;
    }
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
    var day = d.getDate() + 1;
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    console.log(day);
    switch (month) {
        case 1:
            if (day >= 25) {
                day = day + 7;
                day = day - 31;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 2:
            if (day >= 21) {
                day = day + 7;
                day = day - 28;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 3:
            if (day >= 25) {
                day = day + 7;
                day = day - 31;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 4:
            if (day >= 24) {
                day = day + 7;
                day = day - 30;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 5:
            if (day >= 25) {
                day = day + 7;
                day = day - 31;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 6:
            if (day >= 24) {
                day = day + 7;
                day = day - 30;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 7:
            if (day >= 25) {
                day = day + 7;
                day = day - 31;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 8:
            if (day >= 25) {
                day = day + 7;
                day = day - 31;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 9:
            if (day >= 24) {
                day = day + 7;
                day = day - 30;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 10:
            if (day >= 25) {
                day = day + 7;
                day = day - 31;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 11:
            if (day >= 24) {
                day = day + 7;
                day = day - 30;
                month = month + 1;
            } else {
                day = day + 7;
            }
            break;
        case 12:
            if (day >= 25) {
                day = day + 7;
                day = day - 31;
                month = 1;
            } else {
                day = day + 7;
            }
            break;
    }

    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = year + "-" + month + "-" + day;

    return date;
};
$.justDatePlusOne = function(dateObject) {
    var d = new Date(dateObject);
    var day = d.getDate() + 2;
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
            $('#fecha_hasta').attr('required', false);
        } else if ($(this).val() == '1') {
            $('#fecha_hasta').attr('value', $.datePlusWeek(new Date($('#fecha_desde').val())));
            $('#fecha_hasta').show();
            $('#label_fecha_hasta').show();
            $('#fecha_hasta').attr('readonly', true);
            $('#fecha_hasta').attr('required', true);
        } else if ($(this).val() == '2') {
            $('#fecha_hasta').attr('value', $.datePlusMonth(new Date($('#fecha_desde').val())));
            $('#fecha_hasta').show();
            $('#label_fecha_hasta').show();
            $('#fecha_hasta').attr('readonly', true);
            $('#fecha_hasta').attr('required', true);
        } else if ($(this).val() == '3') {
            $('#fecha_hasta').show();
            $('#label_fecha_hasta').show();
            $('#fecha_hasta').attr('readonly', false);
            $('#fecha_hasta').attr('required', true);
            $('#fecha_hasta').attr('min', $.justDatePlusOne(new Date($('#fecha_desde').val())));
        }
    });
});

$(function() {
    $('#fecha_desde').change(function() {
        $('#fecha_hasta').attr('min', $.justDatePlusOne(new Date($('#fecha_desde').val())));
        if ($('#dias').val() == '1') {
            $('#fecha_hasta').attr('value', $.datePlusWeek(new Date($('#fecha_desde').val())));
        }
        if ($('#dias').val() == '2') {
            $('#fecha_hasta').attr('value', $.datePlusMonth(new Date($('#fecha_desde').val())));
        }
    });
    // if dias changes do the same as above
});
</script>