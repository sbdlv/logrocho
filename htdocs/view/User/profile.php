<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona usuario</title>
    <base href="<?= dirname(getServerAbsPathForActions()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body class="page_user_zone">
    <?php include "view/nav.php" ?>
    <div class="container-fluid profile_and_tabs py-5">
        <div class="info text-center mb-5">
            <img src="../img/pfp.jpg" alt="" class="img-fluid mb-3">
            <div class="email h1">usuario@logrocho.local</div>
        </div>
        <nav class="container">
            <div class="nav nav-pills nav-fill me-3" id="v-pills-tab" role="tablist">
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-address-card"></i> Perfil</button>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-comment-alt"></i> Mis reseñas</button>
                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-thumbs-up"></i> Mis likes</button>
                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-thumbs-down"></i> Mis dislikes</button>
            </div>
        </nav>
    </div>
    <main class="container">
        <div class="">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active p-4" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <h2 class="mb-4">Perfil</h2>
                    <form class="pb-4">
                        <div class="form-group mb-4">
                            <label for="user_name">Nombre</label>
                            <input type="email" class="form-control" id="user_name" placeholder="Tu nombre">
                        </div>
                        <div class="form-group mb-4">
                            <label for="user_name">Apellidos</label>
                            <input type="email" class="form-control" id="user_name" placeholder="Tus apellidos">
                        </div>
                        <div class="form-group mb-4">
                            <label for="user_name">Email</label>
                            <input type="email" class="form-control" id="user_name" placeholder="correo@electronico.com">
                        </div>
                        <div class="mb-4">
                            <p>Te unistes el: 20-20-2000</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="tab-pane fade p-4" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h2 class="mb-4">Mis reseñas</h2>
                    <?php if (count($reviews)) : ?>
                        <div class="reviews">
                            <?php foreach ($reviews as $review) : ?>
                                <div class="tarjeta tarjeta-btn card review p-4 flex-row">
                                    <div class="me-4"><img src="img/pfp.jpg" alt="" class="pfp"></div>
                                    <div>
                                        <p class="h4">¡Lo mejor que he probado!</p>
                                        <p class="text_clamp_3 review-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit provident eaque eos veniam, culpa quis at praesentium necessitatibus, eveniet earum quisquam quo, magnam fugiat? Adipisci quia ad quibusdam sequi quod.</p>
                                        <div class="card-subtitle mb-2"><span class="fw-bold">Presentacion: </span><?php TemplateHelper::getStarts($review->presentation) ?></div>
                                        <div class="card-subtitle mb-2"><span class="fw-bold">Sabor: </span><?php TemplateHelper::getStarts($review->taste) ?></div>
                                        <div class="card-subtitle mb-2"><span class="fw-bold">Textura: </span><?php TemplateHelper::getStarts($review->texture) ?></div>
                                        <div class="d-flex justify-content-between">
                                            <div class="rating d-flex">
                                                <div class="likes">
                                                    <i class="fas fa-thumbs-up"></i>
                                                    <?= $review->likes ?>
                                                </div>
                                                <div class="ms-2 dislikes">
                                                    <i class="fas fa-thumbs-down"></i>
                                                    <?= $review->dislikes ?>
                                                </div>
                                            </div>
                                            <a class="btn btn-primary" href="<?= getServerAbsPathForActions() ?>pincho/detalles/<?= $review->pincho_id ?>">Ver pincho</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p>No tienes reseñas.</p>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <h2>Mis likes</h2>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <h2>Mis dislikes</h2>
                </div>
            </div>
        </div>
    </main>
    <?php include "view/footer.php" ?>
</body>

</html>