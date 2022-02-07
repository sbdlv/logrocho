<?php
const DB_USER = "root";
const DB_PASS = "";
const DB_INFO = "mysql:host=localhost;dbname=logrocho";

$_conexion = null;

/**
 * Obtiene la conexión con la base de datos
 *
 * @return PDO
 */
function getConexion()
{
    global $_conexion;

    if ($_conexion == null) {
        $_conexion = new PDO(DB_INFO, DB_USER, DB_PASS);
    }
    return $_conexion;
}
