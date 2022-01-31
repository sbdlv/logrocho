<?php
require_once "AbstractMappedSQLModel.php";


class Pincho extends AbstractMappedSQLModel{

    public int $id;
    public int $bar_id;
    public string $name;
    public $principal_img_id;

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "bar_id" => "bar_id",
            "name" => "name",
            "principal_img_id" => "principal_img_id",
        ];
        
    }
}