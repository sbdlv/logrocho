<?php
require_once "AbstractMappedSQLModel.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class User extends AbstractMappedSQLModel
{
    public int $id;

    public string $first_name;

    public string $last_name;

    public string $email;

    public string $password;

    public bool $admin;

    public string $created_date;

    public string $img_path;

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
