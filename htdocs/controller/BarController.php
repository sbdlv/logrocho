<?php
require_once "repository/BarRepository.php";
add_to_breadcrumbs("Bares", get_server_index_base_url() . "bar/list");

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class BarController
{
    private const AMOUNT_OF_RESULTS_PER_PAGE = 4;

    function list()
    {
        $repo = new BarRepository();

        $bars = $repo->findAll();
        $activeMenu = "bar";
        include "view/Bar/list.php";
    }

    function edit($id)
    {
        add_to_breadcrumbs("Bar #$id");
        $repo = new BarRepository();

        $bar = $repo->find($id);
        $barImages = $repo->getImages($id);
        $activeMenu = "bar";
        include "view/Bar/edit.php";
    }

    function alta()
    {
        if (isset($_POST["name"], $_POST["address"], $_POST["lon"], $_POST["lat"], $_POST["terrace"])) {
            $bar = new Bar();

            $bar->name = $_POST["name"];
            $bar->address = $_POST["address"];
            $bar->lon = $_POST["lon"];
            $bar->lat = $_POST["lat"];
            $bar->terrace = $_POST["terrace"];
            //TODO: Incluir campo imagen etc

            $repo = new BarRepository();

            $newBarID = $repo->save($bar);
            if ($newBarID !== false) {
                echo $newBarID;
            } else {
                echo "Error: No se ha dado de alta el bar";
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }

    function update()
    {
        if (isset($_POST["id"], $_POST["name"], $_POST["address"], $_POST["lon"], $_POST["lat"], $_POST["terrace"])) {
            $bar = new Bar();

            $bar->id = $_POST["id"];
            $bar->name = $_POST["name"];
            $bar->address = $_POST["address"];
            $bar->lon = $_POST["lon"];
            $bar->lat = $_POST["lat"];
            $bar->terrace = $_POST["terrace"];

            $repo = new BarRepository();

            $images = isset($_POST["images"]) ? $_POST["images"] : [];
            $repo->treatImages($_POST["id"], $images);

            if ($repo->update($bar)) {
                echo "Se ha modificado el bar";
            } else {
                echo "Error: No se ha modificado el bar";
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }

    function delete()
    {
        if (isset($_POST["id"])) {
            $repo = new BarRepository();
            $bar = new Bar();

            $bar->id = $_POST["id"];

            if ($repo->delete($bar)) {
                echo "Se ha borrado el bar";
            } else {
                http_response_code(400);
                echo "Error: No se ha podido borrar el bar" . $bar->id;
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }

    function jsonAll($page = false, $orderBy = false, $orderDir = false)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        $repo = new BarRepository();

        if ($page) {
            $offset = ($page - 1) * self::AMOUNT_OF_RESULTS_PER_PAGE;

            if ($orderBy && $orderDir) {
                echo json_encode($repo->findAll($offset, self::AMOUNT_OF_RESULTS_PER_PAGE, $orderBy, $orderDir));
            } else {
                echo json_encode($repo->findAll($offset, self::AMOUNT_OF_RESULTS_PER_PAGE));
            }
        } else {
            echo json_encode($repo->findAll());
        }
    }

    function json($id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $repo = new BarRepository();

        echo json_encode($repo->find($id));
    }

    function total()
    {
        header('Content-Type: application/json; charset=utf-8');
        $repo = new BarRepository();

        echo json_encode($repo->total());
    }

    function uploadPic()
    {
        if (isset($_POST["pk"], $_POST["name"])) {

            //TODO: Comprobar que post pk es un int y existe en BD
            $destPath = get_system_web_root_folder_path() . "/img/img_bares/" . $_POST["pk"];
            if (!file_exists($destPath)) {
                mkdir($destPath);
            }

            $ext = "." . pathinfo($_FILES["pic"]["name"])["extension"];

            $fileNameAndExt = pathinfo($_FILES["pic"]["name"])["filename"] . $ext;

            $finalPath = $destPath . "/" . $fileNameAndExt;
            move_uploaded_file($_FILES["pic"]["tmp_name"], $finalPath);

            $priority = isset($_POST["priority"]) ? $_POST["priority"] : -1;

            //BD
            $repo = new BarRepository();
            if ($repo->uploadPic($_POST["pk"], "/img/img_bares/" . $_POST["pk"] . "/" . $fileNameAndExt, $priority)) {
                echo "Se ha subido la imagen!";
            } else {
                echo "Ha ocurrido un error";
            }
        } else {
            http_response_code(400);
            echo "Falta campos POST";
        }
    }

    function new()
    {
        $activeMenu = "bar";
        add_to_breadcrumbs("Nuevo bar");

        include "view/Bar/new.php";
    }

    //Publico
    function index($id)
    {
        $data = $this->completeJson($id, true);
        include "view/Bar/index.php";
    }

    function search()
    {
        $activeMenu = "bar";
        include "view/Bar/search.php";
    }

    function searchQuery($page = 1, $amount = 1)
    {
        $repo = new BarRepository();

        $offset = ($page - 1) * $amount;

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($repo->search($offset, $amount, isset($_POST["name"]) ? $_POST["name"] : "", isset($_POST["address"]) ? $_POST["address"] : "", isset($_POST["minRating"]) ? $_POST["minRating"] : 0, isset($_POST["maxRating"]) ? $_POST["maxRating"] : 5));
    }

    function searchTotal()
    {
        $repo = new BarRepository();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($repo->searchTotal(isset($_POST["name"]) ? $_POST["name"] : "", isset($_POST["address"]) ? $_POST["address"] : "", isset($_POST["minRating"]) ? $_POST["minRating"] : 0, isset($_POST["maxRating"]) ? $_POST["maxRating"] : 5));
    }

    function map()
    {
        $activeMenu = "map";
        include "view/Bar/map.php";
    }

    function completeJson($pk, $return = false)
    {
        $repo = new BarRepository();
        require_once "repository/PinchoRepository.php";
        $repoPincho = new PinchoRepository();

        $imagesBar = $repo->getImages($pk);

        $info = [
            "bar" => $repo->find($pk),
            "pinchos" => $repoPincho->byBar($pk),
            "multimedia" => [
                "bar" => $imagesBar,
                "pinchos" => []
            ]
        ];


        foreach ($info["pinchos"] as $pincho) {
            $images = $repoPincho->getImages($pincho->id);
            $info["multimedia"]["pinchos"][$pincho->id] = $images;
        }

        if ($return) {
            return (object) $info;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($info);
    }

    public function images($id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $repo = new BarRepository();
        
        echo json_encode($repo->getImages($id));
    }
}
