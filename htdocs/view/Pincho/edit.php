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
                <h1>Pincho de tortilla - Pincho</h1>
            </div>
            <div class="row my-4">
                <div class="col tarjeta p-4">
                    <h2 class="mb-4"><i class="fas fa-info-circle"></i> Detalles</h2>
                    <input type="hidden" id="pincho_id" value="<?= $pincho->id ?>">
                    <div class="table-responsive">
                        <table class="table customize-table mb-0 v-middle table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre</td>
                                    <td><input type="text" name="" id="pincho_name" value="<?= $pincho->name ?>"></td>
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
                                    <td><input type="number" name="" id="pincho_price" value="<?= $pincho->price ?>">€</td>
                                </tr>
                                <tr>
                                    <td>Alérgenos</td>
                                    <td>
                                        <select name="" id="pincho_allergens" multiple autocomplete="false">
                                            <?php foreach ($allergens as $allergen) : ?>
                                                <option value="<?= $allergen["id"] ?>" <?= in_array($allergen["id"], $currentAllergens) ? "selected" : "" ?>><?= $allergen["name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
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
                <div class="pinchoimgs imgdroparea" id="pincho_images">

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

    <button class="save_btn btn btn-success m-4" id="save_btn"><i class="far fa-save"></i> Guardar</button>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/image-uploader.min.js"></script>
    <script src="js/imgdroparea.js"></script>
    <script>
        let ID = <?= $pincho->id ?>;
        let barimgs = $(".pinchoimgs");
        barimgs.ImgDropArea({
            <?php if (empty($pinchoImages)) : ?>
                imagesSrc: [],
            <?php else : ?>
                imagesSrc: <?= json_encode($pinchoImages[$pincho->id]) ?>,
            <?php endif; ?>
            additionalClass: "tarjeta",
            onChange: (data) => {
                console.log(data);
            },
            onAdd: () => {},
        })

        function uploadPic() {
            let input = document.createElement('input');
            input.type = 'file';
            input.accept = "image/png, image/jpeg";
            input.onchange = _ => {
                // you can use this method to get file and perform respective operations
                let files = Array.from(input.files);
                console.log(files);

                files.forEach(file => {
                    let fd = new FormData();
                    fd.append("pic", file);
                    fd.append("name", file.name);
                    fd.append("pk", ID);

                    $.ajax({
                        type: "POST",
                        url: "index.php/pincho/uploadPic",
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            barimgs.ImgDropAreaAdd([`/img/img_pinchos/${ID}/${file.name}`])
                        }
                    });
                });
            };
            input.click();
        }
    </script>

    <script src="js/admin/info/pincho.js"></script>

</body>

</html>