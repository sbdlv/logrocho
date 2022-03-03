<?php
require_once "IDAO.php";
require_once "model/Bar.php";

/**
 * Manage operations in the database for bar entities.
 * 
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class BarRepository implements IDAO
{
    /**
     * Obtains a bar from the database.
     *
     * @param string $id The bar ID.
     * @return Bar The bar.
     */
    function find($id)
    {
        $stmt = get_db_connection()->prepare("SELECT b.id, b.name, b.address, b.lon, b.lat, b.terrace, IFNULL(((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/3/COUNT(r.id)), 0) AS rating FROM `bar` b LEFT JOIN pincho p ON b.id = p.bar_id LEFT JOIN review as r ON r.pincho_id = p.id WHERE b.id = ? GROUP BY b.id");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return Bar::getInstance($fetch[0]);
    }

    /**
     * Obtains all the bars from the database. Supports pagination.
     *
     * @param mixed $page Actual page number. If not defined, all results are returned.
     * @param integer $amount Amount of results per page.
     * @param string $orderBy THe field to do an order by.
     * @param string $orderDir The order by direction. Can be "ASC" or "DESC"
     * @return Bar[] The resulting bars.
     */
    function findAll($page = false, $amount = 1, $orderBy = false, $orderDir = "DESC")
    {
        if ($page !== false) {
            if ($orderBy) {
                $results = get_db_connection()->query("SELECT b.id, b.name, b.address, b.lon, b.lat, b.terrace, IFNULL(((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/3/COUNT(r.id)), 0) AS rating FROM `bar` b LEFT JOIN pincho p ON b.id = p.bar_id LEFT JOIN review as r ON r.pincho_id = p.id GROUP BY b.id ORDER BY " . $orderBy . " " . $orderDir . " LIMIT $page,$amount");
            } else {
                $results = get_db_connection()->query("SELECT b.id, b.name, b.address, b.lon, b.lat, b.terrace, IFNULL(((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/3/COUNT(r.id)), 0) AS rating FROM `bar` b LEFT JOIN pincho p ON b.id = p.bar_id LEFT JOIN review as r ON r.pincho_id = p.id GROUP BY b.id LIMIT $page,$amount");
            }
        } else {
            $results = get_db_connection()->query("SELECT b.id, b.name, b.address, b.lon, b.lat, b.terrace, IFNULL(((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/3/COUNT(r.id)), 0) AS rating FROM `bar` b LEFT JOIN pincho p ON b.id = p.bar_id LEFT JOIN review as r ON r.pincho_id = p.id GROUP BY b.id");
        }

        $instances = [];

        foreach ($results as $row) {
            $instances[] = Bar::getInstance($row);
        }

        return $instances;
    }

    /**
     * Inserts a new bar into the database
     *
     * @param stdClass|object|Bar $obj The Bar to insert.
     * @return true if the bar was inserted, false if not.
     */
    function save($obj)
    {
        $stmt = get_db_connection()->prepare("INSERT INTO `bar`(`name`, `address`, `lon`, `lat`, `terrace`) VALUES (?,?,?,?,?)");
        if ($stmt->execute([$obj->name, $obj->address, $obj->lon, $obj->lat, $obj->terrace])) {
            return get_db_connection()->lastInsertId();
        } else {
            return false;
        }
    }

    /**
     * Deletes a bar from the database
     *
     * @param Bar $obj The bar to delete
     * @return bool if the bar was deleted, false if not.
     */
    function delete($obj): bool
    {
        $stmt = get_db_connection()->prepare("DELETE FROM bar WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    /**
     * Updates a bar from the database
     *
     * @param Bar $obj the bar to update
     * @return bool if the bar was updated, false if not.
     */
    function update($obj)
    {
        $stmt = get_db_connection()->prepare("UPDATE `bar` SET `name` = ?, `address` = ?, `lon` = ?, `lat` = ?, `terrace` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->name, $obj->address, $obj->lon, $obj->lat, $obj->terrace, $obj->id]);
    }

    /**
     * Returns the total amount of bars on the database.
     *
     * @return int Total amount.
     */
    function total()
    {
        $results = get_db_connection()->query("SELECT count(*) as total FROM bar");
        $results->execute();
        return $results->fetch()["total"];
    }

    /**
     * Uploads a picture for a bar.
     *
     * @param int $pk The bar ID.
     * @param string $path The img path.
     * @param int $priority The priority of the image.
     * @return bool if the image was inserted, false if not.
     */
    function uploadPic($pk, $path, $priority = -1)
    {
        $stmt = get_db_connection()->prepare("INSERT INTO `multimediaBar`(`bar_id`, `path`, `priority`) VALUES (?,?,?)");
        return $stmt->execute([$pk, $path, $priority]);
    }

    /**
     * Returns the images of a bar by ID.
     *
     * @param int $id The bar ID.
     * @param array $imgs If passed, a new entry will be created on the array, where the key is the bar ID and the value is the array of images of such bar. 
     * @return array The images array.
     */
    function getImages($id, &$imgs = false)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM `multimediabar` WHERE bar_id = ? ORDER BY priority, id");

        $stmt->execute([$id]);

        $imagesSrc = [];

        foreach ($stmt as $row) {
            $imagesSrc[] = $row["path"];
        }

        if ($imgs === false) {
            return $imagesSrc;
        } else {
            $imgs[$id] = $imagesSrc;
            return $imgs;
        }
    }

    /**
     * @deprecated No se esta usando?
     */
    function getImagesForArray($objs, $imgs = [])
    {
        foreach ($objs as $obj => $id) {
            $this->getImages($id, $imgs);
        }

        return $imgs;
    }

    /**
     * Manages the bar images
     *
     * @param integer $id The bar ID
     * @param array $imagesSrc The bar images paths. If empty, all the current images will be deleted.
     * @return bool If the images were deleted or not. 
     */
    function treatImages(int $id, array $imagesSrc)
    {

        if (count($imagesSrc) == 0) {
            $stmt = get_db_connection()->prepare("DELETE FROM `multimediabar` WHERE `bar_id` = ?");
            return $stmt->execute([$id]);
        }

        //Delete old images
        $stmt = get_db_connection()->prepare("DELETE FROM `multimediabar` WHERE `bar_id` = $id AND `path` NOT IN (" . str_repeat("?,", count($imagesSrc) - 1) . "? )");
        $stmt->execute($imagesSrc);

        //Reorder
        $stmt = get_db_connection()->prepare("UPDATE `multimediabar` SET `priority` = ? WHERE `path` = ?");

        $priority = 0;

        foreach ($imagesSrc as $src) {
            $stmt->execute([$priority, $src]);
            $priority++;
        }
    }

    /**
     * Advance search for bars.
     *
     * @param int $page Page number.
     * @param int $amount Amount of results per page.
     * @param string $nameLike The like condition for the bar's name. By default empty (any).
     * @param string $addressLike The like condition for the bar's address. By default empty (any).
     * @param integer $minRating The like condition for the minimum bar's rating accepted. By default 0 (lowest).
     * @param integer $maxRating The like condition for the maximum bar's rating accepted. By default 5 (highest).
     * @return Bar[] The bars that meet the conditions.
     */
    function search($page, $amount, $nameLike = "", $addressLike = "", $minRating = 0, $maxRating = 5)
    {

        $baseQuery = "SELECT b.id, b.name, b.address, b.lon, b.lat, b.terrace, IFNULL(((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/3/COUNT(r.id)), 0) AS rating FROM `bar` b LEFT JOIN pincho p ON b.id = p.bar_id LEFT JOIN review as r ON r.pincho_id = p.id GROUP BY b.id HAVING";

        //Having
        $baseQuery .= " name LIKE ?";
        $baseQuery .= " AND address LIKE ?";
        $baseQuery .= " AND rating >= ?";
        $baseQuery .= " AND rating <= ?";

        $baseQuery .= " LIMIT $page,$amount";

        $stmt = get_db_connection()->prepare($baseQuery);
        $stmt->execute(["%" . $nameLike . "%", "%" . $addressLike . "%", $minRating, $maxRating]);

        $results = $stmt->fetchAll();
        $instances = [];


        foreach ($results as $row) {
            $instances[] = Bar::getInstance($row);
        }

        return $instances;
    }

    /**
     * Gets the total amount of results of an advance search. Useful for pagination.
     *
     * @param string $nameLike The like condition for the bar's name. By default empty (any).
     * @param string $addressLike The like condition for the bar's address. By default empty (any).
     * @param integer $minRating The like condition for the minimum bar's rating accepted. By default 0 (lowest).
     * @param integer $maxRating The like condition for the maximum bar's rating accepted. By default 5 (highest).
     * @return int The total amount of results.
     */
    function searchTotal($nameLike = "", $addressLike = "", $minRating = 0, $maxRating = 5)
    {

        $baseQuery = "SELECT b.name, b.address, IFNULL(((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/3/COUNT(r.id)), 0) AS rating FROM `bar` b LEFT JOIN pincho p ON b.id = p.bar_id LEFT JOIN review as r ON r.pincho_id = p.id GROUP BY b.id HAVING";

        //Having
        $baseQuery .= " name LIKE ?";
        $baseQuery .= " AND address LIKE ?";
        $baseQuery .= " AND rating >= ?";
        $baseQuery .= " AND rating <= ?";

        $stmt = get_db_connection()->prepare($baseQuery);
        $stmt->execute(["%" . $nameLike . "%", "%" . $addressLike . "%", $minRating, $maxRating]);

        $results = $stmt->fetchAll();

        return count($results);
    }

    public function tokenSearch($searchText)
    {
        //Delete old images
        $stmt = get_db_connection()->prepare("SELECT * FROM `BAR` WHERE name LIKE ?");
        $stmt->execute(["%" . $searchText . "%"]);

        $results = $stmt->fetchAll();
        $instances = [];

        foreach ($results as $row) {
            $instances[] = Bar::getInstance($row);
        }

        return $instances;
    }
}
