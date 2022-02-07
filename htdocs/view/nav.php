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
                <a class="nav-link" href="<?= getServerAbsPathForActions() . "user/login" ?>">Iniciar sesión</a>
            </li>
        </ul>
    </div>
</nav>