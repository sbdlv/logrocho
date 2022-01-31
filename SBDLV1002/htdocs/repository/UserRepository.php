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
    function find($id)
    {
        $stmt = getConexion()->prepare("SELECT * FROM user WHERE `email` = ?");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return User::getInstance($fetch[0]);
    }

    function findAll()
    {
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

        $stmt = getConexion()->prepare("INSERT INTO `user`(`username`, `email`, `password`, `admin`, `created_date`) VALUES (?, ?, ?, ?, now())");
        return $stmt->execute([$obj->username, $obj->email, sha1($obj->password), false]);
    }

    function delete($obj)
    {
        //TODO:
    }

    function update($obj)
    {
        //TODO:
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
}
