<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado usuarios - Panel admin</title>
    <base href="<?= dirname(getServerAbsPathForActions()) ?>/">

    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "view/side_bar_admin.php" ?>
    <main class="w-100 p-4">
        <section class="container">
            <header>
                <h1 class="mb-4">Usuarios</h1>
            </header>
            <section class="mb-5">
                <form action="listado.html" method="GET">
                    <div id="searchWrapper" class="mb-4">
                        <input type="text" id="search" class="form-control ">
                        <div class="enviar position-absolute">
                            <i class="fas fa-search"></i>
                            <input type="submit" class="btn" value="">
                        </div>
                    </div>
                    <div class="tarjeta p-5">
                        <h2 class="h4 mb-4">Busqueda avanzada</h2>
                        <div class="form-group">
                            <label for="terraza" class="h5">Fecha de alta</label>
                            <input type="date" name="fecha_alta" id="fecha_alta" class="form-control">
                        </div>
                        <input type="submit" value="Búsqueda avanzada" class="btn btn-primary mt-4">
                    </div>
                </form>
            </section>
            <section class="tarjeta p-5 seccion-info">
                <div class="table-responsive">
                    <table class="table customize-table mb-0 v-middle table-borderless">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Imagen</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th class="text-center">Núm. Reseñas</th>
                                <th class="text-center">Fecha alta</th>
                                <th class="text-center">Ver ficha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><img src="img/pfp.jpg" class="imagen_listado" alt=""></td>
                                <td>Marcos_dp99</td>
                                <td>Marcos_dp99@hotmail.com</td>
                                <td class="text-center">1</td>
                                <td class="text-center">10/02/2000</td>
                                <td class="text-center"><a href="ficha_usuario.html"><i class="fas fa-external-link-alt"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </main>

</body>

</html>