<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logrocho - Inicio</title>
  <base href="<?= dirname(getServerAbsPathForActions()) ?>/">
  <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="js/OwlCarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark px-4" id="mainNav">
    <a class="navbar-brand" href="#">
      <img src="img/logo.png" width="120" alt="">
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Restaruantes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pinchos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Iniciar sesión</a>
        </li>
      </ul>
    </div>
  </nav>

  <main>
    <section class="container py-5">
      <h2 class="mb-5 fw-bold">Lo mejor</h2>
      <div class="owl-carousel owl-theme best_slider">
        <div class="item"><img src="img/pexels-photo-262047.jpeg" alt=""></div>
        <div class="item"><img src="img/pexels-pixabay-262978.jpg" alt=""></div>
      </div>
      <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
        <label class="btn btn-outline-primary" for="btnradio1">Restaruantes</label>
      
        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
        <label class="btn btn-outline-primary" for="btnradio2">Pinchos</label>
      </div>
    </section>
    <section class="container-fluid contrastFluid py-5">
      <div class="container">
        <h2 class="mb-5 fw-bold">¿Que quieres ver?</h2>
        <div class="what_to_see d-flex justify-content-center">
          <a href=""
            class="option tarjeta tarjeta-btn d-flex justify-content-center flex-column align-items-center m-2">
            <img src="img/bar_icon.png" alt="">
            <p class="mt-3">Restaurantes</p>
          </a>
          <a href=""
            class="option tarjeta tarjeta-btn d-flex justify-content-center flex-column align-items-center m-2">
            <img src="img/pincho_icon.png" alt="">
            <p class="mt-3">Pinchos</p>
          </a>
        </div>
      </div>
    </section>
    <section class="container pt-5">
      <h2 class="mb-5 fw-bold">Últimos pinchos</h2>
      <div class="owl-carousel last_pinchos_slider owl-theme">
        <a class="tarjeta tarjeta-btn card" href="pincho.html">
          <img class="" src="img/pt1.jpg" alt="Pincho">
          <div class="card-body">
            <h5 class="card-title fw-bold mb-2">Pincho de tortilla</h5>
            <div class="card-subtitle mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <p class="card-text text_clamp_3">Some quick example text to build on the card title and make up the bulk of
              the card's content.</p>
          </div>
        </a>
        <a class="tarjeta tarjeta-btn card" href="pincho.html">
          <img class="" src="img/pp1.jpg" alt="Pincho">
          <div class="card-body">
            <h5 class="card-title fw-bold mb-2">Pincho de tortilla</h5>
            <div class="card-subtitle mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <p class="card-text text_clamp_3">Some quick example text to build on the card title and make up the bulk of
              the card's content.</p>
          </div>
        </a>
        <a class="tarjeta tarjeta-btn card" href="pincho.html">
          <img class="" src="img/pm-1.jpg" alt="Pincho">
          <div class="card-body">
            <h5 class="card-title fw-bold mb-2">Pincho de tortilla</h5>
            <div class="card-subtitle mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <p class="card-text text_clamp_3">Some quick example text to build on the card title and make up the bulk of
              the card's content.</p>
          </div>
        </a>
        <a class="tarjeta tarjeta-btn card" href="pincho.html">
          <img class="" src="img/" alt="Pincho">
          <div class="card-body">
            <h5 class="card-title fw-bold mb-2">Pincho de tortilla</h5>
            <div class="card-subtitle mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <p class="card-text text_clamp_3">Some quick example text to build on the card title and make up the bulk of
              the card's content.</p>
          </div>
        </a>
        <a class="tarjeta tarjeta-btn card" href="pincho.html">
          <img class="" src="img/pexels-photo-262047.jpeg" alt="Pincho">
          <div class="card-body">
            <h5 class="card-title fw-bold mb-2">Pincho de tortilla</h5>
            <div class="card-subtitle mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <p class="card-text text_clamp_3">Some quick example text to build on the card title and make up the bulk of
              the card's content.</p>
          </div>
        </a>
      </div>
    </section>
    <section class="container py-5">
      <h2 class="mb-5 fw-bold">Últimas valoraciones</h2>
      <div class="owl-carousel last_reviews_slider owl-theme">
        <a class="tarjeta tarjeta-btn card review p-4 flex-row" href="pincho.html">
          <div class="me-4"><img src="img/pfp.jpg" alt="" class="pfp"></div>
          <div>
            <p class="h4">¡Lo mejor que he probado!</p>
            <p class="text_clamp_3 review-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit provident eaque eos veniam, culpa quis at praesentium necessitatibus, eveniet earum quisquam quo, magnam fugiat? Adipisci quia ad quibusdam sequi quod.</p>
            <div class="card-subtitle mb-2"><span class="fw-bold">Total: </span><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
          </div>
        </a>
        <a class="tarjeta tarjeta-btn card review p-4 flex-row" href="pincho.html">
          <div class="me-4"><img src="img/pfp.jpg" alt="" class="pfp"></div>
          <div>
            <p class="h4">¡Lo mejor que he probado!</p>
            <p class="text_clamp_3 review-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit provident eaque eos veniam, culpa quis at praesentium necessitatibus, eveniet earum quisquam quo, magnam fugiat? Adipisci quia ad quibusdam sequi quod.</p>
            <div class="card-subtitle mb-2"><span class="fw-bold">Total: </span><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
          </div>
        </a>
        <a class="tarjeta tarjeta-btn card review p-4 flex-row" href="pincho.html">
          <div class="me-4"><img src="img/pfp.jpg" alt="" class="pfp"></div>
          <div>
            <p class="h4">¡Lo mejor que he probado!</p>
            <p class="text_clamp_3 review-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit provident eaque eos veniam, culpa quis at praesentium necessitatibus, eveniet earum quisquam quo, magnam fugiat? Adipisci quia ad quibusdam sequi quod.</p>
            <div class="card-subtitle mb-2"><span class="fw-bold">Total: </span><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
          </div>
        </a>
      </div>
    </section>
  </main>

  <footer class="py-5">
    <div class="container d-flex justify-content-between">
      <article>
        <h2 class="h5 fw-bold">Lorme ipsum</h2>
        <ul>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
        </ul>
      </article>
      <article>
        <h2 class="h5 fw-bold">Lorme ipsum</h2>
        <ul>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
        </ul>
      </article>
      <article>
        <h2 class="h5 fw-bold">Lorme ipsum</h2>
        <ul>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
        </ul>
      </article>
      <article>
        <h2 class="h5 fw-bold">Lorme ipsum</h2>
        <ul>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
          <li><a href="#">Lorem</a></li>
        </ul>
      </article>
    </div>
  </footer>

  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/OwlCarousel2/dist/owl.carousel.min.js"></script>
  <script src="js/home_sliders.js"></script>
</body>

</html>