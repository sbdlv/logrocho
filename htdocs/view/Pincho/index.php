<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado usuarios - Panel admin</title>
    <base href="<?= dirname(get_server_index_base_url()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/OwlCarousel2/dist/assets/owl.carousel.min.css">
</head>

<body>
    <?php require "view/nav.php" ?>
    <main>
        <section class="container-fluid pt-5 pb-4 hero hero_pincho d-flex align-items-end" <?php if (!empty($data->multimedia)) : ?> style="background-image: url(<?= $data->multimedia[0] ?>), linear-gradient(0deg, rgba(0, 0, 0, 0.61) 0%, rgba(0,0,41,0) 100%);" <?php endif; ?>>
            <div class="container">
                <h1 class="mb-2"><?= $data->pincho->name ?></h1>
                <div class="mb-2">
                    <?php TemplateHelper::getStarts($data->pincho->rating) ?>
                </div>
                <a href="index.php/bar/<?= $data->pincho->bar_id ?>" class="link-info d-flex align-items-center">
                    <i class="fas fa-utensils m-0 me-3"></i>
                    <p class="m-0"><?= $data->pincho->bar_name ?></p>
                </a>
            </div>
        </section>
        <section class="container pt-5">
            <h2 class="mb-5 fw-bold">Fotos</h2>
            <?php if (empty($data->multimedia)) : ?>
                <p>Este pincho no contiene imágenes.</p>
            <?php else : ?>
                <div class="owl-carousel owl-theme multimedia_slider">
                    <?php foreach ($data->multimedia as $imageSrc) : ?>
                        <div class="item"><img src="<?= $imageSrc ?>" alt=""></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
        <section class="container py-5">
            <h2 class="mb-5 fw-bold">Reseñas</h2>
            <?php if (is_logged()) : ?>
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#reviewModal">Escribir una reseña</button>
                <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <input type="hidden" name="review_pincho_id" id="review_pincho_id" value="<?= $data->pincho->id ?>">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Publicar una reseña</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close_review_modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="w-100 mb-2">
                                    <label for="review_title" class="w-100 mb-2">Título</label>
                                    <input type="text" name="review_title" id="review_title" class="w-100">
                                </div>
                                <div class="w-100">
                                    <label for="review_desc" class="mb-2">Descripción</label>
                                    <textarea cols="30" rows="10" class="w-100 mb-4" id="review_desc" name="review_desc"></textarea>
                                </div>
                                <div class="w-100">
                                    <label for="review_taste">Sabor: <span id="review_taste_preview">3</label>
                                    <input type="range" class="w-100" name="" id="review_taste" min=0 max=5 value="3">
                                </div>
                                <div class="w-100">
                                    <label for="review_presentation">Presentación: <span id="review_presentation_preview">3</span></label>
                                    <input type="range" class="w-100" name="" id="review_presentation" min=0 max=5 value="3">
                                </div>
                                <div class="w-100">
                                    <label for="review_texture">Textura: <span id="review_texture_preview">3</label>
                                    <input type="range" class="w-100" name="" id="review_texture" min=0 max=5 value="3">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" onclick="publish()">Publicar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-primary mb-3" role="alert">
                    <a href="<?= get_server_index_base_url() ?>user/login">Inicia sesión</a> para publicar una review
                </div>
            <?php endif; ?>

            <?php if (empty($data->reviews)) : ?>
                <p>Este pincho no tiene reseñas.</p>
            <?php else : ?>
                <p>Número de reseñas: <?= count($data->reviews) ?></p>
                <?php foreach ($data->reviews as $review) : ?>
                    <?php include "view/Review/templates/card-interact.php" ?>
                <?php endforeach; ?>
            <?php endif; ?>


        </section>
    </main>
    <?php require "view/footer.php" ?>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/OwlCarousel2/dist/owl.carousel.min.js"></script>
    <script src="js/info/multimedia.js"></script>
    <script src="js/bootstrap/js/bootstrap.min.js"></script>

    <?php if (is_logged()) : ?>
        <script src="js/review.js"></script>
    <?php endif; ?>

</body>

</html>