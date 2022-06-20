<head>
    <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script type="text/javascript" src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style type="text/css">
    body {
        margin-bottom: 25px;
    }

    #map:focus {
        outline: #4A74A8 solid 0.15em;
    }

    .overlay-label {
        text-decoration: none;
        color: white;
        font-size: 11pt;
        font-weight: bold;
        text-shadow: black 0.1em 0.1em 0.2em;
    }

    .container {
        margin: 0 auto;
        max-width: 112rem;
        padding: 0 2rem;
        position: relative;
        width: 100%;
    }

    .popover-content {
        min-width: 250px;
    }
    </style>
</head>

<body>
    <div id="map" class="map">
        <div id="popup"></div>
    </div>
    <?php
    //Convertimos la lista de Barberias a JSON encoded (EN PHP)
    //Luego en JavaScript convertimos el JSON a un array de objetos, utilizando la variable de PHP (EN JAVASCRIPT)
    $listaBarberiasConvertidas = array();
    foreach ($listaBarberias as $barberia) {
        if ($barberia->latitud != null && $barberia->longitud != null) {
            $listaBarberiasConvertidas[] = array(
                'id' => (int)$barberia->id,
                'color' => 'negro',
                'x' => (float)$barberia->longitud,
                'y' => (float)$barberia->latitud,
                'name' => $barberia->nombre,
                'address' => $barberia->direccion
            );
        }
    }
    $listaBarberiasJSONENCODE = json_encode($listaBarberiasConvertidas);
    ?>
    <script type="text/javascript">
    window.scrollTo(0, document.body.scrollHeight);
    <?php echo "var locationsJSONCODE = '$listaBarberiasJSONENCODE';" ?>
    var locations = JSON.parse(locationsJSONCODE);
    console.log(locations);
    /*var locations = [{
            'id': 1,
            'color': 'amarillo',
            'x': -57.6240,
            'y': -32.6987,
            'name': 'Barberia 1',
            'address': '18 de Julio y José Pedro Varela'
        },
        {
            'id': 2,
            'color': 'negro',
            'x': -57.6286,
            'y': -32.7035,
            'name': 'Barberia 2',
            'address': 'Calle tanto y calle otra tanto.'
        }
    ];
    console.log(locations);*/
    var features = [];
    $.each(locations, function() {
        var that = this;
        $('body').append($("<div id='overlay-" + that.id + "' />").addClass('overlay-label').html(that.name));
        var coordinates = new ol.geom.Point(ol.proj.transform([that.x, that.y], 'EPSG:4326', 'EPSG:3857'));
        var feature = new ol.Feature({
            id: that.id,
            geometry: coordinates,
            address: that.address,
            patito_color: that.color,
            name: that.name
        });
        feature.setStyle(
            new ol.style.Style({
                image: new ol.style.Icon({
                    opacity: 1,
                    scale: 1,
                    src: 'https://i.imgur.com/iYrSV3S.png'
                }),
                text: new ol.style.Text({
                    font: '11px helvatica, sans-serif',
                    fill: new ol.style.Fill({
                        color: '#FAFAFA'
                    })
                })
            })
        );

        features.push(feature);
    });
    var vectorSource = new ol.source.Vector({
        features: features
    });
    var vectorLayer = new ol.layer.Vector({
        source: vectorSource
    });
    var view = new ol.View({
        center: [0, 0],
        zoom: 2222
    });
    var map = new ol.Map({
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            }),
            vectorLayer
        ],
        target: 'map',
        view: view
    });
    map.getView().fit(vectorSource.getExtent(), map.getSize());
    var popup = new ol.Overlay({
        element: document.getElementById('popup')
    });
    map.addOverlay(popup);
    $.each(locations, function() {
        var that = this;
        var overlay = new ol.Overlay({
            position: ol.proj.fromLonLat([that.x, that.y]),
            element: document.getElementById('overlay-' + that.id)
        });
        map.addOverlay(overlay);
    });
    map.on('click', function(evt) {
        var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
            return feature;
        });
        var element = popup.getElement();
        $(element).popover('destroy');
        if (feature) {
            var coordinates = feature.getGeometry().getCoordinates();
            popup.setPosition(coordinates);
            //alert("//TODO: REDIRECT TO "+feature.get('name')); //Al dar Lick en el icono se muestra la direccion //SE PUEDE HACER UN REDIRECT

            $(element).popover({
                'placement': 'top',
                'animation': false,
                'html': true,
                //'content': '<p>' + feature.get('address') + ' patito color ' + feature.get('patito_color') + '</p>'
                'content': '<div style="width:auto;"><img src="https://www.pngkey.com/png/detail/409-4092711_proximamente-png-proximamente.png" alt="Barberia" style="width:100%"><div class="container"><h4><b>' +
                    feature.get('name') + '</b></h4> <p>' + feature.get(
                        'address') +
                    `</p> </div><button style="width: -webkit-fill-available; color:white !important;" ><a href="barbershop/ver/` +
                    feature.get('id') +
                    `">Visitar</a></button></div>`
            });
            $(element).popover('show');
        }
    });
    var geolocation = new ol.Geolocation({
        projection: view.getProjection()
    });
    geolocation.setTracking(true);
    var accuracyFeature = new ol.Feature();
    geolocation.on('change:accuracyGeometry', function() {
        accuracyFeature.setGeometry(geolocation.getAccuracyGeometry());
    });
    var positionFeature = new ol.Feature();
    positionFeature.setStyle(new ol.style.Style({
        image: new ol.style.Circle({
            radius: 6,
            fill: new ol.style.Fill({
                color: '#3399CC'
            }),
            stroke: new ol.style.Stroke({
                color: '#fff',
                width: 2
            })
        })
    }));
    geolocation.on('change:position', function() {
        var coordinates = geolocation.getPosition();
        positionFeature.setGeometry(coordinates ? new ol.geom.Point(coordinates) : null);
    });
    new ol.layer.Vector({
        map: map,
        source: new ol.source.Vector({
            features: [accuracyFeature, positionFeature]
        })
    });
    </script>
</body>