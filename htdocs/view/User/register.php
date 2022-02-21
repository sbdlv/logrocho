<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <base href="<?= dirname(get_server_index_base_url()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main>
        <form class="tarjeta login_form mx-auto text-center" method="POST" action="<?= get_server_index_base_url() . "user/register" ?>">
            <div class="w-50 mb-3 mx-auto">
                <img src="img/logo.png" alt="Logrocho logo" class="img-fluid">
            </div>
            <?php if (isset($errorMsg)) : ?>
                <div class="alert alert-danger" role="alert">
                    Error: <?= $errorMsg ?>
                </div>
            <?php endif; ?>
            <?php if (isset($okMsg)) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $okMsg ?>
                </div>
            <?php endif; ?>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="user_email" name="email" placeholder="name@example.com">
                <label for="floatingInput">Correo electronico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="user_password" name="password" placeholder="Password">
                <label for="floatingPassword">Contraseña</label>
            </div>
            <input class="w-100 btn btn-lg btn-primary mb-3" type="submit" value="Registrarse" id="submit">
            <div class="text-center mb-3">
                <a href="<?= get_server_index_base_url() . "user/login" ?>">Ya tienes cuenta?</a>
            </div>
        </form>
    </main>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/user-register.js"></script>
</body>

</html>