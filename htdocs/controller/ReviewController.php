<?php
require_once "repository/ReviewRepository.php";
addToBreadCrumbs("Reseñas", getServerAbsPathForActions() . "review");

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class ReviewController
{
    private const AMOUNT_OF_RESULTS_PER_PAGE = 4;

    function index($id = false)
    {
        $repo = new ReviewRepository();

        $reviews = $repo->findAll();
        $activeMenu = "review";
        include "view/Review/index.php";
    }

    function info($id)
    {
        $repo = new ReviewRepository();
        addToBreadCrumbs("Reseña #$id");
        $review = $repo->find($id);
        $activeMenu = "review";
        include "view/Review/info.php";
    }

    function alta()
    {
        if (isset($_POST["user_id"], $_POST["title"], $_POST["desc"], $_POST["presentation"], $_POST["texture"], $_POST["taste"], $_POST["pincho_id"])) {
            $review = new Review();

            $review->user_id = $_POST["user_id"];
            $review->title = $_POST["title"];
            $review->desc = $_POST["desc"];
            $review->presentation = $_POST["presentation"];
            $review->texture = $_POST["texture"];
            $review->taste = $_POST["taste"];
            $review->pincho_id = $_POST["pincho_id"];
            //TODO: Incluir campo imagen etc

            $repo = new ReviewRepository();
            if ($repo->save($review)) {
                echo "Se ha dado de alta la review";
            } else {
                echo "Error: No se ha dado de alta la review";
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }

    function update()
    {
        if (isset($_POST["id"], $_POST["user_id"], $_POST["title"], $_POST["desc"], $_POST["presentation"], $_POST["texture"], $_POST["taste"], $_POST["pincho_id"])) {
            $review = new Review();

            $review->id = $_POST["id"];
            $review->user_id = $_POST["user_id"];
            $review->title = $_POST["title"];
            $review->desc = $_POST["desc"];
            $review->presentation = $_POST["presentation"];
            $review->texture = $_POST["texture"];
            $review->taste = $_POST["taste"];
            $review->pincho_id = $_POST["pincho_id"];
            //TODO: Incluir campo imagen etc

            $repo = new ReviewRepository();
            if ($repo->update($review)) {
                echo "Se ha modificado la review";
            } else {
                echo "Error: No se ha modificado la review";
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }

    function delete()
    {
        if (isset($_POST["id"])) {
            $repo = new ReviewRepository();
            $review = new Review();

            $review->id = $_POST["id"];

            if ($repo->delete($review)) {
                echo "Se ha borrado la review";
            } else {
                http_response_code(400);
                echo "Error: No se ha podido borrar la review" . $review->id;
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }

    function jsonAll($page, $orderBy = false, $orderDir = false)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        $repo = new ReviewRepository();

        $offset = ($page - 1) * self::AMOUNT_OF_RESULTS_PER_PAGE;

        if($orderBy && $orderDir){
            echo json_encode($repo->findAll($offset, self::AMOUNT_OF_RESULTS_PER_PAGE, $orderBy, $orderDir));
        } else {
            echo json_encode($repo->findAll($offset, self::AMOUNT_OF_RESULTS_PER_PAGE));
        }
    }

    function json($id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $repo = new ReviewRepository();

        echo json_encode($repo->find($id));
    }
}
