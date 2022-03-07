<?php
require_once "AbstractMappedSQLModel.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class User extends AbstractMappedSQLModel
{
    public $id;

    public $first_name;

    public $last_name;

    public $email;

    public $password;

    public $admin;

    public $created_date;

    public $img_path;

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "first_name" => "first_name",
            "last_name" => "last_name",
            "email" => "email",
            "password" => "password",
            "admin" => "admin",
            "created_date" => "created_date",
            "img_path" => "img_path",
        ];
        
    }
}
