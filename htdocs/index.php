<?php
include_once "db.php";
require "functions.php";
require "templates.php";

header('Access-Control-Allow-Origin: *');

//require "vendor/autoload.php";
session_start();

//Ruta home web
$home = get_root_url() . "/";

//Quito la home de la ruta de la barra de direcciones
$ruta = str_replace($home, "", urldecode($_SERVER["REQUEST_URI"]));

//Creo el array de ruta (filtrando los vacios)
$array_ruta = array_filter(explode("/", $ruta));

//Si estamos accediente a un controlador, lo cargamos, si no, vamos a una ruta por defecto
if (isset($array_ruta[0])) {
    $modelName = $array_ruta[0]; //Ej.: Categoria -> index.php/Categoria

    //Para soportar sistemas case sensitive, convertimos el string con primera en mayus. el testo en minus.
    $modelName = ucfirst(strtolower($modelName));

    //Obtenemos los path dinamicamente de los ficheros del controlador y modelo
    $controllerPath = "controller/$modelName" . "Controller.php";
    $modelPath = "model/$modelName" . ".php";

    //Llamada al controlador
    if (file_exists($controllerPath)) {

        //Cargamos el fichero del controlador
        require $controllerPath;

        //Cargar el modelo (A veces puede llegar a no ser necesario)
        if (file_exists($modelPath)) {
            require_once $modelPath;
        }

        //Instanciar el controlador dinamicamente
        $controllerClass = "$modelName" . "Controller";
        $controller = new $controllerClass;

        //Procesamos la función, si no tiene, llamamos a index
        if (isset($array_ruta[1])) {
            //Cogemos la función a llamar del controlador
            $controllerFunction =  $array_ruta[1];

            //Comprobamos si la funcion es publica (Por seguridad, las funciones publicas solo serán aquellas a las que el usuario pueden acceder)
            //Mediante get_class_methods, evitamos que se pueda llamar a funciones heredadas como toString(), constructores etc
            if (in_array($controllerFunction, get_class_methods($controllerClass))) {
                $reflectionFunction = new ReflectionMethod($controller, $controllerFunction);

                //Solo se permite llamar a metodos publicos (Los privados serán de uso interno)
                if ($reflectionFunction->isPublic()) {
                    //Se han pasado parametros barra: / (Ej.: Categoria/show/356a192b7913b)
                    if (count($array_ruta) > 2) {
                        //Pasar argumentos a la acción a un array
                        $args = array_slice($array_ruta, 2);

                        //Llamamos dinamicamente a la funcion del controlador, pasandole los argumentos
                        call_user_func_array([$controller, $controllerFunction], $args);
                    } else {
                        //Como no hay argumentos, llamamos a la función sin más
                        try {
                            $controller->$controllerFunction();
                        } catch (\ArgumentCountError  $th) {
                            //Se ha llamado a una función que necesitaba parámetros, pero sin parámetros
                            include "404.php";
                        }
                    }
                } else {
                    include "404.php";
                }
            } else {
                //Pass the string as an index argument
                $controller->index($controllerFunction);
            }
        } else {
            try {
                $controller->index();
            } catch (\ArgumentCountError  $th) {
                //Se ha llamado a una función que necesitaba parámetros, pero sin parámetros
                include "404.php";
            }
        }
    } else {
        //Si no existe el controlador, mostrar una web de error genérica
        include "404.php";
    }
} else {
    //Ruta por defecto

    include "repository/ReviewRepository.php";
    $reviewRepo = new ReviewRepository();

    include "repository/PinchoRepository.php";
    $pinchoRepo = new PinchoRepository();

    $best5 = $pinchoRepo->findAllOrderByRating(5);

    if(is_logged()){
        $fav5 = $pinchoRepo->findAllOrderByUserRating($_SESSION["user"]["id"], 5);
    }

    $lastPinchos = $pinchoRepo->last(5);
    $bestReviews = $reviewRepo->findAllOrderByRating(5);

    include "view/index.php";
}
