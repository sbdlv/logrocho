<?php
require_once "repository/PinchoRepository.php";

class PinchoController
{
    private const AMOUNT_OF_RESULTS_PER_PAGE = 4;

    function index($id = false)
    {        
        $repo = new PinchoRepository();
        
        $pinchos = $repo->findAll();
        $activeMenu = "pincho";
        include "view/Pincho/index.php";
    }
    
    function info($id){
        $repo = new PinchoRepository();
        
        $pincho = $repo->find($id);
        $activeMenu = "pincho";
        include "view/Pincho/info.php";
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
        if (isset($_POST["id"], $_POST["bar_id"], $_POST["name"])) {
            $pincho = new Pincho();

            $pincho->id = $_POST["id"];
            $pincho->bar_id = $_POST["bar_id"];
            $pincho->name = $_POST["name"];
            //TODO: Incluir campo imagen etc

            $repo = new PinchoRepository();
            if ($repo->update($pincho)) {
                echo "Se ha modificado el pincho";
            } else {
                echo "Error: No se ha modificado el pincho";
            }
        } else {
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

    function jsonAll($page){
        header('Content-Type: application/json; charset=utf-8');
              
        $repo = new PinchoRepository();

        $offset = ($page - 1) * self::AMOUNT_OF_RESULTS_PER_PAGE;

        echo json_encode($repo->findAll($offset, self::AMOUNT_OF_RESULTS_PER_PAGE));
    }

    function json($id){
        header('Content-Type: application/json; charset=utf-8');

        $repo = new PinchoRepository();

        echo json_encode($repo->find($id));
    }
}
