<?php
require_once "AbstractMappedSQLModel.php";

class Bar extends AbstractMappedSQLModel
{
    public int $id;
    public string $name;
    public string $address;
    public float $lon;
    public float $lat;
    public bool $terrace;
    public $principal_img_id;

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "name" => "name",
            "address" => "address",
            "lon" => "lon",
            "lat" => "lat",
            "terrace" => "terrace",
            "principal_img_id" => "principal_img_id",
        ];
    }
}
