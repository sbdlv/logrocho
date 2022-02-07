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
                                <th class="text-center">Ver ficha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Marcos_dp99</td>
                                <td>¡Lo mejor que he probado nunca!</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati eligendi quidem
                                    fuga eveniet quod. Ad aliquam rem ut! Quaerat beatae id sapiente inventore dolor
                                    harum omnis odit reiciendis ratione in.</td>
                                <td class="puntuacionWrapper text-center">5<i class="fas fa-star"></i></td>
                                <td class="puntuacionWrapper text-center">5<i class="fas fa-star"></i></td>
                                <td class="puntuacionWrapper text-center">5<i class="fas fa-star"></i></td>
                                <td class="puntuacionWrapper text-center">5<i class="fas fa-star"></i></td>
                                <td class="text-center">3</td>
                                <td class="text-center">1</td>
                                <td class="text-center"><a href="ficha_resenia.html"><i class="fas fa-external-link-alt"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</body>

</html>