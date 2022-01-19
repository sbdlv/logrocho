<?php
require_once "AbstractMappedSQLModel.php";


class Pincho extends AbstractMappedSQLModel{

    static int $id;
    static int $bar_id;
    static string $name;

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "bar_id" => "bar_id",
            "name" => "name",
        ];
        
    }
}