<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $user->email ?> - Usuario - Ficha</title>
    <base href="<?= dirname(get_server_index_base_url()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "view/side_bar_admin.php" ?>
    <main class="w-100 p-4">
        <section class="container my-4">
            <?php include "view/breadcrumbs.php" ?>
            <div class="tarjeta row p-4">
                <h1><?= $user->email ?> - Usuario</h1>
            </div>
            <div class="row my-4">
                <div class="col-12 col-lg-4 tarjeta"><img src="img/pfp.jpg" class="img-fluid my-2" alt=""></div>
                <div class="col offset-lg-1 tarjeta p-4">
                    <h2 class="mb-4"><i class="fas fa-info-circle"></i> Detalles</h2>
                    <input type="hidden" id="user_id" value="<?= $user->id ?>">
                    <div class="table-responsive">
                        <table class="table customize-table mb-0 v-middle table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre</td>
                                    <td><input type="text" name="" id="user_first_name" value="<?= $user->first_name ?>"></td>
                                </tr>
                                <tr>
                                    <td>Apellidos</td>
                                    <td><input type="text" name="" id="user_last_name" value="<?= $user->last_name ?>"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="email" name="" id="user_email" value="<?= $user->email ?>"></td>
                                </tr>
                                <tr>
                                    <td>Fecha de alta</td>
                                    <td><input type="date" name="" id="user_created_date" value="<?= $user->created_date ?>"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <button class="save_btn btn btn-success m-4" id="save_btn"><i class="far fa-save"></i> Guardar</button>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/admin/info/user.js"></script>
</body>

</html>