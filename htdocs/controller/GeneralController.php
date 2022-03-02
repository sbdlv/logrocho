<?php

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class GeneralController
{
    public function tokenSearch($searchText)
    {
        header('Content-Type: application/json; charset=utf-8');

        require_once "repository/BarRepository.php";
        require_once "repository/PinchoRepository.php";

        $barRepo = new BarRepository();
        $pinchoRepo = new PinchoRepository();
        $results = [
            "bars" => $barRepo->tokenSearch($searchText),
            "pinchos" => $pinchoRepo->tokenSearch($searchText),
        ];

        echo json_encode($results);
    }
}
