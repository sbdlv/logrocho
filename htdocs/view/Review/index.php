<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <base href="<?= dirname(getServerAbsPathForActions()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include "view/side_bar_admin.php" ?>
    <main class="w-100 p-4">
        <div class="container">
            <h1 class="mb-4">Reseñas</h1>
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
                                    <div class="form-group">
                                        <label for="pincho" class="h5">Pincho</label>
                                        <input type="text" class="form-control" name="pincho" id="pincho">
                                    </div>
                                    <label for="total" class="h5 mt-3">Presentación</label>
                                    <select class="form-select" aria-label="Selector de terraza" id="total">
                                        <option selected value="any">Cualquiera</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <label for="total" class="h5 mt-3">Sabor</label>
                                    <select class="form-select" aria-label="Selector de terraza" id="total">
                                        <option selected value="any">Cualquiera</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <label for="total" class="h5 mt-3">Textura</label>
                                    <select class="form-select" aria-label="Selector de terraza" id="total">
                                        <option selected value="any">Cualquiera</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <label for="total" class="h5 mt-3">Puntuación total</label>
                                    <select class="form-select" aria-label="Selector de terraza" id="total">
                                        <option selected value="any">Cualquiera</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <input type="submit" value="Búsqueda avanzada" class="btn btn-primary mt-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <section class="tarjeta p-5 seccion-info">
                <div class="table-responsive">
                    <table class="table customize-table mb-0 v-middle table-borderless">
                        <thead class="table-light">
                            <tr>
                                <th>Usuario</th>
                                <th>Titulo</th>
                                <th>Descripción</th>
                                <th class="text-center">Presentación</th>
                                <th class="text-center">Sabor</th>
                                <th class="text-center">Textura</th>
                                <th class="text-center">Total (Calculado)</th>
                                <th class="text-center">Me gusta</th>
                                <th class="text-center">No me gusta</th>
                                <th class="text-center">Pincho</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reviews as $review) : ?>
                            <tr>
                                <td class="text-center"><a href="<?=getServerAbsPathForActions()?>user/info/<?= $review->user_id ?>">Ver ficha</a></td>
                                <td><?=$review->title?></td>
                                <td><?=$review->desc?></td>
                                <td class="puntuacionWrapper text-center"><?=$review->presentation?><i class="fas fa-star"></i></td>
                                <td class="puntuacionWrapper text-center"><?=$review->taste?><i class="fas fa-star"></i></td>
                                <td class="puntuacionWrapper text-center"><?=$review->texture?><i class="fas fa-star"></i></td>
                                <td class="puntuacionWrapper text-center">?<i class="fas fa-star"></i></td>
                                <td class="text-center">?</td>
                                <td class="text-center">?</td>
                                <td class="text-center"><a href="<?=getServerAbsPathForActions()?>pincho/info/<?= $review->pincho_id ?>">Ver ficha</a></td>
                                <td class="text-center">
                                    <div class="d-flex">
                                        <a href="<?= getServerAbsPathForActions() ?>review/info/<?= $review->id ?>" class="btn btn-primary" title="Ver ficha"><i class="fas fa-external-link-alt"></i></a>
                                        <button class="btn btn-danger ms-2" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <nav class="mt-4">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>
    </main>
</body>

</html>