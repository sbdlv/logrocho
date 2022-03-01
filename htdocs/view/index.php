<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logrocho - Inicio</title>
  <base href="<?= dirname(get_server_index_base_url()) ?>/">
  <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="js/OwlCarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <script src="js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
  <?php include "nav.php" ?>
  <main>
    <section class="container py-5">
      <h2 class="mb-5 fw-bold">Pinchos</h2>
      <div id="principal_sliders">
        <div class="owl-carousel owl-theme best_pinchos_slider fixed_slider">
          <div class="item"><img src="img/pf1.jpg" alt=""></div>
          <div class="item"><img src="img/pf2.jpg" alt=""></div>
          <div class="item"><img src="img/pf3.jpg" alt=""></div>
          <div class="item"><img src="img/pf4.jpg" alt=""></div>
          <div class="item"><img src="img/pf5.jpg" alt=""></div>
        </div>
        <div class="owl-carousel owl-theme fav_slider fixed_slider">
          <div class="item"><img src="img/pp1.jpg" alt=""></div>
          <div class="item"><img src="img/pp2.jpg" alt=""></div>
          <div class="item"><img src="img/pp3.jpg" alt=""></div>
          <div class="item"><img src="img/pp4.jpg" alt=""></div>
          <div class="item"><img src="img/pm-1.jpg" alt=""></div>
        </div>
      </div>
      <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="radio" class="btn-check" name="btnradio" id="toggleBestPinchosSlider" autocomplete="off" checked>
        <label class="btn btn-outline-primary" for="toggleBestPinchosSlider">Los mejores</label>

        <input type="radio" class="btn-check" name="btnradio" id="toggleFavSlider" autocomplete="off">
        <label class="btn btn-outline-primary" for="toggleFavSlider">Preferidos</label>
      </div>
    </section>
    <section class="container-fluid contrastFluid py-5">
      <div class="container">
        <h2 class="mb-5 fw-bold">¿Que quieres ver?</h2>
        <div class="what_to_see d-flex justify-content-center">
          <a href="<?= get_server_index_base_url() . "bar/search" ?>" class="option tarjeta tarjeta-btn d-flex justify-content-center flex-column align-items-center m-2">
            <img src="img/bar_icon.png" alt="">
            <p class="mt-3">Restaurantes</p>
            <p class="mt-1 desc text-center">Busca restaurantes por su puntuación, nombre o dirección.</p>
          </a>
          <a href="<?= get_server_index_base_url() . "pincho/search" ?>" class="option tarjeta tarjeta-btn d-flex justify-content-center flex-column align-items-center m-2">
            <img src="img/pincho_icon.png" alt="">
            <p class="mt-3">Pinchos</p>
            <p class="mt-1 desc text-center">Busca pinchos por su puntuación, nombre o bar.</p>
          </a>
          <a href="<?= get_server_index_base_url() . "bar/map" ?>" class="option tarjeta tarjeta-btn d-flex justify-content-center flex-column align-items-center m-2">
            <img src="img/map_icon.png" alt="">
            <p class="mt-3">Mapa de bares</p>
            <p class="mt-1 desc text-center">Explora el mapa de bares y accede a su información.</p>
          </a>
        </div>
      </div>
    </section>
    <section class="container pt-5">
      <h2 class="mb-5 fw-bold">Últimos pinchos</h2>
      <div class="owl-carousel last_pinchos_slider owl-theme">
        <?php foreach ($lastPinchos as $pincho) {
          include "view/Pincho/templates/card-slider.php";
        } ?>
      </div>
    </section>
    <section class="container py-5">
      <h2 class="mb-5 fw-bold">Últimas valoraciones</h2>
      <div class="owl-carousel last_reviews_slider owl-theme">
        <?php foreach ($lastReviews as $review) {
          include "view/Review/templates/card-slider.php";
        } ?>
      </div>
    </section>
  </main>

  <?php include "footer.php" ?>

  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/OwlCarousel2/dist/owl.carousel.min.js"></script>
  <script src="js/home_sliders.js"></script>
</body>

</html>