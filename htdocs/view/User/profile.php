<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona usuario</title>
    <base href="<?= dirname(get_server_index_base_url()) ?>/">
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
                    <section class="pb-4">
                        <div class="form-group mb-4">
                            <label for="user_first_name">Nombre</label>
                            <input type="text" class="form-control" id="user_first_name" placeholder="Tu nombre" value="<?= $_SESSION["user"]["first_name"] ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="user_last_name">Apellidos</label>
                            <input type="text" class="form-control" id="user_last_name" placeholder="Tus apellidos" <?= $_SESSION["user"]["last_name"] ?>>
                        </div>
                        <div class="form-group mb-4">
                            <label for="user_email">Email</label>
                            <input type="email" class="form-control" id="user_email" placeholder="correo@electronico.com" value="<?= $_SESSION["user"]["email"] ?>">
                        </div>
                        <div class="mb-4">
                            <p>Te unistes el: 20-20-2000</p>
                        </div>
                        <button class="btn btn-primary" onclick="saveProfile()">Guardar</button>
                    </section>
                </div>
                <div class="tab-pane fade p-4" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h2 class="mb-4">Mis reseñas</h2>
                    <?php if (count($reviews)) : ?>
                        <div class="reviews">
                            <?php foreach ($reviews as $review) : ?>
                                <?php include "view/Review/templates/card-detailed.php" ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p>No tienes reseñas.</p>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade p-4" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <h2 class="mb-4">Mis likes</h2>
                    <?php if (count($reviews)) : ?>
                        <div class="reviews">
                            <?php foreach ($likedReviews as $review) : ?>
                                <?php include "view/Review/templates/card-detailed.php" ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p>No tienes reseñas.</p>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade p-4" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <h2 class="mb-4">Mis dislikes</h2>
                    <?php if (count($reviews)) : ?>
                        <div class="reviews">
                            <?php foreach ($dislikedReviews as $review) : ?>
                                <?php include "view/Review/templates/card-detailed.php" ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p>No tienes reseñas.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/user-profile.js"></script>
    <?php include "view/footer.php" ?>
</body>

</html>