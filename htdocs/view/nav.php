<?php
if (!isset($activeMenu)) {
    $activeMenu = "";
}
?>
<nav class="navbar navbar-expand-lg navbar-light px-4" id="mainNav">
    <a class="navbar-brand" href="/index.php">
        <img src="img/logo.svg" width="100" alt="">
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item <?= $activeMenu == "bar" ? "active" : "" ?>">
                <a class="nav-link" href="<?= get_server_index_base_url() . "bar/search" ?>">Bares</a>
            </li>
            <li class="nav-item <?= $activeMenu == "pincho" ? "active" : "" ?>">
                <a class="nav-link" href="<?= get_server_index_base_url() . "pincho/search" ?>">Pinchos</a>
            </li>
            <li class="nav-item <?= $activeMenu == "map" ? "active" : "" ?>">
                <a class="nav-link" href="<?= get_server_index_base_url() . "bar/map" ?>">Mapa</a>
            </li>
            <?php if (is_logged()) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= $activeMenu == "user" ? "active" : "" ?>" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?= get_server_index_base_url() . "user/profile/" . $_SESSION["user"]["id"] ?>">Zona usuario</a></li>
                        <?php if (is_admin()) : ?>
                            <li>
                                <a class="dropdown-item" href="<?= get_server_index_base_url() . "bar/list/" ?>">Panel admin</a>
                            </li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="<?= get_server_index_base_url() . "user/logout" ?>">Cerrar sesión</a></li>
                    </ul>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= get_server_index_base_url() . "user/login" ?>">Iniciar sesión</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>