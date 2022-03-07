<?php
require_once "AbstractMappedSQLModel.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class Bar extends AbstractMappedSQLModel
{
    public $id;
    public $name;
    public $desc;
    public $address;
    public $lon;
    public $lat;
    public $terrace;
    public $rating;

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
