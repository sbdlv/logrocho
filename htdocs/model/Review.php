<?php
require_once "AbstractMappedSQLModel.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class Review extends AbstractMappedSQLModel
{
    public $id;

    public $user_id;

    public $title;

    public $desc;

    public $presentation;
    public $texture;
    public $taste;

    public $pincho_id;

    public $likes;
    public $dislikes;

    static function getPropertiesMapArray(): array
    {
        return [
            "id" => "id",
            "user_id" => "user_id",
            "title" => "title",
            "desc" => "desc",
            "presentation" => "presentation",
            "texture" => "texture",
            "taste" => "taste",
            "pincho_id" => "pincho_id",
            "likes" => "likes",
            "dislikes" => "dislikes",
        ];
    }
}
