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
    <link rel="stylesheet" href="js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "view/nav.php" ?>
    <main>
        <div class="container-fluid d-flex justify-content-center align-items-center hero hero_pincho">
            <h1>Pinchos</h1>
        </div>
        <section class="container py-5 row mx-auto">
            <div class="filters">
                <div class="form-group mb-4">
                    <label for="pincho_name" class="h4">Nombre del pincho</label>
                    <input type="text" class="form-control" id="pincho_name" placeholder="">
                </div>
                <div class="form-group mb-4">
                    <label for="pincho_bar_name" class="h4">Bar</label>
                    <input type="text" list="bar_list" class="form-control" id="pincho_bar_name" placeholder="">
                    <datalist id="bar_list">
                        <?php foreach ($bars as $bar) : ?>
                            <option value="<?= $bar->name ?>">
                        <?php endforeach; ?>
                    </datalist>
                </div>
                <div class="form-group mb-4">
                    <label for="bar_rating" class="h4">Puntuación</label>
                    <div id="amount" class="mb-2"></div>
                    <div id="pincho_rating"></div>
                </div>
            </div>
        </section>
        <section class="container pb-5 row mx-auto">
            <div id="results" class="ajax-search">

            </div>
        </section>

    </main>

    <?php include "view/footer.php" ?>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery-ui/jquery-ui.js"></script>
    <script src="js/ajax-searchs.js"></script>
    <script src="js/search/pincho.js"></script>
</body>

</html>