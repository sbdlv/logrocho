<?php
require_once "AbstractMappedSQLModel.php";


class Pincho extends AbstractMappedSQLModel{

    public int $id;
    public int $bar_id;
    public string $name;

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "bar_id" => "bar_id",
            "name" => "name",
        ];
        
    }
}