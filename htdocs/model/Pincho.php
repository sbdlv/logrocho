<?php
require_once "AbstractMappedSQLModel.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class Pincho extends AbstractMappedSQLModel
{

    public $id;
    public $bar_id;
    public $name;
    public $desc;
    public $price;
    public $rating;
    public $bar_name;

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "bar_id" => "bar_id",
            "name" => "name",
            "desc" => "desc",
            "price" => "price",
            "rating" => "rating",
            "bar_name" => "bar_name",
        ];
    }
}
