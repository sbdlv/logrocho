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

    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
</head>

<body>
    <?php require "view/nav.php" ?>
    <main>
        <section class="container py-5 row mx-auto">
            <div id="map" style="width:800px; height:600px;"></div>
        </section>
    </main>
    <script>
        let mapOptions = {
            center: [51.958, 9.141],
            zoom: 10
        }
        let map = new L.map('map', mapOptions);
        let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);
        let marker = new L.Marker([51.958, 9.141], {
            title: "Prueba",
            draggable: false,
        });
        
        marker.addTo(map);
        marker.bindPopup("content").openPopup();
    </script>
    <?php require "view/footer.php" ?>
    <script src="js/jquery-3.6.0.min.js"></script>
</body>

</html>