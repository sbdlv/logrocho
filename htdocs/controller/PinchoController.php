<?php
require_once "repository/PinchoRepository.php";
add_to_breadcrumbs("Pinchos", get_server_index_base_url() . "pincho/list");

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class PinchoController
{
    private const AMOUNT_OF_RESULTS_PER_PAGE = 4;

    function index($id)
    {
        if (preg_replace('/[^0-9]/', '', $id)) {
            $data = $this->completeJson($id, true);
            include "view/Pincho/index.php";
            return;
        }

        include "404.php";
    }

    function list()
    {
        $repo = new PinchoRepository();

        $pinchos = $repo->findAll();
        $activeMenu = "pincho";
        include "view/Pincho/list.php";
    }

    function edit($id)
    {
        $repo = new PinchoRepository();
        add_to_breadcrumbs("Pincho #$id");

        require_once "repository/BarRepository.php";
        $barRepo = new BarRepository();
        $bars = $barRepo->findAll();

        require_once "repository/AllergenRepository.php";
        $allergenRepo = new AllergenRepository();
        $allergens = $allergenRepo->findAll();


        $pincho = $repo->find($id);
        $pinchoImages = $repo->getImages($id);

        $currentAllergens = $repo->getAllergens($pincho);

        $activeMenu = "pincho";
        include "view/Pincho/edit.php";
    }

    function alta()
    {
        if (isset($_POST["bar_id"], $_POST["name"])) {
            $pincho = new Pincho();

            $pincho->bar_id = $_POST["bar_id"];
            $pincho->name = $_POST["name"];
            //TODO: Incluir campo imagen etc

            $repo = new PinchoRepository();
            if ($repo->save($pincho)) {
                echo "Se ha dado de alta el pincho";
            } else {
                echo "Error: No se ha dado de alta el pincho";
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }

    function update()
    {
        if (isset($_POST["id"], $_POST["bar_id"], $_POST["name"], $_POST["desc"], $_POST["price"])) {
            $pincho = new Pincho();

            $pincho->id = $_POST["id"];
            $pincho->bar_id = $_POST["bar_id"];
            $pincho->name = $_POST["name"];
            $pincho->desc = $_POST["desc"];
            $pincho->price = $_POST["price"];

            $repo = new PinchoRepository();

            $images = isset($_POST["images"]) ? $_POST["images"] : [];
            $repo->treatImages($_POST["id"], $images);

            if ($repo->update($pincho) && $repo->setAllergens($pincho, isset($_POST["allergens"]) ? $_POST["allergens"] : [])) {
                echo "Se ha modificado el pincho";
            } else {
                http_response_code(400);
                echo "Error: No se ha modificado el pincho";
            }
        } else {
            http_response_code(400);
            echo "Error: FALTAN campos POST";
        }
    }

    function delete()
    {
        if (isset($_POST["id"])) {
            $repo = new PinchoRepository();
            $pincho = new Pincho();

            $pincho->id = $_POST["id"];

            if ($repo->delete($pincho)) {
                echo "Se ha borrado el pincho";
            } else {
                echo "Error: No se ha podido borrar el pincho";
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }

    function jsonAll($page)
    {
        header('Content-Type: application/json; charset=utf-8');

        $repo = new PinchoRepository();

        $offset = ($page - 1) * self::AMOUNT_OF_RESULTS_PER_PAGE;

        echo json_encode($repo->findAll($offset, self::AMOUNT_OF_RESULTS_PER_PAGE));
    }

    function json($id)
    {
        header('Content-Type: application/json; charset=utf-8');

        $repo = new PinchoRepository();

        echo json_encode($repo->find($id));
    }

    function uploadPic()
    {
        if (isset($_POST["pk"], $_POST["name"])) {

            //TODO: Comprobar que post pk es un int y existe en BD
            $destPath = get_system_web_root_folder_path() . "/img/img_pinchos/" . $_POST["pk"];
            if (!file_exists($destPath)) {
                mkdir($destPath);
            }

            $ext = "." . pathinfo($_FILES["pic"]["name"])["extension"];

            $fileNameAndExt = pathinfo($_FILES["pic"]["name"])["filename"] . $ext;

            $finalPath = $destPath . "/" . $fileNameAndExt;
            move_uploaded_file($_FILES["pic"]["tmp_name"], $finalPath);

            $priority = isset($_POST["priority"]) ? $_POST["priority"] : -1;

            //BD
            $repo = new PinchoRepository();
            $repo->uploadPic($_POST["pk"], "/img/img_pinchos/" . $_POST["pk"] . "/" . $fileNameAndExt, $priority);
            echo "Se ha subido la imagen";
        } else {
            http_response_code(400);
            echo "Falta campos POST";
        }
    }

    function total()
    {
        header('Content-Type: application/json; charset=utf-8');
        $repo = new PinchoRepository();

        echo json_encode($repo->total());
    }

    function search()
    {
        require_once "repository/BarRepository.php";
        $reop = new BarRepository();
        $bars = $reop->findAll();
        $activeMenu = "pincho";

        include "view/Pincho/search.php";
    }

    function searchQuery($page = 1, $amount = 1)
    {
        $repo = new PinchoRepository();

        $offset = ($page - 1) * $amount;

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($repo->search($offset, $amount, isset($_POST["name"]) ? $_POST["name"] : "", isset($_POST["bar_name"]) ? $_POST["bar_name"] : "", isset($_POST["minRating"]) ? $_POST["minRating"] : 0, isset($_POST["maxRating"]) ? $_POST["maxRating"] : 5));
    }

    function searchTotal()
    {
        $repo = new PinchoRepository();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($repo->searchTotal(isset($_POST["name"]) ? $_POST["name"] : "", isset($_POST["bar_name"]) ? $_POST["bar_name"] : "", isset($_POST["minRating"]) ? $_POST["minRating"] : 0, isset($_POST["maxRating"]) ? $_POST["maxRating"] : 5));
    }

    function completeJson($pk, $return = false)
    {
        $repo = new PinchoRepository();

        require_once "repository/ReviewRepository.php";
        $reviewRepo = new ReviewRepository();


        $images = $repo->getImages($pk);

        $info = [
            "pincho" => $repo->find($pk),
            "multimedia" => $images,
            "reviews" => $reviewRepo->byPincho($pk)
        ];

        if ($return) {
            return (object) $info;
        }

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode($info);
    }

    public function images($id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $repo = new PinchoRepository();

        echo json_encode($repo->getImages($id));
    }
}
