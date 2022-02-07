<?php
require_once "IDAO.php";
require_once "model/Pincho.php";

class PinchoRepository implements IDAO
{

    private const DB_TABLE = "pincho";

    /**
     * Obtiene la información de un usuario
     *
     * @param string $id el email del usuario
     * @return void
     */
    function find($id)
    {
        $stmt = getConexion()->prepare("SELECT * FROM " . self::DB_TABLE . " WHERE `id` = ?");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return Pincho::getInstance($fetch[0]);
    }

    function findAll($page = false, $amount = 1)
    {
        if($page !== false){
            $results = getConexion()->query("SELECT * FROM " . self::DB_TABLE . " LIMIT $page,$amount");
        } else {
            $results = getConexion()->query("SELECT * FROM " . self::DB_TABLE . "");
        }

        $instances = [];

        foreach ($results as $row) {
            $instances[] = Pincho::getInstance($row);
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
        $stmt = getConexion()->prepare("INSERT INTO `pincho`(`bar_id`, `name`) VALUES (?,?)");
        return $stmt->execute([$obj->bar_id, $obj->name]);
    }

    function delete($obj) :bool
    {
        $stmt = getConexion()->prepare("DELETE FROM " . self::DB_TABLE . " WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    function update($obj)
    {
        $stmt = getConexion()->prepare("UPDATE `pincho` SET `bar_id` = ?, `name` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->bar_id, $obj->name, $obj->id]);
    }

    function uploadPic($pk, $path, $priority = -1){
        $stmt = getConexion()->prepare("INSERT INTO `multimediaPincho`(`pincho_id`, `path`, `priority`) VALUES (?,?,?)");
        return $stmt->execute([$pk, $path, $priority]);
    }

    function getImages($id, &$imgs = []){
        $stmt = getConexion()->prepare("SELECT * FROM `multimediapincho` WHERE pincho_id = ? ORDER BY priority, id");

        $stmt->execute([$id]);

        foreach ($stmt as $row) {
            $imgs[$id][] = $row["path"];
        }

        return $imgs;
    }
}
