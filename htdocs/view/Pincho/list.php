<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <base href="<?= dirname(get_server_index_base_url()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include "view/side_bar_admin.php" ?>
    <main class="w-100 p-4">
        <section class="container">
            <h1 class="mb-4">Pinchos</h1>
            <section class="mb-5">
                <form action="listado.html" method="GET">
                    <div id="searchWrapper" class="mb-4">
                        <input type="text" id="search" class="form-control ">
                        <div class="enviar position-absolute">
                            <i class="fas fa-search"></i>
                            <input type="submit" class="btn" value="">
                        </div>
                    </div>
                    <div class="accordion tarjeta mb-5" id="accordionPrimary">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h2 class="h4 m-0">Busqueda avanzada</h2>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionPrimary">
                                <div class="accordion-body">
                                    <label for="bar" class="h5">Bar</label>
                                    <input type="text" class="form-control" name="bar" id="bar">
                                    <label for="terraza" class="h5 mt-3">Puntuación</label>
                                    <select class="form-select" aria-label="Selector de terraza" id="terraza">
                                        <option selected value="any">Cualquiera</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <div class="form-group">
                                        <label for="alergenos" class="h5 mt-3">Alérgenos</label>
                                        <select class="form-select" name="alergenos" id="alergenos" multiple>
                                            <option value="any" selected>Cualquiera</option>
                                            <option value="none">Sin alergenos</option>
                                            <option value="gluten">Gluten</option>
                                            <option value="huevos">Huevos</option>
                                        </select>
                                    </div>
                                    <input type="submit" value="Búsqueda avanzada" class="btn btn-primary mt-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <section class="tarjeta p-5 seccion-info">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="<?= get_server_index_base_url() ?>pincho/new">Añadir nuevo</a>
                </div>
                <div class="table-responsive mb-2" id="mainTableWrapper">

                </div>
            </section>
        </section>
    </main>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/ajax-tables.js"></script>
    <script src="js/admin/pincho.js"></script>
</body>

</html>