<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 * @var \Cake\Collection\CollectionInterface|string[] $cliente
 * @var \Cake\Collection\CollectionInterface|string[] $corte
 */
?>
<?php
if ($_COOKIE["theme"] == "dark") {
    $background = "#2a2b2e";
    $background2 = "#121316";
    $color = "#fff";
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
}
?>
<div class="row">
    <div class="column-responsive">
        <div class="reserva form content" style="background-color: <?php echo $background2; ?>!important;">
            <?= $this->Form->create($reserva) ?>
            <fieldset>
                <legend style="color: <?php echo $color; ?> !important; ">Reservar hora</legend>
                <input style="color: <?php echo $color; ?> !important; " type="text" id="fecha" name="fecha_corte"
                    class="some-input"></input>
                <div id="contendedor_tabla" class="column-responsive" hidden>

                    <table style="color: <?php echo $color; ?> !important; " id="tabla_horarios" hidden>
                        <thead>
                            <tr>
                                <th>Hora desde</th>
                                <th>Hora hasta</th>
                                <th>Reservar</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_body">

                        </tbody>
                    </table>
                </div>

            </fieldset>
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
console.log(fechas_unicas);

// Creo un arreglo con las fechas parseadas
const parsed_fechas = [];
fechas_unicas.forEach(function(fecha, index) {
    var fecha = new Date(fecha);
    var fecha_sin_error = new Date(fecha.getTime() + Math.abs(fecha.getTimezoneOffset() * 60000));
    parsed_fechas[index] = fecha_sin_error;
})

