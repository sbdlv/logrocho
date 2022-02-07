<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#<?= $review->id ?> - Reseña - Ficha</title>

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
                <h1>#<?= $review->id ?> - Reseña</h1>
            </div>
            <div class="row my-4">
                <div class="col tarjeta p-4">
                    <h2 class="mb-4"><i class="fas fa-info-circle"></i> Detalles</h2>
                    <div class="table-responsive">
                        <table class="table customize-table mb-0 v-middle table-borderless">
                            <tbody>
                                <tr>
                                    <td>Usuario</td>
                                    <td><a href="<?=getServerAbsPathForActions()?>user/info/<?= $review->user_id ?>">Ver ficha</a></td>
                                </tr>
                                <tr>
                                    <td>Pincho</td>
                                    <td><a href="<?=getServerAbsPathForActions()?>pincho/info/<?= $review->pincho_id ?>">Ver ficha</a></td>
                                </tr>
                                <tr>
                                    <td>Titulo</td>
                                    <td><?= $review->title ?></td>
                                </tr>
                                <tr>
                                    <td>Descripción</td>
                                    <td><?= $review->desc ?></td>
                                </tr>
                                <tr>
                                    <td>Presentación</td>
                                    <td class="puntuacionWrapper"><?= $review->presentation ?><i class="fas fa-star"></i></td>
                                </tr>
                                <tr>
                                    <td>Sabor</td>
                                    <td class="puntuacionWrapper"><?= $review->taste ?><i class="fas fa-star"></i></td>
                                </tr>
                                <tr>
                                    <td>Textura</td>
                                    <td class="puntuacionWrapper"><?= $review->texture ?><i class="fas fa-star"></i></td>
                                </tr>
                                <tr>
                                    <td>Me gusta <i class="fas fa-thumbs-up"></i></td>
                                    <td>?</td>
                                </tr>
                                <tr>
                                    <td>No me gusta <i class="fas fa-thumbs-down"></i></td>
                                    <td>?</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="puntuacionWrapper h3">
                            <div class="font-weight-bold mt-4 d-inline-block">Total (Calculado): </div> ? <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row tarjeta p-4">
                <h2 class="mb-4"><i class="fas fa-images"></i></i> Multimedia</h2>
                <div class="displa-felx imagenes_reseña">
                    <img src="img/pt1.jpg" alt="">
                    <img src="img/pt2.jpg" alt="">
                </div>
            </div>
        </section>
    </main>
</body>

</html>