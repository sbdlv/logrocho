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
        $stmt = get_db_connection()->prepare("SELECT * FROM " . self::TABLE_NAME .  " WHERE `id` = ?");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return Review::getInstance($fetch[0]);
    }

    function findAll($page = false, $amount = 1, $orderBy = false, $orderDir = "DESC")
    {
        if ($page !== false) {
            if ($orderBy) {
                $results = get_db_connection()->query("SELECT * FROM " . self::TABLE_NAME . " ORDER BY " . $orderBy . " " . $orderDir . " LIMIT $page,$amount");
            } else {
                $results = get_db_connection()->query("SELECT * FROM " . self::TABLE_NAME . " LIMIT $page,$amount");
            }
        } else {
            $results = get_db_connection()->query("SELECT * FROM " . self::TABLE_NAME);
        }

        $instances = [];

        foreach ($results as $row) {
            $instances[] = Review::getInstance($row);
        }

        return $instances;
    }

    function save($obj)
    {
        $stmt = get_db_connection()->prepare("INSERT INTO `" . self::TABLE_NAME . "` (`user_id`, `title`, `desc`, `presentation`, `texture`, `taste`, `pincho_id`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$obj->user_id, $obj->title, $obj->desc, $obj->presentation, $obj->texture, $obj->taste, $obj->pincho_id]);
    }

    function delete($obj): bool
    {
        $stmt = get_db_connection()->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    function update($obj)
    {
        $stmt = get_db_connection()->prepare("UPDATE `" . self::TABLE_NAME . "` SET `user_id` = ?, `title` = ?, `desc` = ?, `presentation` = ?, `texture` = ?, `taste` = ?, `pincho_id` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->user_id, $obj->title, $obj->desc, $obj->presentation, $obj->texture, $obj->taste, $obj->pincho_id, $obj->id]);
    }

    function total()
    {
        $results = get_db_connection()->query("SELECT count(*) as total FROM review");
        $results->execute();
        return $results->fetch()["total"];
    }

    function byUser($id)
    {
        $stmt = get_db_connection()->prepare("SELECT r.*, SUM(CASE WHEN rul.isLike = 1 THEN 1 ELSE 0 END) as likes, SUM(CASE WHEN rul.isLike = 0 THEN 1 ELSE 0 END) as dislikes FROM `review` r  JOIN review_user_likes rul ON r.id = rul.review_id WHERE r.user_id = ? GROUP BY r.id");
        $stmt->execute([$id]);

        $results = $stmt->fetchAll();
        $instances = [];
        foreach ($results as $row) {
            $instances[] = Review::getInstance($row);
        }

        return $instances;
    }

    function likedByUser($id)
    {
        $stmt = get_db_connection()->prepare("SELECT r.*, SUM(CASE WHEN rul.isLike = 1 THEN 1 ELSE 0 END) as likes, SUM(CASE WHEN rul.isLike = 0 THEN 1 ELSE 0 END) as dislikes FROM `review` r  JOIN review_user_likes rul ON r.id = rul.review_id WHERE rul.user_id = ? AND rul.isLike = 1 GROUP BY r.id");
        $stmt->execute([$id]);

        $results = $stmt->fetchAll();
        $instances = [];
        foreach ($results as $row) {
            $instances[] = Review::getInstance($row);
        }

        return $instances;
    }

    function dislikedByUser($id)
    {
        $stmt = get_db_connection()->prepare("SELECT r.*, SUM(CASE WHEN rul.isLike = 1 THEN 1 ELSE 0 END) as likes, SUM(CASE WHEN rul.isLike = 0 THEN 1 ELSE 0 END) as dislikes FROM `review` r  JOIN review_user_likes rul ON r.id = rul.review_id WHERE rul.user_id = ? AND rul.isLike = 0 GROUP BY r.id");
        $stmt->execute([$id]);

        $results = $stmt->fetchAll();
        $instances = [];
        foreach ($results as $row) {
            $instances[] = Review::getInstance($row);
        }

        return $instances;
    }

    function last(int $amount)
    {
        $results = get_db_connection()->query("SELECT * FROM " . self::TABLE_NAME . " ORDER BY id DESC LIMIT $amount");
        $instances = [];

        foreach ($results as $row) {
            $instances[] = Review::getInstance($row);
        }

        return $instances;
    }

    function byPincho($pk)
    {
        $stmt = get_db_connection()->prepare("SELECT r.*, SUM(CASE WHEN rul.isLike = 1 THEN 1 ELSE 0 END) as likes, SUM(CASE WHEN rul.isLike = 0 THEN 1 ELSE 0 END) as dislikes FROM `review` r  JOIN review_user_likes rul ON r.id = rul.review_id WHERE r.pincho_id = ? GROUP BY r.id ORDER BY likes DESC");
        $stmt->execute([$pk]);

        $results = $stmt->fetchAll();
        $instances = [];
        foreach ($results as $row) {
            $instances[] = Review::getInstance($row);
        }

        return $instances;
    }
}
