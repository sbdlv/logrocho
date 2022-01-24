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
        if($page){
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
        /*
        if ($obj instanceof stdClass) {
            $obj = Bar::fromstdclass($obj);
        }

        $stmt = getConexion()->prepare("INSERT INTO `user`(`username`, `email`, `password`, `admin`, `created_date`) VALUES (?, ?, ?, ?, now())");
        return $stmt->execute([$obj->username, $obj->email, sha1($obj->password), false]);*/
    }

    function delete($obj) :bool
    {
        $stmt = getConexion()->prepare("DELETE FROM " . self::DB_TABLE . " WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    function update($obj)
    {
        //TODO:
    }
}
