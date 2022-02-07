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

    function findAll($page = false, $amount = 1, $orderBy = false, $orderDir = "DESC")
    {
        if ($page !== false) {
            if ($orderBy) {
                $results = getConexion()->query("SELECT * FROM bar ORDER BY " . $orderBy . " " . $orderDir . " LIMIT $page,$amount");
            } else {
                $results = getConexion()->query("SELECT * FROM bar LIMIT $page,$amount");
            }
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
        $stmt = getConexion()->prepare("INSERT INTO `bar`(`name`, `address`, `lon`, `lat`, `terrace`) VALUES (?,?,?,?,?)");
        return $stmt->execute([$obj->name, $obj->address, $obj->lon, $obj->lat, $obj->terrace]);
    }

    function delete($obj): bool
    {
        $stmt = getConexion()->prepare("DELETE FROM bar WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    function update($obj)
    {
        $stmt = getConexion()->prepare("UPDATE `bar` SET `name` = ?, `address` = ?, `lon` = ?, `lat` = ?, `terrace` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->name, $obj->address, $obj->lon, $obj->lat, $obj->terrace, $obj->id]);
    }

    function total(){
        $results = getConexion()->query("SELECT count(*) as total FROM bar");
        $results->execute();
        return $results->fetch()["total"];
    }

    function uploadPic($pk, $path, $priority = -1){
        $stmt = getConexion()->prepare("INSERT INTO `multimediaBar`(`bar_id`, `path`, `priority`) VALUES (?,?,?)");
        return $stmt->execute([$pk, $path, $priority]);
    }
    
    function getImages($id, &$imgs = []){
        $stmt = getConexion()->prepare("SELECT * FROM `multimediabar` WHERE bar_id = ? ORDER BY priority, id");

        $stmt->execute([$id]);

        foreach ($stmt as $row) {
            $imgs[$id][] = $row["path"];
        }

        return $imgs;
    }

    function getImagesForArray($objs, $imgs = []){
        foreach ($objs as $obj => $id) {
            $this->getImages($id, $imgs);
        }

        return $imgs;
    }
}
