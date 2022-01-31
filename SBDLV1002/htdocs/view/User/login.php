<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <base href="<?= dirname(getServerAbsPathForActions()) ?>/">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main>

        <form class="tarjeta login_form mx-auto text-center" method="POST" action="<?= getServerAbsPathForActions() . "user/login" ?>">
            <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>
            <?php if (isset($errorMsg)) : ?>
                <div class="alert alert-danger" role="alert">
                    Error: <?= $errorMsg ?>
                </div>
            <?php endif; ?>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                <label for="floatingInput">Correo electronico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Contraseña</label>
            </div>        
             <input type="submit" class="w-100 btn btn-lg btn-primary mb-3" href="listado_restaruante.html" value="Iniciar sesión"/>
            <div class="text-center mb-3">
                <a href="recuperar.html">¿olvidó su contraseña?</a>
                o
                <a href="<?= getServerAbsPathForActions() . "user/register" ?>">Registrarse</a>
            </div>
        </form>

    </main>
</body>

</html>