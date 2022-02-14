<?php require "utils.php"?>
<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "view/nav.php" ?>
    <main class="my-5">
        <section class="container">
            <h1>Contacto</h1>
            <p class="my-4">Envianos un mensaje mediante el siguiente formulario:</p>
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="social-wrapper tarjeta p-4">
                        <h2 class="h3 mb-3">Conecta con nosotros:</h2>
                        <div class="social-row mb-3">
                            <i class="fab fa-twitter me-2"></i> <a href="https://www.instagram.com/">@logrocho</a>
                        </div>
                        <div class="social-row mb-3">
                            <i class="fab fa-facebook me-2"></i> <a href="https://es-es.facebook.com/">logrocho</a>
                        </div>
                        <div class="social-row">
                            <i class="fab fa-instagram me-2"></i> <a href="https://www.instagram.com/">@logrocho</a>
                        </div>
                    </div>
                </div>
                <div class="col offset-lg-1">
                    <form action="" method="post">
                        <div class="form-group mb-3">
                            <label for="name" class="mb-3">Nombre</label>
                            <input type="text" class="form-control" id="name" aria-describedby="Tu nombre"
                                placeholder="Tu nombre" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="mb-3">Email</label>
                            <input type="email" class="form-control mb-2" id="email"
                                aria-describedby="Tu dirección de email" placeholder="email@dominio.com" required>
                            <small id="email" class="form-text text-muted">Enviaremos la respuesta a este
                                email.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleFormControlSelect1" class="mb-3">Asunto</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option value="recommendation">Recomendación</option>
                                <option value="add_to_db">Falta un restaurante/pincho</option>
                                <option value="doubt">Duda</option>
                                <option value="complaint">Queja</option>
                                <option value="other">Otro</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="message" class="mb-3">Mensaje</label>
                            <textarea class="form-control" id="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <?php include "view/footer.php" ?>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/contact.js"></script>
</body>

</html>