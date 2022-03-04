<?php
/*
* Configure the database credentials and connection.
*/
const DB_USER = "admin";
const DB_PASS = "root";
const DB_INFO = "mysql:host=localhost;dbname=logrocho";

$_connection = null;

/**
 * Obtains the database connection.
 *
 * @return PDO The database connection
 */
function get_db_connection()
{
    global $_connection;

    if ($_connection == null) {
        $_connection = new PDO(DB_INFO, DB_USER, DB_PASS);
    }
    return $_connection;
}
