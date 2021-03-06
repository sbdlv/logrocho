<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pincho->name ?> - Pincho - Ficha</title>
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
                <h1><?=$pincho->name?> - Pincho</h1>
            </div>
            <div class="row my-4">
                <div class="col tarjeta p-4">
                    <h2 class="mb-4"><i class="fas fa-info-circle"></i> Detalles</h2>
                    <input type="hidden" id="pincho_id" value="<?= $pincho->id ?>" autocomplete="off">
                    <div class="table-responsive">
                        <table class="table customize-table mb-0 v-middle table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre</td>
                                    <td><input type="text" name="" id="pincho_name" value="<?= $pincho->name ?>" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <td>Descripción</td>
                                    <td><textarea name="" id="pincho_desc" cols="30" rows="10" autocomplete="off"><?= $pincho->desc ?></textarea></td>
                                </tr>
                                <tr>
                                    <td>Bar</td>
                                    <td>
                                        <select name="" id="pincho_bar_id" autocomplete="false">
                                            <?php foreach ($bars as $bar) : ?>
                                                <option value="<?= $bar->id ?>" <?= $bar->id  == $pincho->bar_id ? "selected" : "" ?>><?= $bar->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Precio</td>
                                    <td><input type="number" name="" id="pincho_price" value="<?= $pincho->price ?>" autocomplete="off">€</td>
                                </tr>
                                <tr>
                                    <td>Alérgenos</td>
                                    <td>
                                        <select name="" id="pincho_allergens" multiple autocomplete="off">
                                            <?php foreach ($allergens as $allergen) : ?>
                                                <option value="<?= $allergen["id"] ?>" <?= in_array($allergen["id"], $currentAllergens) ? "selected" : "" ?>><?= $allergen["name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Puntuación</td>
                                    <td class="puntuacionWrapper"><?= $pincho->rating ?><i class="fas fa-star"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row tarjeta p-4 mb-4">
                <h2 class="mb-4"><i class="fas fa-images"></i></i> Multimedia</h2>
                <div class="pinchoimgs imgdroparea" id="pincho_images">

                </div>
            </div>
            <div class="row tarjeta p-4">
                <h2 class="mb-4"><i class="fas fa-gavel"></i> Reseñas</h2>
                <?php if (count($reviews)) : ?>
                    <?php foreach ($reviews as $review) : ?>
                        <?php require "view/Review/templates/card-backoffice-related.php"?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Este pincho no tiene reseñas</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <button class="save_btn btn btn-success m-4" id="save_btn"><i class="far fa-save"></i> Guardar</button>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/image-uploader.min.js"></script>
    <script src="js/imgdroparea.js"></script>
    <script src="js/admin/info/pincho.js"></script>

</body>

</html>