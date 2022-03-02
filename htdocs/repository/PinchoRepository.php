<?php
require_once "IDAO.php";
require_once "model/Pincho.php";

/**
 * Manage operations in the database for pincho entities.
 * 
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class PinchoRepository implements IDAO
{

    /**
     * Obtains a pincho from the database.
     *
     * @param string $id The pincho ID.
     * @return Pincho The pincho.
     */
    function find($id)
    {
        $stmt = get_db_connection()->prepare("SELECT p.*, IFNULL((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/ 3 / COUNT(r.id), 0) as rating, b.name bar_name FROM `pincho` p LEFT JOIN review r ON p.id = r.pincho_id JOIN bar b ON b.id = p.bar_id WHERE p.id = ? GROUP BY p.id");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return Pincho::getInstance($fetch[0]);
    }

    /**
     * Obtains all the pinchos from the database. Supports pagination.
     *
     * @param mixed $page Actual page number. If not defined, all results are returned.
     * @param integer $amount Amount of results per page.
     * @return Pincho[] The resulting pinchos.
     */
    function findAll($page = false, $amount = 1)
    {
        if ($page !== false) {
            $results = get_db_connection()->query("SELECT p.*, IFNULL((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/ 3 / COUNT(r.id), 0) as rating FROM `pincho` p LEFT JOIN review r ON p.id = r.pincho_id GROUP BY p.id LIMIT $page,$amount");
        } else {
            $results = get_db_connection()->query("SELECT p.*, IFNULL((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/ 3 / COUNT(r.id), 0) as rating FROM `pincho` p LEFT JOIN review r ON p.id = r.pincho_id GROUP BY p.id");
        }

        $instances = [];

        foreach ($results as $row) {
            $instances[] = Pincho::getInstance($row);
        }

        return $instances;
    }

    /**
     * Inserts a new pincho into the database
     *
     * @param stdClass|object|Pincho $obj The Pincho to insert.
     * @return true if the pincho was inserted, false if not.
     */
    function save($obj)
    {
        $stmt = get_db_connection()->prepare("INSERT INTO `pincho`(`bar_id`, `name`) VALUES (?,?)");
        return $stmt->execute([$obj->bar_id, $obj->name]);
    }

    /**
     * Deletes a pincho from the database
     *
     * @param Pincho $obj The pincho to delete
     * @return boolean if the pincho was deleted, false if not.
     */
    function delete($obj): bool
    {
        $stmt = get_db_connection()->prepare("DELETE FROM `pincho` WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    /**
     * Updates a pincho from the database
     *
     * @param Pincho $obj the pincho to update
     * @return boolean if the pincho was updated, false if not.
     */
    function update($obj)
    {
        $stmt = get_db_connection()->prepare("UPDATE `pincho` SET `bar_id` = ?, `name` = ?, `price` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->bar_id, $obj->name, $obj->price, $obj->id]);
    }

    /**
     * Returns the total amount of pinchos on the database.
     *
     * @return int Total amount.
     */
    function total()
    {
        $results = get_db_connection()->query("SELECT count(*) as total FROM pincho");
        $results->execute();
        return $results->fetch()["total"];
    }

    /**
     * Uploads a picture for a pincho.
     *
     * @param int $pk The pincho ID.
     * @param string $path The img path.
     * @param int $priority The priority of the image.
     * @return boolean if the image was inserted, false if not.
     */
    function uploadPic($pk, $path, $priority = -1)
    {
        $stmt = get_db_connection()->prepare("INSERT INTO `multimediaPincho`(`pincho_id`, `path`, `priority`) VALUES (?,?,?)");
        return $stmt->execute([$pk, $path, $priority]);
    }

    /**
     * Returns the images of a pincho by ID.
     *
     * @param int $id The pincho ID.
     * @param array $imgs If passed, a new entry will be created on the array, where the key is the pincho ID and the value is the array of images of such pincho. 
     * @return array The images array.
     */
    function getImages($id, &$imgs = [])
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM `multimediapincho` WHERE pincho_id = ? ORDER BY priority, id");

        $stmt->execute([$id]);

        foreach ($stmt as $row) {
            $imgs[] = $row["path"];
        }

        return $imgs;
    }

    /**
     * Manages the pincho images
     *
     * @param integer $id The pincho ID
     * @param array $imagesSrc The pincho images paths. If empty, all the current images will be deleted.
     * @return boolean If the images were deleted or not. 
     */
    function treatImages(int $id, array $imagesSrc)
    {

        if (count($imagesSrc) == 0) {
            $stmt = get_db_connection()->prepare("DELETE FROM `multimediapincho` WHERE `pincho_id` = ?");
            return $stmt->execute([$id]);
        }

        //Delete old images
        $stmt = get_db_connection()->prepare("DELETE FROM `multimediapincho` WHERE `pincho_id` = $id AND `path` NOT IN (" . str_repeat("?,", count($imagesSrc) - 1) . "? )");
        $stmt->execute($imagesSrc);

        //Reorder
        $stmt = get_db_connection()->prepare("UPDATE `multimediapincho` SET `priority` = ? WHERE `path` = ?");

        $priority = 0;

        foreach ($imagesSrc as $src) {
            $stmt->execute([$priority, $src]);
            $priority++;
        }
    }

    /**
     * Advance search for pinchos.
     *
     * @param int $page Page number.
     * @param int $amount Amount of results per page.
     * @param string $nameLike The like condition for the pincho's name. By default empty (any).
     * @param string $barLike The like condition for the pincho's bar name. By default empty (any).
     * @param integer $minRating The like condition for the minimum pincho's rating accepted. By default 0 (lowest).
     * @param integer $maxRating The like condition for the maximum pincho's rating accepted. By default 5 (highest).
     * @return Pincho[] The pincho that meet the conditions.
     */
    function search($page, $amount, $nameLike = "", $barLike = "", $minRating = 0, $maxRating = 5)
    {

        $baseQuery = "SELECT p.*, b.name bar_name, IFNULL(IFNULL((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/ 3 / COUNT(r.id), 0), 0) as rating FROM `pincho` p LEFT JOIN review r ON p.id = r.pincho_id JOIN `bar` b ON b.id = p.bar_id GROUP BY p.id HAVING";

        //Having
        $baseQuery .= " p.name LIKE ?";
        $baseQuery .= " AND b.name LIKE ?";
        $baseQuery .= " AND rating >= ?";
        $baseQuery .= " AND rating <= ?";

        $baseQuery .= " LIMIT $page,$amount";

        $stmt = get_db_connection()->prepare($baseQuery);
        $stmt->execute(["%" . $nameLike . "%", "%" . $barLike . "%", $minRating, $maxRating]);

        $results = $stmt->fetchAll();
        $instances = [];


        foreach ($results as $row) {
            $instances[] = Pincho::getInstance($row);
        }

        return $instances;
    }

    /**
     * Gets the total amount of results of an advance search. Useful for pagination.
     *
     * @param string $nameLike The like condition for the pincho's name. By default empty (any).
     * @param string $barLike The like condition for the pincho's pincho name. By default empty (any).
     * @param integer $minRating The like condition for the minimum pincho's rating accepted. By default 0 (lowest).
     * @param integer $maxRating The like condition for the maximum pincho's rating accepted. By default 5 (highest).
     * @return int The total amount of results.
     */
    function searchTotal($nameLike = "", $barLike = "", $minRating = 0, $maxRating = 5)
    {

        $baseQuery = "SELECT p.*, b.name, IFNULL(IFNULL((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/ 3 / COUNT(r.id), 0), 0) as rating FROM `pincho` p LEFT JOIN review r ON p.id = r.pincho_id JOIN `bar` b ON b.id = p.bar_id GROUP BY p.id HAVING";

        //Having
        $baseQuery .= " p.name LIKE ?";
        $baseQuery .= " AND b.name LIKE ?";
        $baseQuery .= " AND rating >= ?";
        $baseQuery .= " AND rating <= ?";

        $stmt = get_db_connection()->prepare($baseQuery);
        $stmt->execute(["%" . $nameLike . "%", "%" . $barLike . "%", $minRating, $maxRating]);

        $results = $stmt->fetchAll();

        return count($results);
    }

    /**
     * Obtains a bar's pinchos.
     *
     * @param int $pk The bar ID.
     * @return Pincho[] The resulting pinchos.
     */
    function byBar($pk)
    {
        $baseQuery = "SELECT p.*, b.name bar_name, IFNULL(IFNULL((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/ 3 / COUNT(r.id), 0), 0) as rating FROM `pincho` p LEFT JOIN review r ON p.id = r.pincho_id JOIN `bar` b ON b.id = p.bar_id WHERE b.id = ? GROUP BY p.id";

        $stmt = get_db_connection()->prepare($baseQuery);
        $stmt->execute([$pk]);

        $results = $stmt->fetchAll();
        $instances = [];


        foreach ($results as $row) {
            $instances[] = Pincho::getInstance($row);
        }

        return $instances;
    }

    /**
     * Get the last pincho's by amount.
     *
     * @param integer $amount The amount to obtain.
     * @return Pincho[] The resulting pinchos.
     */
    function last(int $amount)
    {
        $results = get_db_connection()->query("SELECT p.*, IFNULL((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/ 3 / COUNT(r.id), 0) as rating, b.name bar_name FROM `pincho` p LEFT JOIN review r ON p.id = r.pincho_id JOIN bar b ON b.id = p.bar_id GROUP BY p.id ORDER BY p.id DESC LIMIT $amount");
        $instances = [];

        foreach ($results as $row) {
            $instances[] = Pincho::getInstance($row);
        }

        return $instances;
    }

    /**
     * Gets allergens of a pincho.
     *
     * @param Pincho $obj The pincho to query for.
     * @return array The pincho's allergens ID
     */
    function getAllergens($obj)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM `pincho_allergen` WHERE pincho_id = ?");

        $stmt->execute([$obj->id]);

        $allergens = [];

        foreach ($stmt as $row) {
            $allergens[] = $row["allergen_id"];
        }

        return $allergens;
    }

    /**
     * Sets the pincho's allergens
     *
     * @param Pincho $obj The pincho to set the allergens.
     * @param array $allergens THe allergens id to add.
     * @return boolean True if the operation was succesful.
     */
    function setAllergens($obj, $allergens)
    {
        $stmt = get_db_connection()->prepare("DELETE FROM `pincho_allergen` WHERE `pincho_id` = ?");
        $stmt->execute([$obj->id]);

        $stmt = get_db_connection()->prepare("INSERT INTO `pincho_allergen` (pincho_id, allergen_id) VALUES (?, ?)");

        foreach ($allergens as $allergen) {
            $stmt->execute([$obj->id, $allergen]);
        }

        return true;
    }
}
