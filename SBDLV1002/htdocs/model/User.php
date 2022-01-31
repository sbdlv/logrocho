<?php
require_once "AbstractMappedSQLModel.php";

class User extends AbstractMappedSQLModel
{
    public string $username;

    public string $email;

    public string $password;

    public bool $admin;

    public string $created_date;

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "username" => "username",
            "email" => "email",
            "password" => "password",
            "admin" => "admin",
            "created_date" => "created_date",
        ];
        
    }

    public static function fromstdclass(stdClass $obj)
    {
        $instance = new self();

        $instance->username = $obj->username;
        $instance->email = $obj->email;
        $instance->password = $obj->password;

        return $instance;
    }
}
