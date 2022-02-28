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
    <script src="js/bootstrap/js/bootstrap.min.js"></script>
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
            <button class="btn btn-success mb-3">Escribir una reseña</button>
            <?php if (empty($data->multimedia)) : ?>
                <p>Este pincho no tiene reseñas.</p>
            <?php else : ?>
                <p>Número de reseñas: <?=count($data->reviews)?></p>
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
</body>

</html>