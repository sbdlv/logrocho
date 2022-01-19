<?php

class UserController
{

    function index()
    {
        $this->login();
    }

    function login()
    {
        $this->redirectSession();

        if (isset($_POST["email"], $_POST["password"])) {
            //Comprobar credenciales
            require_once "repository/UserRepository.php";
            $repo = new UserRepository();

            if (!$repo->login($_POST["email"], $_POST["password"])) {
                $errorMsg = "Clave o usuario incorrectos.";
            } else {
                $_SESSION["user"] = (array) $repo->find($_POST["email"]);
                $_SESSION["logged"] = true;

                $this->redirectSession();
            }
        }
        require "view/user/login.php";
    }

    function register()
    {
        $this->redirectSession();
        if (isset($_POST["email"], $_POST["password"])) {
            require_once "repository/UserRepository.php";

            //Comprobar requisitos de contraseña etc
            if (!preg_match("/^[a-z0-9]+@[a-z0-9]+\.[a-z]+$/i", $_POST["email"])) {
                $errorMsg = "No has introducido una dirección de email valida.";
            } else if (strlen($_POST["password"]) < 8) {
                $errorMsg = "No la contraseña debe tener una longitud minima de 8 carácteres.";
            } else if (!preg_match("/[a-z]+/", $_POST["password"])) {
                $errorMsg = "La contraseña debe de tener al menos una minúscula.";
            } else if (!preg_match("/[A-Z]+/", $_POST["password"])) {
                $errorMsg = "La contraseña debe de tener al menos una mayuscula.";
            } else if (!preg_match("/[0-9]+/", $_POST["password"])) {
                $errorMsg = "La contraseña debe de tener al menos un número.";
            } else {
                //Guardar en BD
                $repo = new UserRepository();

                $insert = $repo->save(
                    (object) [
                        "username" => explode("@", $_POST["email"])[0],
                        "email" => $_POST["email"],
                        "password" => $_POST["password"],
                    ]
                );

                //Informar
                if ($insert) {
                    $okMsg = "Se ha creado la cuenta.";
                } else {
                    $errorMsg = "Se ha producido un error al crear la cuenta.";
                }
            }
        }

        require "view/User/register.php";
    }

    function logout()
    {
        session_destroy();
        header("Location: " . getServerAbsPathForActions() . "user/login");
    }

    private function redirectSession(){
        if (isset($_SESSION["logged"]) && $_SESSION["logged"]) {
            if ($_SESSION["user"]["admin"]) {
                //TODO: Ir al backend
                require "view/admin/success.php";
            } else {
                //TODO: Ir al home page
                require "view/user/success.php";
            }

            //Temporal. Llegados a este punto, ya se habria hecho un Header location
            die;
        }
    }
}
