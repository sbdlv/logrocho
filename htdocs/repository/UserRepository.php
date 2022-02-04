<?php
require_once "IDAO.php";
require_once "model/User.php";

class UserRepository implements IDAO
{
    /**
     * Obtiene la información de un usuario
     *
     * @param string $id el email del usuario
     * @return void
     */
    function find($email)
    {
        $stmt = getConexion()->prepare("SELECT * FROM user WHERE `email` = ?");
        $stmt->execute([$email]);

        $fetch = $stmt->fetchAll();

        return User::getInstance($fetch[0]);
    }

    function findAll($page = false, $amount = 1, $orderBy = false, $orderDir = "DESC")
    {
        if ($page !== false) {
            if ($orderBy) {
                $results = getConexion()->query("SELECT * FROM user ORDER BY " . $orderBy . " " . $orderDir . " LIMIT $page,$amount");
            } else {
                $results = getConexion()->query("SELECT * FROM user LIMIT $page,$amount");
            }
        } else {
            $results = getConexion()->query("SELECT * FROM user");
        }

        $instances = [];

        foreach ($results as $row) {
            $instances[] = User::getInstance($row);
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
        if ($obj instanceof stdClass) {
            $obj = User::fromstdclass($obj);
        }

        $stmt = getConexion()->prepare("INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`, `admin`, `created_date`) VALUES (?, ?, ?, sha1(?), ?, now())");
        return $stmt->execute([$obj->first_name, $obj->last_name, $obj->email, $obj->password, false]);
    }
    
    function delete($obj)
    {
        //TODO: Solo para admin
        $stmt = getConexion()->prepare("DELETE FROM user WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    function update($obj)
    {
        $stmt = getConexion()->prepare("UPDATE `user` SET `first_name` = ?, `last_name` = ?, `email` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->first_name, $obj->last_name, $obj->email, $obj->id]);
    }


    /**
     * Comprueba las credenciales de inicio de sesión de un usuario
     *
     * @param string $email
     * @param string $password
     * @return true si las credenciales son correct, false sí no.
     */
    function login($email, $password)
    {
        $stmt = getConexion()->prepare("SELECT * FROM user WHERE `email` = ? AND `password` = ?");
        $stmt->execute([$email, sha1($password)]);

        return count($stmt->fetchAll()) > 0;
    }

    function removeLikes($id)
    {
        //TODO: Solo para admin
        $stmt = getConexion()->prepare("DELETE FROM review_user_likes WHERE `id` = ? AND admin = 1");
        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }
}
