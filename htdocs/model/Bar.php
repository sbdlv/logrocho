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

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "name" => "name",
            "address" => "address",
            "lon" => "lon",
            "lat" => "lat",
            "terrace" => "terrace",
        ];
    }
}
