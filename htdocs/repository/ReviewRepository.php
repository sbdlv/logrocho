<?php
require_once "IDAO.php";
require_once "model/Review.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class ReviewRepository implements IDAO
{

    private const TABLE_NAME = "review";

    function find($id)
    {
        $stmt = getConexion()->prepare("SELECT * FROM " . self::TABLE_NAME .  " WHERE `id` = ?");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return Review::getInstance($fetch[0]);
    }

    function findAll($page = false, $amount = 1, $orderBy = false, $orderDir = "DESC")
    {
        if ($page !== false) {
            if ($orderBy) {
                $results = getConexion()->query("SELECT * FROM " . self::TABLE_NAME . " ORDER BY " . $orderBy . " " . $orderDir . " LIMIT $page,$amount");
            } else {
                $results = getConexion()->query("SELECT * FROM " . self::TABLE_NAME . " LIMIT $page,$amount");
            }
        } else {
            $results = getConexion()->query("SELECT * FROM " . self::TABLE_NAME);
        }

        $instances = [];

        foreach ($results as $row) {
            $instances[] = Review::getInstance($row);
        }

        return $instances;
    }

    function save($obj)
    {
        $stmt = getConexion()->prepare("INSERT INTO `" . self::TABLE_NAME . "` (`user_id`, `title`, `desc`, `presentation`, `texture`, `taste`, `pincho_id`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$obj->user_id, $obj->title, $obj->desc, $obj->presentation, $obj->texture, $obj->taste, $obj->pincho_id]);
    }

    function delete($obj): bool
    {
        $stmt = getConexion()->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    function update($obj)
    {
        $stmt = getConexion()->prepare("UPDATE `" . self::TABLE_NAME . "` SET `user_id` = ?, `title` = ?, `desc` = ?, `presentation` = ?, `texture` = ?, `taste` = ?, `pincho_id` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->user_id, $obj->title, $obj->desc, $obj->presentation, $obj->texture, $obj->taste, $obj->pincho_id, $obj->id]);
    }
}
