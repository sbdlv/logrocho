<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pincho->name ?> - Pincho - Ficha</title>
    <base href="<?= dirname(getServerAbsPathForActions()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "view/side_bar_admin.php" ?>
    <main class="w-100 p-4">
        <section class="container my-4">
            <?php include "view/breadcrumbs.php" ?>
            <div class="tarjeta row p-4">
                <h1>Pincho de tortilla - Pincho</h1>
            </div>
            <div class="row my-4">
                <div class="col-12 col-lg-4 tarjeta"><img src="img/pt1.jpg" class="img-fluid my-2" alt=""></div>
                <div class="col offset-lg-1 tarjeta p-4">
                    <h2 class="mb-4"><i class="fas fa-info-circle"></i> Detalles</h2>
                    <div class="table-responsive">
                        <table class="table customize-table mb-0 v-middle table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre</td>
                                    <td><?= $pincho->name ?></td>
                                </tr>
                                <tr>
                                    <td>Alérgenos</td>
                                    <td><img src="img/alergenos/Huevos.png" class="icono_alergeno" alt="Alérgeno huevos" title="Alérgeno huevos"><img src="img/alergenos/Gluten.png" class="icono_alergeno" title="Alérgeno gluten" alt="Alérgeno gluten"></td>
                                </tr>
                                <tr>
                                    <td>Puntuación</td>
                                    <td class="puntuacionWrapper">?<i class="fas fa-star"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row tarjeta p-4 mb-4">
                <h2 class="mb-4"><i class="fas fa-images"></i></i> Multimedia</h2>
                <div class="displa-felx imagenes_reseña">
                    <img src="img/pt1.jpg" alt="">
                    <img src="img/pt2.jpg" alt="">
                </div>
            </div>
            <div class="row tarjeta p-4">
                <h2 class="mb-4"><i class="fas fa-gavel"></i> Reseñas</h2>
                <h3 class="h4">Destacada</h3>
                <div class="tarjeta reseña_destacada row p-4 mb-4">
                    <div class="imgWrapper col-3"><img class="img-fluid" src="img/pfp.jpg" alt=""></div>
                    <div class="col">
                        <h4>¡Lo mejor que he probado nunca!</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati eligendi quidem fuga
                            eveniet quod. Ad aliquam rem ut! Quaerat beatae id sapiente inventore dolor harum omnis odit
                            reiciendis ratione in.</p>
                        <div class="puntuacionWrapper">Presentación: 5<i class="fas fa-star"></i></div>
                        <div class="puntuacionWrapper">Sabor: 5<i class="fas fa-star"></i></div>
                        <div class="puntuacionWrapper">Textura: 5<i class="fas fa-star"></i></div>
                        <div class="puntuacionWrapper mb-4">Total (Calculado): 5<i class="fas fa-star"></i></div>
                        <div class="">Me gusta: 3</div>
                        <div class="mb-4">No me gusta: 3</div>
                        <a href="ficha_resenia.html" class="btn btn-primary">Ver reseña</a>
                    </div>
                </div>
                <a class="btn btn-primary" href="listado_resenia.html?pincho=123">Ver más reseñas</a>
            </div>
        </section>
    </main>
</body>

</html>