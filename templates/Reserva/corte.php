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
                <input type="text" id="fecha" class="some-input"></input>
                <div class="column-responsive column-40" hidden>

                    <table id="tabla_horarios">
                        <thead>
                            <tr>
                                <th>Hora</th>
                                <th>Reservar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10:00</td>
                                <td><button>Reservar</button></td>
                            </tr>
                            <tr>
                                <td>11:00</td>
                                <td><button>Reservar</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <legend>Reservar hora</legend>
                <?php

                echo $this->Form->control('fecha_corte');
                echo $this->Form->control('hora_comienzo_corte');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script src="https://unpkg.com/js-datepicker"></script>
<script>
// Guardo en js las variables traidas desde PHP
const fechas_disponibles = <?php echo json_encode($horarios); ?>;
const corte = <?php echo json_encode($corte); ?>;

// Creo el arreglo de fechas 
const fechas_arrego = [];


// Guardo en el arreglo solo las fechas
fechas_disponibles.forEach(function(fecha, index) {
    fechas_arrego[index] = fecha['fecha'];
});


// Creo un arreglo sin fechas repetidas
const fechas_unicas = [...new Set(fechas_arrego)];

// Creo un arreglo con las fechas parseadas
const parsed_fechas = [];
fechas_unicas.forEach(function(fecha, index) {
    parsed_fechas[index] = new Date(fecha);
})

// Creo el datepicker para seleccionar las fechas
const picker = datepicker('.some-input', {
    // Agrego los puntos en el calendario
    events: parsed_fechas,
    // Formateo la fecha
    formatter: (input, date, instance) => {
        const value = date.toLocaleDateString()
        input.value = value // => '1/1/2099'
    },
    // Cambio el formato de los dias a ES
    customDays: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
    // Cambio el formato de los meses a ES
    customMonths: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
        'Octubre', 'Noviembre', 'Diciembre'
    ],
    // Funcion para saber cuandos se selecciona una fecha
    onSelect: (instance, date) => {
        // Creo un arreglo con fechas parseadas
        const fechas_pars = [];
        var mess = date.getMonth() + 1;
        if (mess < 10) {
            mess = '0' + mess;
        }
        // Obtengo la fecha seleccionada con el mismo formato.
        const fecha_seleccionada = date.getFullYear() + '-' + mess + '-' + date.getDate();

        // Recorro las fechas parseadas y guardo las mismas
        parsed_fechas.forEach(function(fecha, index) {
            var mes = fecha.getMonth() + 1;
            if (mes < 10) {
                mes = '0' + mes;
            }
            fecha_pars = fecha.getFullYear() + '-' + mes + '-' + fecha.getDate();
            fechas_pars[index] = fecha_pars;
        });

        // Creo ek arreglo de horarios
        horarios = [];

        // Si la fecha seleccionada es una de las fechas disponible obtengo los horarios
        if (fechas_pars.includes(fecha_seleccionada)) {
            console.log('Mostrar los horarios de la fecha');
            console.log(fecha_seleccionada);
            console.log(fechas_disponibles);

            // Recorro las fechas disponibles 
            var indice = 0;
            fechas_disponibles.forEach(function(fecha) {
                if (fecha['fecha'] === fecha_seleccionada) {
                    // Cuando la encuentro guardo como objeto la hora de inicio y la hora de fin
                    horarios[indice] = {
                        'hora_inicio': fecha['hora_inicio'],
                        'hora_fin': fecha['hora_fin'],
                    }
                    indice++;
                }
            });
            console.log(horarios);

            // Tiempo de duración del corte

            const [hours3, minutes3, seconds3] = corte['tiempo_estimado'].split(
                ':');

            const tiempo_duracion = new Date(0, 0, 0, +hours3, +minutes3, +
                seconds3);

            // Se obtienen los intervalos de tiempos necesarios para el corte, siendo cada intervalo de 30m
            var intervalos = 0;
            if (parseInt(hours3) > 0) {
                intervalos += hours3 * 2;
            }
            if (parseInt(minutes3) > 0) {
                intervalos += 1;
            }
            console.log(
                'intervalo'
            )
            console.log(intervalos);
            console.log(tiempo_duracion);

            if (horarios.length > 0) {
                horarios.forEach(function(horario, i) {
                    console.log(i);
                    console.log(horario);
                    if (horarios[i + intervalos - 1] !== undefined) {
                        const [hours1, minutes1, seconds1] = horario['hora_inicio'].split(
                            ':');
                        const [hours2, minutes2, seconds2] = horario['hora_fin'].split(':');



                        const hora_inicio = new Date(0, 0, 0, +hours1, +minutes1, +
                            seconds1);
                        const hora_fin = new Date(0, 0, 0, +hours2, +minutes2, +seconds2);



                        const [hours4, minutes4, seconds4] = [parseInt(hours1) + parseInt(
                            hours3), parseInt(minutes1) + parseInt(minutes3), parseInt(
                            seconds1) + parseInt(seconds3)];

                        console.log('------------');
                        console.log(hours4);
                        console.log(minutes4);


                        const hora_fin_del_corte = new Date(0, 0, 0, +hours4, +minutes4, +
                            seconds4);
                        console.log('------------');
                        console.log(hora_inicio);
                        console.log(hora_fin);
                        console.log(hora_fin_del_corte);
                        console.log('------------');

                        // Queda pendiente comparar los horarios para determinar si el largo del corte puede ser realizado en 1 o n rangos de 30m disponible

                    } else {
                        alert('Este intervalo no se puede utilizar');
                    }

                });
            }
            console.log(horarios);
            console.log(corte);
        } else { // Si la fecha seleccionada no está como fecha disponible se emite un alert

            alert('Esta fecha no tiene horarios disponibles');
        }

    }
});


// Use JavaScript to change the calendar size.
picker.calendarContainer.style.setProperty('font-size', '2rem');
</script>