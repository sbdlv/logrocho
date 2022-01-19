<?php

class User
{
    public string $username;

    public string $email;

    public string $password;

    public bool $admin;

    public string $created_date;

    public static function getInstance($fetchData)
    {
        $instance = new self();

        $instance->username = $fetchData["username"];
        $instance->email = $fetchData["email"];
        $instance->password = $fetchData["password"];
        $instance->admin = $fetchData["admin"];
        $instance->created_date = $fetchData["created_date"];

        return $instance;
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
