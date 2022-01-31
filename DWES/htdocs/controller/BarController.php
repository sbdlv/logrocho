<?php
require_once "repository/BarRepository.php";

class BarController
{
    private const AMOUNT_OF_RESULTS_PER_PAGE = 4;

    function index($id = false)
    {
        $repo = new BarRepository();

        $bars = $repo->findAll();
        $activeMenu = "bar";
        include "view/Bar/index.php";
    }

    function info($id)
    {
        $repo = new BarRepository();

        $bar = $repo->find($id);
        $activeMenu = "bar";
        include "view/Bar/info.php";
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
            if ($repo->save($bar)) {
                echo "Se ha dado de alta el bar";
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
            //TODO: Incluir campo imagen etc

            $repo = new BarRepository();
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
                echo "Error: No se ha podido borrar el bar";
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }

    function jsonAll($page)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        $repo = new BarRepository();

        $offset = ($page - 1) * self::AMOUNT_OF_RESULTS_PER_PAGE;

        echo json_encode($repo->findAll($offset, self::AMOUNT_OF_RESULTS_PER_PAGE));
    }

    function json($id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $repo = new BarRepository();

        echo json_encode($repo->find($id));
    }
}
