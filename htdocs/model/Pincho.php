<?php
require_once "AbstractMappedSQLModel.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class Pincho extends AbstractMappedSQLModel
{

    public int $id;
    public int $bar_id;
    public string $name;
    public float $price;
    public float $rating;
    public string $bar_name;

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "bar_id" => "bar_id",
            "name" => "name",
            "price" => "price",
            "rating" => "rating",
            "bar_name" => "bar_name",
        ];
    }
}
