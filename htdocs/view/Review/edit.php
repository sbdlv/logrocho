<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#<?= $review->id ?> - Reseña - Ficha</title>

    <base href="<?= dirname(get_server_index_base_url()) ?>/">
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
                    <input type="hidden" id="review_id" value="<?= $review->id ?>">
                    <div class="table-responsive">
                        <table class="table customize-table mb-0 v-middle table-borderless">
                            <tbody>
                                <tr>
                                    <td>Usuario</td>
                                    <td>
                                        <select name="" id="review_user_id" autocomplete="false">
                                            <?php foreach ($users as $user) : ?>
                                                <option value="<?= $user->id ?>" <?= $user->id == $review->user_id ? "selected" : "" ?>><?= $user->email ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pincho</td>
                                    <td class="d-flex align-items-center">
                                        <select name="" id="review_pincho_id" autocomplete="false">
                                            <?php foreach ($pinchos as $pincho) : ?>
                                                <option value="<?= $pincho->id ?>" <?= $pincho->id  == $review->pincho_id ? "selected" : "" ?>><?= $pincho->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button class="btn btn-primary ms-3" id="open_pincho"><i class="fas fa-external-link-alt"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Titulo</td>
                                    <td><input type="text" name="" id="review_title" value="<?= $review->title ?>"></td>
                                </tr>
                                <tr>
                                    <td>Descripción</td>
                                    <td><textarea class="w-100" id="review_desc" cols="30" rows="10"><?= $review->desc ?></textarea></td>
                                </tr>
                                <tr>
                                    <td>Presentación</td>
                                    <td class="puntuacionWrapper"><input type="number" name="" id="review_presentation" value="<?= $review->presentation ?>"><i class="fas fa-star"></i></td>
                                </tr>
                                <tr>
                                    <td>Sabor</td>
                                    <td class="puntuacionWrapper"><input type="number" name="" id="review_taste" value="<?= $review->taste ?>"><i class="fas fa-star"></i></td>
                                </tr>
                                <tr>
                                    <td>Textura</td>
                                    <td class="puntuacionWrapper"><input type="number" name="" id="review_texture" value="<?= $review->texture ?>"><i class="fas fa-star"></i></td>
                                </tr>
                                <tr>
                                    <td>Me gusta <i class="fas fa-thumbs-up"></i></td>
                                    <td><?=$review->likes?></td>
                                </tr>
                                <tr>
                                    <td>No me gusta <i class="fas fa-thumbs-down"></i></td>
                                    <td><?=$review->dislikes?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="puntuacionWrapper h3">
                            <div class="font-weight-bold mt-4 d-inline-block">Total (Calculado): </div> <?=round(($review->taste + $review->presentation + $review->texture) / 3, 1)?> <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <button class="save_btn btn btn-success m-4" id="save_btn"><i class="far fa-save"></i> Guardar</button>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/admin/info/review.js"></script>
</body>

</html>