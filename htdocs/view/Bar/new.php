<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Bar</title>
    <base href="<?= dirname(get_server_index_base_url()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/image-uploader.min.css">
</head>

<body>
    <?php include "view/side_bar_admin.php" ?>
    <main class="w-100 p-4">
        <section class="container">
            <?php include "view/breadcrumbs.php" ?>
            <div class="tarjeta row p-4">
                <h1>Añadir un nuevo Bar</h1>
            </div>
            <div class="row my-4">
                <div class="col tarjeta p-4">
                    <h2 class="mb-4"><i class="fas fa-info-circle"></i> Detalles</h2>
                    <input type="hidden" id="bar_id" value="">
                    <div class="table-responsive">
                        <table class="table customize-table mb-0 v-middle table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre</td>
                                    <td><input type="text" name="" id="bar_name" value=""></td>
                                </tr>
                                <tr>
                                    <td>Dirección</td>
                                    <td><input type="text" name="" id="bar_address" value=""></td>
                                </tr>
                                <tr>
                                    <td>Puntuación</td>
                                    <td class="puntuacionWrapper">?<i class="fas fa-star"></i></td>
                                </tr>
                                <tr>
                                    <td>Terraza</td>
                                    <td><input type="checkbox" name="" id="bar_terrace"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row tarjeta p-4 mb-4">
                <h2><i class="fas fa-images"></i> Imágenes</h2>
                <div class="alert alert-primary mt-2" role="alert">
                    Solo se pueden subir imágenes una vez se ha guardado el bar.
                </div>
            </div>
            <div class="row tarjeta">
                <div class="col-12 col-md-6 p-4">
                    <h2 class="mb-4"><i class="fas fa-map-marker-alt"></i> Localización</h2>
                    <div class="table-responsive">
                        <table class="table customize-table mb-0 v-middle table-borderless">
                            <tbody>
                                <tr>
                                    <td>Lon. </td>
                                    <td><input type="number" name="" id="bar_lon" value=""></td>
                                </tr>
                                <tr>
                                    <td>Lat. </td>
                                    <td><input type="number" name="" id="bar_lat" value=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-6"><img src="img/maps.png" class="img-fluid my-2" alt=""></div>
            </div>
        </section>
    </main>

    <button class="save_btn btn btn-success m-4" id="save_btn"><i class="far fa-save"></i> Guardar</button>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/admin/new/bar.js"></script>

</body>

</html>