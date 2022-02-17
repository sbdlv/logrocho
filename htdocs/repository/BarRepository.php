<?php
require_once "IDAO.php";
require_once "model/Bar.php";

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class BarRepository implements IDAO
{
    /**
     * Obtiene la información de un bar
     *
     * @param string $id el email del bar
     * @return Bar
     */
    function find($id)
    {
        $stmt = getConexion()->prepare("SELECT * FROM bar WHERE `id` = ?");
        $stmt->execute([$id]);

        $fetch = $stmt->fetchAll();

        return Bar::getInstance($fetch[0]);
    }

    /**
     * Obitiene los bares de la BD, mediante paginación
     *
     * @param mixed $page número de página actual
     * @param integer $amount Cantidad de resultados por página
     * @param mixed $orderBy El nombre del campo por el que se va a ordenar
     * @param string $orderDir Dirección de ordenación (ASC, DESC)
     * @return array Array de bares
     */
    function findAll($page = false, $amount = 1, $orderBy = false, $orderDir = "DESC")
    {
        if ($page !== false) {
            if ($orderBy) {
                $results = getConexion()->query("SELECT * FROM bar ORDER BY " . $orderBy . " " . $orderDir . " LIMIT $page,$amount");
            } else {
                $results = getConexion()->query("SELECT * FROM bar LIMIT $page,$amount");
            }
        } else {
            $results = getConexion()->query("SELECT * FROM bar");
        }

        $instances = [];

        foreach ($results as $row) {
            $instances[] = Bar::getInstance($row);
        }

        return $instances;
    }

    /**
     * Inserta en la base de datos el usuario
     *
     * @param stdClass|object $obj
     * @return true si todo ha sido correcto, false sí no.
     */
    function save($obj)
    {
        $stmt = getConexion()->prepare("INSERT INTO `bar`(`name`, `address`, `lon`, `lat`, `terrace`) VALUES (?,?,?,?,?)");
        return $stmt->execute([$obj->name, $obj->address, $obj->lon, $obj->lat, $obj->terrace]);
    }

    function delete($obj): bool
    {
        $stmt = getConexion()->prepare("DELETE FROM bar WHERE `id` = ?");
        $stmt->execute([$obj->id]);

        return $stmt->rowCount();
    }

    function update($obj)
    {
        $stmt = getConexion()->prepare("UPDATE `bar` SET `name` = ?, `address` = ?, `lon` = ?, `lat` = ?, `terrace` = ? WHERE `id` = ?");
        return $stmt->execute([$obj->name, $obj->address, $obj->lon, $obj->lat, $obj->terrace, $obj->id]);
    }

    function total()
    {
        $results = getConexion()->query("SELECT count(*) as total FROM bar");
        $results->execute();
        return $results->fetch()["total"];
    }

    function uploadPic($pk, $path, $priority = -1)
    {
        $stmt = getConexion()->prepare("INSERT INTO `multimediaBar`(`bar_id`, `path`, `priority`) VALUES (?,?,?)");
        return $stmt->execute([$pk, $path, $priority]);
    }

    function getImages($id, &$imgs = [])
    {
        $stmt = getConexion()->prepare("SELECT * FROM `multimediabar` WHERE bar_id = ? ORDER BY priority, id");

        $stmt->execute([$id]);

        foreach ($stmt as $row) {
            $imgs[$id][] = $row["path"];
        }

        return $imgs;
    }

    function getImagesForArray($objs, $imgs = [])
    {
        foreach ($objs as $obj => $id) {
            $this->getImages($id, $imgs);
        }

        return $imgs;
    }

    function treatImages(int $id, array $imagesSrc)
    {

        if (count($imagesSrc) == 0) {
            $stmt = getConexion()->prepare("DELETE FROM `multimediabar` WHERE `bar_id` = ?");
            return $stmt->execute([$id]);
        }

        //Delete old images
        $stmt = getConexion()->prepare("DELETE FROM `multimediabar` WHERE `bar_id` = $id AND `path` NOT IN (" . str_repeat("?,", count($imagesSrc) - 1) . "? )");
        $stmt->execute($imagesSrc);

        //Reorder
        $stmt = getConexion()->prepare("UPDATE `multimediabar` SET `priority` = ? WHERE `path` = ?");

        $priority = 0;

        foreach ($imagesSrc as $src) {
            $stmt->execute([$priority, $src]);
            $priority++;
        }
    }

    function search($page, $amount, $nameLike = "", $addressLike = "", $minRating = 0, $maxRating = 5)
    {
        $baseQuery = "SELECT id, name, address, lon, lat, terrace, AVG(t.total) as rating FROM (SELECT p.id as pid, b.*,(SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/ 3 as total FROM `pincho` p JOIN review r ON p.id = r.pincho_id JOIN bar b ON b.id = p.bar_id GROUP BY p.id) t GROUP BY id HAVING";

        //Having
        $baseQuery .= " name LIKE ?";
        $baseQuery .= " AND address LIKE ?";
        $baseQuery .= " AND rating > ?";
        $baseQuery .= " AND rating < ?";

        $baseQuery .= " LIMIT $page,$amount";

        $stmt = getConexion()->prepare($baseQuery);
        $stmt->execute(["%" . $nameLike . "%", "%" . $addressLike . "%", $minRating, $maxRating]);

        $results = $stmt->fetchAll();
        $instances = [];


        foreach ($results as $row) {
            $instances[] = Bar::getInstance($row);
        }

        return $instances;
    }
}
