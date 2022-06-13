<html>

<head>
    <title>CLICK HANDLER</title>
    <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
    <script>
        var map, vectorLayer, selectMarkerControl, selectedFeature;
        var lat = 21.7679;
        var lon = 78.8718;
        var zoom = 5;
        var curpos = new Array();
        var position;

        var fromProjection = new OpenLayers.Projection("EPSG:4326"); // Transform from WGS 1984
        var toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection

        var cntrposition = new OpenLayers.LonLat(lon, lat).transform(fromProjection, toProjection);

        function init() {
            map = new OpenLayers.Map("Map", {
                controls: [
                    new OpenLayers.Control.PanZoomBar(),
                    new OpenLayers.Control.LayerSwitcher({}),
                    new OpenLayers.Control.Permalink(),
                    new OpenLayers.Control.MousePosition({}),
                    new OpenLayers.Control.ScaleLine(),
                    new OpenLayers.Control.OverviewMap(),
                ]
            });
            var mapnik = new OpenLayers.Layer.OSM("MAP");
            var markers = new OpenLayers.Layer.Markers("Markers");

            map.addLayers([mapnik, markers]);
            map.addLayer(mapnik);
            map.setCenter(cntrposition, zoom);

            markers.addMarker(new OpenLayers.Marker(cntrposition));

            var click = new OpenLayers.Control.Click();
            map.addControl(click);

            click.activate();
        };

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
                lonlat1 = new OpenLayers.LonLat(lonlat.lon, lonlat.lat).transform(toProjection, fromProjection);
                alert("Hello..." + lonlat1.lon + "  " + lonlat1.lat);

            }

        });
    </script>
</head>

<body onload='init();'>
    <div id="Map" style="height: 650px"></div>

</body>

</html>