console.log(parsed_fechas);
// Creo el datepicker para seleccionar las fechas
const picker = datepicker('.some-input', {
    // Agrego los puntos en el calendario
    events: parsed_fechas,
    // Formateo la fecha
    formatter: (input, date, instance) => {
        const value = date.toLocaleDateString()
        input.value = value // => '1/1/2099'
    },
    // position: 'c',
    // Cambio el formato de los dias a ES
    customDays: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
    // Cambio el formato de los meses a ES
    customMonths: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
        'Octubre', 'Noviembre', 'Diciembre'
    ],

    // Funcion para saber cuandos se selecciona una fecha
    onSelect: (instance, date) => {
        console.log(instance);
        console.log(date);
        if (date !== undefined) {
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

            // Creo el arreglo de horarios
            horarios = [];

            // Si la fecha seleccionada es una de las fechas disponible obtengo los horarios
            if (fechas_pars.includes(fecha_seleccionada)) {
                // console.log('Mostrar los horarios de la fecha');
                // console.log(fecha_seleccionada);
                // console.log(fechas_disponibles);

                // Recorro las fechas disponibles 
                var indice = 0;
                fechas_disponibles.forEach(function(fecha) {
                    if (fecha['fecha'] === fecha_seleccionada) {
                        // Cuando la encuentro guardo como objeto la hora de inicio y la hora de fin
                        horarios[indice] = {
                            'hora_inicio': fecha['hora_inicio'],
                            'hora_fin': fecha['hora_fin'],
                            'id': fecha['id'],
                        }
                        indice++;
                    }
                });
                // console.log(horarios);

                function convertirHoraADate(hora_string) {
                    const [hours, minutes, seconds] = hora_string.split(':');
                    const hora_date = new Date(0, 0, 0, +hours, +minutes, +seconds);
                    return hora_date;
                }

                console.log('Horarios sin ordenar');
                console.log(horarios);

                horarios.sort((a, b) =>
                    convertirHoraADate(a['hora_inicio']) > convertirHoraADate(b['hora_inicio']) ? 1 :
                    convertirHoraADate(b['hora_inicio']) > convertirHoraADate(a['hora_inicio']) ? -1 :
                    0
                );

                console.log('Horarios ordenados');
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


                var horarios_utilizables = [];

                var intervalos_tiempo = [];

                var tiene_intervalos_necesarios = true;
                if (horarios.length > 0) {
                    horarios.forEach(function(horario, i) {
                        var intervalos_tiempo = [];

                        // Guardo horas, minutos y segundos de hora_inicio
                        const [hours1, minutes1, seconds1] = horario['hora_inicio'].split(
                            ':');

                        // Guardo horas, minutos y segundos de hora_fin
                        const [hours2, minutes2, seconds2] = horario['hora_fin'].split(':');


                        // Convierto hora_inicio a tipo date
                        const hora_inicio = new Date(0, 0, 0, +hours1, +minutes1, +
                            seconds1);

                        // Convierto hora_fin a tipo date
                        const hora_fin = new Date(0, 0, 0, +hours2, +minutes2, +seconds2);


                        // Guardo horas, minutos y segundos de hora_fin_del_corte, sumando a la hora de inicio el tiempo que lleva realizar el corte
                        const [hours4, minutes4, seconds4] = [parseInt(hours1) + parseInt(
                            hours3), parseInt(minutes1) + parseInt(minutes3), parseInt(
                            seconds1) + parseInt(seconds3)];

                        // Convierto hora_fin_del_corte a tipo date
                        const hora_fin_del_corte = new Date(0, 0, 0, +hours4, +minutes4, +
                            seconds4);

                        function convertirDateAHora(fechaAConvertir) {
                            var hora = fechaAConvertir.getHours();
                            var minutos = fechaAConvertir.getMinutes();
                            var segundos = fechaAConvertir.getSeconds();
                            if (fechaAConvertir.getHours() < 10) {
                                hora = '0' + fechaAConvertir.getHours();
                            }
                            if (fechaAConvertir.getMinutes() < 10) {
                                minutos = '0' + fechaAConvertir.getMinutes();
                            }
                            if (fechaAConvertir.getSeconds() < 10) {
                                segundos = '0' + fechaAConvertir.getSeconds();
                            }
                            const fecha_string = hora + ':' + minutos + ':' + segundos;
                            return fecha_string;
                        }

                        const hora_fin_corte_string = convertirDateAHora(hora_fin_del_corte);
                        console.log('Esta hora quiero ver: ' + hora_fin_corte_string);


                        if (horarios[i + intervalos - 1] !== undefined) {

                            // console.log('entró acá');

                            for (var j = 0; j < horarios.length; j++) {
                                if (horarios[j]['hora_fin'] === hora_fin_corte_string) {
                                    // console.log('Este sirve');
                                    for (var n = 0; n < intervalos; n++) {
                                        var hora_fn = new Date(
                                            convertirHoraADate(horarios[j]['hora_fin'])
                                            .getTime() - n * 30 * 60000); // Resto 30 minutos

                                        // Tomar el horarios[j][hora_fin] y restarle 30 minutos, 
                                        // si existe continuar hasta que finalice el for. 
                                        // Si en algun momento no existe, hacer un break

                                        var hora_fin_previa = horarios.filter(
                                            (obj) => obj['hora_fin'] === convertirDateAHora(
                                                hora_fn)
                                        );

                                        intervalos_tiempo.push(hora_fin_previa);

                                        if (hora_fin_previa.length === 0) {
                                            tiene_intervalos_necesarios = false;
                                            intervalos_tiempo = [];
                                            break;
                                        }
                                        console.log('Hora fin previa')
                                        console.log(hora_fin_previa);

                                    }
                                    if (tiene_intervalos_necesarios) {
                                        horarios_utilizables.push({
                                            'horario': horario,
                                            'requiere_intervalos': intervalos_tiempo,
                                        });
                                        break;
                                    }

                                }
                            }

                            // console.log('Esta hora de inicio interesan 👇');
                            // console.log(hora_inicio);
                            // console.log(hora_inicio.getTime());
                            // console.log(new Date(hora_inicio.getTime() + ((2 * 30) * 60000)));

                            // Esto todavia no anda //
                            // for (var n = 0; n < intervalos; n++) {
                            //     var hora_in = new Date(hora_inicio.getTime() + n * 30 * 60000);
                            //     var hora_fn = new Date(hora_fin.getTime() + n * 30 * 60000);
                            //     var horarioObtenido = horarios.filter((obj) => obj.hora_inicio ===
                            //         convertirDateAHora(hora_in))
                            //     console.log(hora_in);
                            //     console.log(hora_fn);
                            //     // console.log(hora_inicio);
                            //     // console.log(hora_fin);
                            //     intervalos_tiempo.push({
                            //         'hora_inicio': convertirDateAHora(hora_in),
                            //         'hora_fin': convertirDateAHora(hora_fn),
                            //         'id': horarioObtenido[0]['id'],
                            //     });

                            // }
                            // console.log('Estos son los intervalos que me interesan 👇');
                            // console.log(intervalos_tiempo);
                            // Esto todavia no anda //
                        }


                    });
                }


                // Find a <table> element with id="tabla_horarios":



                if (horarios_utilizables.length > 0) {
                    var table = document.getElementById("tabla_body");
                    $('#tabla_horarios').show();
                    $("#tabla_body tr").remove();
                    $("#no_existe").remove();
                    horarios_utilizables.forEach(function(horario, i) {
                        // Create an empty <tr> element and add it to the 1st position of the table:
                        var row = table.insertRow();

                        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                        var cell1 = row.insertCell();
                        var cell2 = row.insertCell();
                        var cell3 = row.insertCell();
                        var cell4 = row.insertCell();
                        var cell5 = row.insertCell();

                        // console.log('Este horario es el del html');
                        // console.log(horario);

                        // Add some text to the new cells:
                        cell1.innerHTML = horario['horario']['hora_inicio'];
                        cell2.innerHTML = horario['requiere_intervalos'][0][0]['hora_fin'];
                        cell3.innerHTML = `<button type='submit' name='boton_presionado' value=` +
                            i + `>Reservar</button>`;


                        arreglo_id_horario = [];

                        horario['requiere_intervalos'].forEach(function(horario, i) {
                            arreglo_id_horario.push(horario[0]['id']);
                        });

                        cell4.innerHTML = '<input type="hidden" name="' + i + '" value=' +
                            arreglo_id_horario + ' >';

                        cell5.innerHTML = '<input type="hidden" name="h_i' + i + '" value=' +
                            horario['horario']['hora_inicio'] + ' >';

                        // console.log(arreglo_id_horario);

                    })
                } else {
                    $('#tabla_horarios').hide();
                    $('#contendedor_tabla').append(
                        '<p id="no_existe">La duración de su corte excede los horarios disponibles para este día.</p>'
                    )
                }


            } else { // Si la fecha seleccionada no está como fecha disponible se emite un alert

                alert('Esta fecha no tiene horarios disponibles');
            }

            console.log('Horarios utilizables 👇');
            console.log(horarios_utilizables);
            console.log('Horarios 👇');
            console.log(horarios);
            console.log('Corte 👇');
            console.log(corte);
        } else if (date === undefined) {
            $('#tabla_horarios').hide();
            $("#no_existe").remove();
        }
    },

});
picker.show();

// Use JavaScript to change the calendar size.
picker.calendarContainer.style.setProperty('font-size', '3rem');
</script>