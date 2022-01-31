<?php
require_once "AbstractMappedSQLModel.php";

class Review extends AbstractMappedSQLModel
{
    public int $id;

    public int $user_id;

    public string $title;

    public string $desc;

    public int $presentation;
    public int $texture;
    public int $taste;

    public bool $pincho_id;

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
        ];
    }
}
