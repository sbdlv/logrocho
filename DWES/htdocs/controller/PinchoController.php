<?php
class PinchoController
{

    function index($id = false)
    {
        require_once "repository/PinchoRepository.php";
        $repo = new PinchoRepository();
        
        $pinchos = $repo->findAll();
        $activeMenu = "pincho";
        include "view/Pincho/index.php";
    }
    
    function info($id){
        require_once "repository/PinchoRepository.php";
        $repo = new PinchoRepository();
        
        $pincho = $repo->find($id);
        $activeMenu = "pincho";
        include "view/Bar/info.php";
    }

    function alta(){
        if(isset($_POST[""], $_POST[""], $_POST[""], $_POST[""], $_POST[""])){

        }
    }

    function delete(){
        require_once "repository/BarRepository.php";
        $repo = new BarRepository();

        $B = new Bar();
        $B->id = 3;

        var_dump($repo->delete($B));
    }

    function json($page){
        header('Content-Type: application/json; charset=utf-8');
        
        require_once "repository/PinchoRepository.php";
        $repo = new PinchoRepository();

        echo json_encode($repo->findAll(0,1));
    }
}
