<?php
$breadcrumbs = [];

function getServerAbsPathForActions()
{
    return isset($_SERVER["HTTPS"]) ? "https" : "http" . "://$_SERVER[HTTP_HOST]" . getHome() . "/";
}

function getHome()
{
    /**
     * El REQUEST_URI nos devuelve por ej.: http://localhost/dws/Tema%205/Ejercicios/Practica%205/index.php/Categoria/fdssdf
     * Cogeremos solo lo que hay detrás de index.php
     */
    return explode("index.php", urldecode($_SERVER["REQUEST_URI"]))[0] . "index.php";
}

function checkSession()
{
    if (!$_SESSION["logged"]) {
        header('Location: ' . getServerAbsPathForActions() . "admin/login");
    }
}

function addToBreadCrumbs(string $text, string $url = null)
{
    global $breadcrumbs;
    $breadcrumbs[] = [
        "url" => $url,
        "text" => $text
    ];
}

function isAdminForAPI()
{
    if (!isset($_SESSION["user"]) || !$_SESSION["user"]["admin"]) {
        http_response_code(401);
        echo "No tienes permisos para realizar esta acción";
        die;
    }
}
