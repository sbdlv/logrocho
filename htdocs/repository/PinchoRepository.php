<?php
require_once "IDAO.php";
require_once "model/Pincho.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class PinchoRepository implements IDAO
{

    private const DB_TABLE = "pincho";

    function find($id)
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM " . self::DB_TABLE . " WHERE `id` = ?");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return Pincho::getInstance($fetch[0]);
    }

    function findAll($page = false, $amount = 1)
    {
        if ($page !== false) {
            $results = get_db_connection()->query("SELECT * FROM " . self::DB_TABLE . " LIMIT $page,$amount");
        } else {
            $results = get_db_connection()->query("SELECT * FROM " . self::DB_TABLE . "");
        }

        $instances = [];

        foreach ($results as $row) {
            $instances[] = Pincho::getInstance($row);
        }

        return $instances;
    }

    function save($obj)
    {
        $stmt = get_db_connection()->prepare("INSERT INTO `pincho`(`bar_id`, `name`) VALUES (?,?)");
        return $stmt->execute([$obj->bar_id, $obj->name]);
    }

    function delete($obj): bool
    {
        $stmt = get_db_connection()->prepare("DELETE FROM " . self::DB_TABLE . " WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    function update($obj)
    {
        $stmt = get_db_connection()->prepare("UPDATE `pincho` SET `bar_id` = ?, `name` = ?, `price` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->bar_id, $obj->name, $obj->price, $obj->id]);
    }

    function uploadPic($pk, $path, $priority = -1)
    {
        $stmt = get_db_connection()->prepare("INSERT INTO `multimediaPincho`(`pincho_id`, `path`, `priority`) VALUES (?,?,?)");
        return $stmt->execute([$pk, $path, $priority]);
    }

    function getImages($id, &$imgs = [])
    {
        $stmt = get_db_connection()->prepare("SELECT * FROM `multimediapincho` WHERE pincho_id = ? ORDER BY priority, id");

        $stmt->execute([$id]);

        foreach ($stmt as $row) {
            $imgs[$id][] = $row["path"];
        }

        return $imgs;
    }

    function total()
    {
        $results = get_db_connection()->query("SELECT count(*) as total FROM pincho");
        $results->execute();
        return $results->fetch()["total"];
    }

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

    function last(int $amount)
    {
        $results = get_db_connection()->query("SELECT * FROM pincho ORDER BY id DESC LIMIT $amount");
        $instances = [];

        foreach ($results as $row) {
            $instances[] = Pincho::getInstance($row);
        }

        return $instances;
    }
}
