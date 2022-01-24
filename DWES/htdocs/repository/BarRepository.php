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

    function findAll($page = false, $amount = 1)
    {
        if ($page !== false) {
            $results = getConexion()->query("SELECT * FROM bar LIMIT $page,$amount");
        } else {
            $results = getConexion()->query("SELECT * FROM bar");
        }

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
        $stmt = getConexion()->prepare("INSERT INTO `bar`(`name`, `address`, `lon`, `lat`, `terrace`, `principal_img_id`) VALUES (?,?,?,?,?,?)");
        return $stmt->execute([$obj->name, $obj->address, $obj->lon, $obj->lat, $obj->terrace, $obj->principal_img_id]);
    }

    function delete($obj): bool
    {
        $stmt = getConexion()->prepare("DELETE FROM bar WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    function update($obj)
    {
        $stmt = getConexion()->prepare("UPDATE `bar` SET `name` = ?, `address` = ?, `lon` = ?, `lat` = ?, `terrace` = ?, `principal_img_id` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->name, $obj->address, $obj->lon, $obj->lat, $obj->terrace, $obj->principal_img_id, $obj->id]);
    }
}
