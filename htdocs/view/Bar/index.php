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
        <section class="container-fluid pt-5 pb-4 hero hero_bar d-flex align-items-end" <?php if (!empty($data->multimedia["bar"])) : ?> style="background-image: url(<?= $data->multimedia["bar"][0] ?>), linear-gradient(0deg, rgba(0, 0, 0, 0.61) 0%, rgba(0,0,41,0) 100%);" <?php endif; ?>>
            <div class="container">
                <h1 class="mb-2"><?= $data->bar->name ?></h1>
                <div class="mb-2">
                    <?php TemplateHelper::getStarts($data->bar->rating) ?>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-building m-0 me-3"></i>
                    <p class="m-0"><?= $data->bar->address ?></p>
                </div>
            </div>
        </section>
        <section class="container pt-5">
            <h2 class="mb-5 fw-bold">Fotos</h2>
            <?php if (empty($data->multimedia["bar"])) : ?>
                <p>Este bar no tiene imágenes.</p>
            <?php else : ?>
                <div class="owl-carousel owl-theme multimedia_slider">
                    <?php foreach ($data->multimedia["bar"] as $imageSrc) : ?>
                        <div class="item"><img src="<?= $imageSrc ?>" alt=""></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
        <section class="container py-5">
            <h2 class="mb-5 fw-bold">Pinchos</h2>

            <?php if (empty($data->pinchos)) : ?>
                <p>Este bar no tiene pinchos.</p>
            <?php endif; ?>

            <?php foreach ($data->pinchos as $pincho) : ?>
                <?php include "view/Pincho/templates/card.php" ?>
            <?php endforeach; ?>

        </section>
    </main>
    <?php require "view/footer.php" ?>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/OwlCarousel2/dist/owl.carousel.min.js"></script>
    <script src="js/info/multimedia.js"></script>
</body>

</html>