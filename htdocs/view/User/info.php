<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <base href="<?= dirname(getServerAbsPathForActions()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "view/side_bar_admin.php" ?>
    <main class="w-100 p-4">
        <section class="container my-4">
            <div class="tarjeta row p-4"><h1>Marcos_dp99 - Usuario</h1></div>
            <div class="my-4">
                <button class="btn btn-primary">Editar</button>
            </div>
            <div class="row my-4">
                <div class="col-12 col-lg-4 tarjeta"><img src="img/pfp.jpg" class="img-fluid my-2" alt=""></div>
                <div class="col offset-lg-1 tarjeta p-4">
                    <h2 class="mb-4"><i class="fas fa-info-circle"></i> Detalles</h2>
                    <div class="table-responsive">
                        <table class="table customize-table mb-0 v-middle table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre</td>
                                    <td>Marcos_dp99</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>Marcos_dp99@hotmail.com</td>
                                </tr>
                                <tr>
                                    <td>Fecha de alta</td>
                                    <td>10/02/2000</td>
                                </tr>
                                <tr>
                                    <td>Núm. Reseñas escritas</td>
                                    <td>1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>     
    </main>
</body>

</html>