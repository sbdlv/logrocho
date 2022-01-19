<?php
class BarController{

    function index(){
        require_once "repository/BarRepository.php";
        $repo = new BarRepository();

        $bars = $repo->findAll();

        include "view/Bar/index.php";
    }
    
}