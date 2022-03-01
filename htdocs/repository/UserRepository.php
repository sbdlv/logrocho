<?php
require_once "IDAO.php";
require_once "model/User.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class UserRepository implements IDAO
{
    function find($email)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM user WHERE `email` = ?");
        $stmt->execute([$email]);

        $fetch = $stmt->fetchAll();

        return User::getInstance($fetch[0]);
    }

    function findById($id)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM user WHERE `id` = ?");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return User::getInstance($fetch[0]);
    }

    function findAll($page = false, $amount = 1, $orderBy = false, $orderDir = "DESC")
    {
        if ($page !== false) {
            if ($orderBy) {
                $results = get_db_connection()->query("SELECT * FROM user ORDER BY " . $orderBy . " " . $orderDir . " LIMIT $page,$amount");
            } else {
                $results = get_db_connection()->query("SELECT * FROM user LIMIT $page,$amount");
            }
        } else {
            $results = get_db_connection()->query("SELECT * FROM user");
        }

        $instances = [];

        foreach ($results as $row) {
            $instances[] = User::getInstance($row);
        }

        return $instances;
    }

    function save($obj)
    {
        if ($obj instanceof stdClass) {
            $obj = User::getInstance($obj);
        }

        $stmt = get_db_connection()->prepare("INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`, `admin`, `created_date`) VALUES (?, ?, ?, sha1(?), ?, now())");
        return $stmt->execute([$obj->first_name, $obj->last_name, $obj->email, $obj->password, false]);
    }

    function delete($obj)
    {
        $stmt = get_db_connection()->prepare("DELETE FROM user WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    function update($obj)
    {
        $stmt = get_db_connection()->prepare("UPDATE `user` SET `first_name` = ?, `last_name` = ?, `email` = ?, `created_date` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->first_name, $obj->last_name, $obj->email, $obj->created_date, $obj->id]);
    }

    function login($email, $password)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM user WHERE `email` = ? AND `password` = ?");
        $stmt->execute([$email, sha1($password)]);

        return count($stmt->fetchAll()) > 0;
    }

    function removeLikes($id)
    {
        $stmt = get_db_connection()->prepare("DELETE FROM review_user_likes WHERE `user_id` = ?");
        return $stmt->execute([$id]);
    }

    function removeReviews($id)
    {
        $stmt = get_db_connection()->prepare("DELETE FROM review WHERE `user_id` = ?");
        return $stmt->execute([$id]);
    }

    function checkReviewOP($user_id, $review_id)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM review WHERE `user_id` = ? AND `id` = ?");
        $stmt->execute([$user_id, $review_id]);

        return $stmt->rowCount() > 0;
    }

    function total()
    {
        $results = get_db_connection()->query("SELECT count(*) as total FROM user");
        $results->execute();
        return $results->fetch()["total"];
    }
}
