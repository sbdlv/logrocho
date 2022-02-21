<?php
const DB_USER = "root";
const DB_PASS = "";
const DB_INFO = "mysql:host=localhost;dbname=logrocho";

$_connection = null;

/**
 * Obtiene la conexión con la base de datos
 *
 * @return PDO
 */
function get_db_connection()
{
    global $_connection;

    if ($_connection == null) {
        $_connection = new PDO(DB_INFO, DB_USER, DB_PASS);
    }
    return $_connection;
}
