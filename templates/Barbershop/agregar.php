<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbershop $barbershop
 * @var \Cake\Collection\CollectionInterface|string[] $barbero
 */
?>
<div class="row">
    <div class="column-responsive">
        <div class="barbershop form content">
            <?= $this->Form->create($barbershop, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Barbershop') ?></legend>
                <?php
                echo $this->Form->control('nombre');
                ?>
                <legend>Seleccione en el mapa el lugar donde se encuentra la barbería</legend>
                <body onload='init();'>
                    <div id="Map" style="height: 400px"></div>
                </body>
                <?php
                echo $this->Form->control('direccion', array('readonly' => 'readonly'));
                echo $this->Form->control('longitud', array('readonly' => 'readonly'));
                echo $this->Form->control('latitud', array('readonly' => 'readonly'));
                echo $this->Form->control('imagen_perfil', ['type' => 'file']);
                echo $this->Form->control('tel');
                echo $this->Form->control('email');
                echo $this->Form->control('website');
                echo $this->Form->control('habilitado');
                ?>
                <div hidden>
                    <?php
                    echo $this->Form->control('barbero._ids', ['options' => $barbero, 'default' => $barberoLogeado]);
                    ?>
                </div>

            </fieldset>
            <?= $this->Html->link(__('Volver'), array('controller' => 'Barbero', 'action' => 'index'), ['class' => 'button']) ?>
            <?= $this->Form->button(__('Agregar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
<script>
    var map, vectorLayer, selectMarkerControl, selectedFeature;
    var lat = -33.021;
    var lon = -55.789;
    var zoom = 7;
    var curpos = new Array();
    var position;

    var fromProjection = new OpenLayers.Projection("EPSG:4326"); // Transform from WGS 1984
    var toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection

    var cntrposition = new OpenLayers.LonLat(lon, lat).transform(fromProjection, toProjection);

    function init() {
        map = new OpenLayers.Map("Map", {

        });
        var mapnik = new OpenLayers.Layer.OSM("MAP");
        var markers = new OpenLayers.Layer.Markers("Markers");

        map.addLayers([mapnik]);
        map.addLayer(mapnik);
        map.setCenter(cntrposition, zoom);

        markers.addMarker(new OpenLayers.Marker(cntrposition));

        var click = new OpenLayers.Control.Click();
        map.addControl(click);

        click.activate();
    };

    function reverseGeocode(coordLon, coordLat) {
        return fetch('http://nominatim.openstreetmap.org/reverse?format=json&lon=' + coordLon + '&lat=' + coordLat)
        .then((response) => { 
            return response.json().then((data) => {
                return data;
            }).catch((err) => {
                console.log(err);
            }) 
        });
        /*return fetch('http://nominatim.openstreetmap.org/reverse?format=json&lon=' + coordLon + '&lat=' + coordLat)
            .then(function(response) {
                return response.json();
            }).then(function(json) {
                return json;
            })*/
    }

    OpenLayers.Control.Click = OpenLayers.Class(OpenLayers.Control, {
        defaultHandlerOptions: {
            'single': true,
            'double': false,
            'pixelTolerance': 0,
            'stopSingle': false,
            'stopDouble': false
        },

        initialize: function(options) {
            this.handlerOptions = OpenLayers.Util.extend({}, this.defaultHandlerOptions);
            OpenLayers.Control.prototype.initialize.apply(
                this, arguments
            );
            this.handler = new OpenLayers.Handler.Click(
                this, {
                    'click': this.trigger
                }, this.handlerOptions
            );
        },

        trigger: function(e) {
            var lonlat = map.getLonLatFromPixel(e.xy);
            var addressFromMap
            lonlat1 = new OpenLayers.LonLat(lonlat.lon, lonlat.lat).transform(toProjection, fromProjection);
            const addressResposne = reverseGeocode(lonlat1.lon, lonlat1.lat);
            reverseGeocode(lonlat1.lon, lonlat1.lat).then((data) => {
                //alert("Lon:" + lonlat1.lon + " | Lat: " + lonlat1.lat + "| Direccion:" + data.display_name);
                document.getElementById("direccion").value = data.display_name;
                document.getElementById("latitud").value = lonlat1.lat;
                document.getElementById("longitud").value = lonlat1.lon;
            });
        },




    });
</script>