<?php
$breadcrumbs = [];

/**
 * Gets the url for adding subdomains
 *
 * @return string Example: domain.local/index.php/
 */
function get_server_index_base_url()
{
    return isset($_SERVER["HTTPS"]) ? "https" : "http" . "://$_SERVER[HTTP_HOST]" . get_root_url() . "/";
}

/**
 * Gets the url path where the index.php is located at.
 *
 * @return string Example: Returns domain.local/myweb1/ -> In this case, the index.php path is domain.local/myweb1/index.php
 */
function get_root_url()
{
    /**
     * El REQUEST_URI nos devuelve por ej.: http://localhost/dws/Tema%205/Ejercicios/Practica%205/index.php/Categoria/fdssdf
     * Cogeremos solo lo que hay detrás de index.php
     */
    return explode("index.php", urldecode($_SERVER["REQUEST_URI"]))[0] . "index.php";
}

/**
 * Checks the user session for admin
 *
 * @return void
 */
function check_session()
{
    if (!$_SESSION["logged"]) {
        header('Location: ' . get_server_index_base_url() . "user/login");
    }
}

/**
 * Add another step to the bread crumbs
 *
 * @param string $text The display text for the breadcrumb
 * @param string|null $url The href for the breadcrumb
 */
function add_to_breadcrumbs(string $text, string $url = null)
{
    global $breadcrumbs;
    $breadcrumbs[] = [
        "url" => $url,
        "text" => $text
    ];
}

/**
 * Checks if the request has been made by an admin. If not, returns 401
 */
function is_admin_for_api()
{
    if (!isset($_SESSION["user"]) || !$_SESSION["user"]["admin"]) {
        http_response_code(401);
        echo "No tienes permisos para realizar esta acción";
        die;
    }
}

function is_admin()
{
    return isset($_SESSION["user"]) && $_SESSION["user"]["admin"];
}

/**
 * Checks if the user is logged
 *
 * @return boolean
 */
function is_logged()
{
    return isset($_SESSION["user"]);
}

/**
 * Gets the system root path for the current web, which means, it returns the dirname of the index.php of this mvc.
 *
 * @return string The web root system path
 */
function get_system_web_root_folder_path()
{
    return dirname(__FILE__);
}
