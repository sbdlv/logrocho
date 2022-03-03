<?php
require_once "AbstractMappedSQLModel.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class Bar extends AbstractMappedSQLModel
{
    public int $id;
    public string $name;
    public string $desc;
    public string $address;
    public float $lon;
    public float $lat;
    public bool $terrace;
    public float $rating;

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "name" => "name",
            "desc" => "desc",
            "address" => "address",
            "lon" => "lon",
            "lat" => "lat",
            "terrace" => "terrace",
            "rating" => "rating",
        ];
    }
}
