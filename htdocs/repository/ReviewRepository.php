<?php
require_once "IDAO.php";
require_once "model/Review.php";

/**
 * Manage operations in the database for review entities.
 * 
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class ReviewRepository implements IDAO
{

    private const TABLE_NAME = "review";

    /**
     * Obtains a review from the database.
     *
     * @param string $id The review ID.
     * @return Review The review.
     */
    function find($id)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM " . self::TABLE_NAME .  " WHERE `id` = ?");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return Review::getInstance($fetch[0]);
    }

    /**
     * Obtains all the review from the database. Supports pagination.
     *
     * @param mixed $page Actual page number. If not defined, all results are returned.
     * @param integer $amount Amount of results per page.
     * @param string $orderBy THe field to do an order by.
     * @param string $orderDir The order by direction. Can be "ASC" or "DESC".
     * @return Review[] The resulting reviews.
     */
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

    /**
     * Inserts a new review into the database.
     *
     * @param stdClass|object|Review $obj The Review to insert.
     * @return true if the review was inserted, false if not.
     */
    function save($obj)
    {
        $stmt = get_db_connection()->prepare("INSERT INTO `" . self::TABLE_NAME . "` (`user_id`, `title`, `desc`, `presentation`, `texture`, `taste`, `pincho_id`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$obj->user_id, $obj->title, $obj->desc, $obj->presentation, $obj->texture, $obj->taste, $obj->pincho_id]);
    }

    /**
     * Deletes a review from the database.
     *
     * @param Review $obj The review to delete.
     * @return bool if the review was deleted, false if not.
     */
    function delete($obj): bool
    {
        $stmt = get_db_connection()->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    /**
     * Updates a review from the database.
     *
     * @param Review $obj the review to update.
     * @return bool if the review was updated, false if not.
     */
    function update($obj)
    {
        $stmt = get_db_connection()->prepare("UPDATE `" . self::TABLE_NAME . "` SET `user_id` = ?, `title` = ?, `desc` = ?, `presentation` = ?, `texture` = ?, `taste` = ?, `pincho_id` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->user_id, $obj->title, $obj->desc, $obj->presentation, $obj->texture, $obj->taste, $obj->pincho_id, $obj->id]);
    }

    /**
     * Returns the total amount of reviews on the database.
     *
     * @return int Total amount.
     */
    function total()
    {
        $results = get_db_connection()->query("SELECT count(*) as total FROM review");
        $results->execute();
        return $results->fetch()["total"];
    }

    /**
     * Obtains a bar's reviews.
     *
     * @param int $pk The bar ID.
     * @return Review[] The resulting reviews.
     */
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

    /**
     * Obtains the reviews like by an user.
     *
     * @param int $id The user's ID.
     * @return Review[] THe resulting reviews.
     */
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

    /**
     * Obtains the reviews dislike by an user.
     *
     * @param int $id The user's ID.
     * @return Review[] THe resulting reviews.
     */
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

    /**
     * Get the last review's by amount.
     *
     * @param integer $amount The amount to obtain.
     * @return Review[] The resulting reviews.
     */
    function last(int $amount)
    {
        $results = get_db_connection()->query("SELECT * FROM " . self::TABLE_NAME . " ORDER BY id DESC LIMIT $amount");
        $instances = [];

        foreach ($results as $row) {
            $instances[] = Review::getInstance($row);
        }

        return $instances;
    }

    /**
     * Obtains a pincho's reviews.
     *
     * @param int $pk The pincho ID.
     * @return Review[] The resulting reviews.
     */
    function byPincho($pk)
    {
        $stmt = get_db_connection()->prepare("SELECT r.*, SUM(CASE WHEN rul.isLike = 1 THEN 1 ELSE 0 END) as likes, SUM(CASE WHEN rul.isLike = 0 THEN 1 ELSE 0 END) as dislikes FROM `review` r  LEFT JOIN review_user_likes rul ON r.id = rul.review_id WHERE r.pincho_id = ? GROUP BY r.id ORDER BY likes DESC");
        $stmt->execute([$pk]);

        $results = $stmt->fetchAll();
        $instances = [];
        foreach ($results as $row) {
            $instances[] = Review::getInstance($row);
        }

        return $instances;
    }

    function hasBeenVotedByUser($user_id, $review_id)
    {
        $stmt = get_db_connection()->prepare("SELECT isLike FROM `review` r WHERE r.user_id = ? AND review_id = ?");
        $stmt->execute([$user_id, $review_id]);

        return $stmt->rowCount() > 0;
    }
}
