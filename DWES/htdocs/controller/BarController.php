<?php
class BarController
{

    function index($id = false)
    {
        require_once "repository/BarRepository.php";
        $repo = new BarRepository();
        
        $bars = $repo->findAll();
        $activeMenu = "bar";
        include "view/Bar/index.php";
    }
    
    function info($id){
        require_once "repository/BarRepository.php";
        $repo = new BarRepository();
        
        $bar = $repo->find($id);
        $activeMenu = "bar";
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
        
        require_once "repository/BarRepository.php";
        $repo = new BarRepository();

        echo json_encode($repo->findAll(0,1));
    }
}
