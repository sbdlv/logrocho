<?php
require_once "IDAO.php";
require_once "model/Bar.php";

class BarRepository implements IDAO
{
    /**
     * Obtiene la información de un usuario
     *
     * @param string $id el email del usuario
     * @return void
     */
    function find($id)
    {
        $stmt = getConexion()->prepare("SELECT * FROM bar WHERE `id` = ?");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return Bar::getInstance($fetch[0]);
    }

    function findAll()
    {
        $results = getConexion()->query("SELECT * FROM bar");

        $instances = [];

        foreach ($results as $row) {
            $instances[] = Bar::getInstance($row);
        }

        return $instances;
    }

    /**
     * Inserta en la base de datos el usuario
     *
     * @param stdClass|object $obj
     * @return true si todo ha sido correcto, false sí no.
     */
    function save($obj)
    {
        /*
        if ($obj instanceof stdClass) {
            $obj = Bar::fromstdclass($obj);
        }

        $stmt = getConexion()->prepare("INSERT INTO `user`(`username`, `email`, `password`, `admin`, `created_date`) VALUES (?, ?, ?, ?, now())");
        return $stmt->execute([$obj->username, $obj->email, sha1($obj->password), false]);*/
    }

    function delete($obj)
    {
        //TODO:
    }

    function update($obj)
    {
        //TODO:
    }
}
