<?php
require_once "IDAO.php";
require_once "model/User.php";

/**
 * Manage operations in the database for user entities.
 * 
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class UserRepository implements IDAO
{
    /**
     * Obtains an user from the database by email.
     *
     * @param string $id The user email.
     * @return User The user.
     */
    function find($email)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM user WHERE `email` = ?");
        $stmt->execute([$email]);

        $fetch = $stmt->fetchAll();

        return User::getInstance($fetch[0]);
    }

    /**
     * Obtains an user from the database by ID.
     *
     * @param string $id The user ID.
     * @return User The user.
     */
    function findById($id)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM user WHERE `id` = ?");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return User::getInstance($fetch[0]);
    }

    /**
     * Obtains all the users from the database. Supports pagination.
     *
     * @param mixed $page Actual page number. If not defined, all results are returned.
     * @param integer $amount Amount of results per page.
     * @param string $orderBy THe field to do an order by.
     * @param string $orderDir The order by direction. Can be "ASC" or "DESC"
     * @return User[] The resulting users.
     */
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

    /**
     * Inserts a new pincho into the database.
     *
     * @param stdClass|object|User $obj The user to insert.
     * @return true if the user was inserted, false if not.
     */
    function save($obj)
    {
        if ($obj instanceof stdClass) {
            $obj = User::getInstance($obj);
        }

        $stmt = get_db_connection()->prepare("INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`, `admin`, `created_date`) VALUES (?, ?, ?, sha1(?), ?, now())");
        return $stmt->execute([isset($obj->first_name) ? $obj->first_name : "", isset($obj->last_name) ? $obj->last_name : "", $obj->email, $obj->password, 0]);
    }

    /**
     * Deletes a user from the database
     *
     * @param User $obj The user to delete
     * @return bool if the user was deleted, false if not.
     */
    function delete($obj)
    {
        $stmt = get_db_connection()->prepare("DELETE FROM user WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    /**
     * Updates a user from the database
     *
     * @param User $obj the user to update
     * @return bool if the user was updated, false if not.
     */
    function update($obj)
    {
        $stmt = get_db_connection()->prepare("UPDATE `user` SET `first_name` = ?, `last_name` = ?, `email` = ?, `created_date` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->first_name, $obj->last_name, $obj->email, $obj->created_date, $obj->id]);
    }

    /**
     * Check the login credentials of an user.
     *
     * @param string $email The user's email.
     * @param string $password The user's password.
     * @return bool True if the credentials are correct, false if not.
     */
    function login($email, $password)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM user WHERE `email` = ? AND `password` = ?");
        $stmt->execute([$email, sha1($password)]);

        return count($stmt->fetchAll()) > 0;
    }

    /**
     * Removes the likes given by the user.
     *
     * @param int $id The user's ID.
     * @return bool True if the operation was executed without errors, false if not.
     */
    function removeLikes($id)
    {
        $stmt = get_db_connection()->prepare("DELETE FROM review_user_likes WHERE `user_id` = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Removes the dislikes given by the user.
     *
     * @param int $id The user's ID.
     * @return bool True if the operation was executed without errors, false if not.
     */
    function removeReviews($id)
    {
        $stmt = get_db_connection()->prepare("DELETE FROM review WHERE `user_id` = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Check if a user is the original poster of a given review.
     *
     * @param int $user_id The user's ID.
     * @param int $review_id The review ID.
     * @return bool True if the user is the OP of the review, false if not.
     */
    function checkReviewOP($user_id, $review_id)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM review WHERE `user_id` = ? AND `id` = ?");
        $stmt->execute([$user_id, $review_id]);

        return $stmt->rowCount() > 0;
    }

    /**
     * Returns the total amount of users on the database.
     *
     * @return int Total amount.
     */
    function total()
    {
        $results = get_db_connection()->query("SELECT count(*) as total FROM user");
        $results->execute();
        return $results->fetch()["total"];
    }

    /**
     * Vote a review.
     *
     * @param int $user_id The user ID who is doing the vote.
     * @param int $review_id The review to vote.
     * @param bool $isLike Inicates if the vote is a like or dislike.
     * @return bool True if the operation was executed without errors, false if not.
     */
    function voteReview($user_id, $review_id, $isLike)
    {
        $stmt = get_db_connection()->prepare("SET @user_id = ?, @review_id = ?, @is_like = ?; INSERT INTO `review_user_likes`(`user_id`, `review_id`, `isLike`) VALUES (@user_id, @review_id, @is_like) ON DUPLICATE KEY UPDATE isLike = @is_like");
        return $stmt->execute([$user_id, $review_id, $isLike ? 1 : 0]);
    }

    /**
     * Remove a vote from a user to a specific review
     *
     * @param int $user_id The user ID
     * @param int $review_id The review ID
     * @return bool True if the operation was executed without errors, false if not.
     */
    function removeVote($user_id, $review_id)
    {
        $stmt = get_db_connection()->prepare("DELETE FROM review_user_likes WHERE `user_id` = ? AND `review_id` = ?");
        return $stmt->execute([$user_id, $review_id]);
    }
}
