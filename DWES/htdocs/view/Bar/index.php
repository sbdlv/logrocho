<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado usuarios - Panel admin</title>
    <base href="<?= dirname(getServerAbsPathForActions()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/listado.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">

</head>

<body>
    <aside class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" id="side_bar_admin">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <i class="fas fa-tools me-2"></i>
            <span class="fs-4">Panel admin</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-2">
                <a href="listado_restaruante.html" class="nav-link active" aria-current="page">
                    <i class="fas fa-store"></i>
                    Restaurantes
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="listado_pincho.html" class="nav-link text-white">
                    <i class="fas fa-utensils"></i>
                    Pinchos
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="listado_usuario.html" class="nav-link text-white">
                    <i class="fas fa-users"></i>
                    Usuarios
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="listado_resenia.html" class="nav-link text-white">
                    <i class="fas fa-gavel"></i>
                    Reseñas
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="index.html" class="btn bg-danger text-white"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </aside>
    <main class="w-100 p-4">
        <div class="container">
            <h1 class="mb-4">Bares</h1>
            <section class="mb-5">
                <form action="listado.html" method="GET">
                    <div id="searchWrapper" class="mb-4">
                        <input type="text" id="search" class="form-control ">
                        <div class="enviar position-absolute">
                            <i class="fas fa-search"></i>
                            <input type="submit" class="btn" value="">
                        </div>
                    </div>
                    <div class="tarjeta p-5">
                        <h2 class="h4 mb-4">Busqueda avanzada</h2>
                        <div class="form-group">
                            <label for="terraza" class="h5">Terraza</label>
                            <select class="form-select" aria-label="Selector de terraza" id="terraza">
                                <option selected value="any">Cualquiera</option>
                                <option value="con_terraza">Con terraza</option>
                                <option value="no_terraza">Sin terraza</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="terraza" class="h5 mt-3">Puntuación</label>
                            <select class="form-select" aria-label="Selector de terraza" id="terraza">
                                <option selected value="any">Cualquiera</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <input type="submit" value="Búsqueda avanzada" class="btn btn-primary mt-4">
                    </div>
                </form>
            </section>
            <section class="tarjeta p-5 seccion-info">
                <div class="table-responsive">
                    <table class="table customize-table mb-0 v-middle table-borderless">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th class="text-center">Tiene terraza</th>
                                <th class="text-center">Puntuación</th>
                                <th class="text-center">Lon.</th>
                                <th class="text-center">Lat.</th>
                                <th class="text-center">Ver ficha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bars as $bar) : ?>
                                <tr>
                                    <td><?=$bar->name?></td>
                                    <td><?=$bar->address?></td>
                                    <td class="text-center"><?=$bar->terrace ? "Si": "No"?></td>
                                    <td class="puntuacionWrapper text-center">?<i class="fas fa-star"></i></td>
                                    <td class="text-center"><?=$bar->lon?></td>
                                    <td class="text-center"><?=$bar->lat?></td>
                                    <td class="text-center"><a href="ficha_restaurante.html"><i class="fas fa-external-link-alt"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</body>

</html>