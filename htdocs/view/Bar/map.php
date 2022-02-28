<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado usuarios - Panel admin</title>
    <base href="<?= dirname(get_server_index_base_url()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/OpenLayers-popup@4.0.0/src/OpenLayers-popup.css" />
</head>

<body>
    <?php require "view/nav.php" ?>
    <main>
        <section class="container py-5 row mx-auto">
            <iframe width="600" height="450" style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBnpA8OHW5IHTznjr-RQe865PptRlKDvPQ
    &q=Space+Needle,Seattle+WA">
            </iframe>
        </section>
    </main>
    <script>
        map = new OpenLayers.Map("mapdiv");
        map.addLayer(new OpenLayers.Layer.OSM());

        var lonLat = new OpenLayers.LonLat(-0.1279688, 51.5077286)
            .transform(
                new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                map.getProjectionObject() // to Spherical Mercator Projection
            );

        var zoom = 16;

        var markers = new OpenLayers.Layer.Markers("Markers");
        map.addLayer(markers);

        markers.addMarker(new OpenLayers.Marker(lonLat));

        map.setCenter(lonLat, zoom);

        var popup = new Popup();
        map.addOverlay(popup);

        map.on('singleclick', function(evt) {
            var prettyCoord = OpenLayers.coordinate.toStringHDMS(OpenLayers.proj.transform(evt.coordinate, 'EPSG:4326', 'EPSG:4326'), 2);
            popup.show(evt.coordinate, '<div><h2>Coordinates</h2><p>' + prettyCoord + '</p></div>');
        });
    </script>
    <?php require "view/footer.php" ?>
    <script src="js/jquery-3.6.0.min.js"></script>
</body>

</html>