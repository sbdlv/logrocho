<?php
$menus = [
    "bar" => [
        "title" => "Bares",
        "href" => get_server_index_base_url() . "bar/list",
        "fa_class" => "fas fa-store"
    ],
    "pincho" => [
        "title" => "Pinchos",
        "href" => get_server_index_base_url() . "pincho/list",
        "fa_class" => "fas fa-utensils"
    ],
    "user" => [
        "title" => "Usuarios",
        "href" => get_server_index_base_url() . "user/list",
        "fa_class" => "fas fa-users"
    ],
    "review" => [
        "title" => "Reseñas",
        "href" => get_server_index_base_url() . "review/list",
        "fa_class" => "fas fa-gavel"
    ],
]
?>

<aside class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" id="side_bar_admin">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="fas fa-tools me-2"></i>
        <span class="fs-4">Panel admin</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <?php foreach ($menus as $key => $menuData) : ?>
            <li class="nav-item mb-2">
                <a href="<?= $menuData["href"] ?>" class="nav-link <?= $key == $activeMenu ? "active" : "text-white" ?>" aria-current="page">
                    <i class="<?= $menuData["fa_class"] ?>"></i>
                    <?= $menuData["title"] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="index.php" class="btn bg-primary text-white"><i class="fas fa-home"></i></a>
        <a href="<?= get_server_index_base_url() . "user/logout" ?>" class="btn bg-danger text-white"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</aside>