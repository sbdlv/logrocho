<?php
require_once "repository/UserRepository.php";
addToBreadCrumbs("Usuarios", getServerAbsPathForActions() . "user");

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class UserController
{
    private const AMOUNT_OF_RESULTS_PER_PAGE = 4;
    
    function index()
    {
        $activeMenu = "user";
        $repo = new UserRepository();
        $users = $repo->findAll();
        require "view/user/index.php";
    }
    
    function info($id)
    {
        $activeMenu = "user";
        addToBreadCrumbs("Usuario #$id");
        $repo = new UserRepository();
        $user = $repo->findById($id);
        require "view/user/info.php";
    }

    function login()
    {
        $this->redirectSession();
        
        if (isset($_POST["email"], $_POST["password"])) {
            //Comprobar credenciales
            require_once "repository/UserRepository.php";
            $repo = new UserRepository();
            
            //Comprobar requisitos de contraseña etc
            if (!preg_match("/^[a-z0-9]+@[a-z0-9]+\.[a-z]+$/i", $_POST["email"])) {
                $errorMsg = "No has introducido una dirección de email valida.";
            } else if (strlen($_POST["password"]) < 8) {
                $errorMsg = "No la contraseña debe tener una longitud minima de 8 caracteres.";
            } else if (!preg_match("/[a-z]+/", $_POST["password"])) {
                $errorMsg = "La contraseña debe de tener al menos una minúscula.";
            } else if (!preg_match("/[A-Z]+/", $_POST["password"])) {
                $errorMsg = "La contraseña debe de tener al menos una mayúscula.";
            } else if (!preg_match("/[0-9]+/", $_POST["password"])) {
                $errorMsg = "La contraseña debe de tener al menos un número.";
            } else if (!$repo->login($_POST["email"], $_POST["password"])) {
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
                $errorMsg = "No la contraseña debe tener una longitud minima de 8 caracteres.";
            } else if (!preg_match("/[a-z]+/", $_POST["password"])) {
                $errorMsg = "La contraseña debe de tener al menos una minúscula.";
            } else if (!preg_match("/[A-Z]+/", $_POST["password"])) {
                $errorMsg = "La contraseña debe de tener al menos una mayúscula.";
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
    
    private function redirectSession()
    {
        if (isset($_SESSION["logged"]) && $_SESSION["logged"]) {
            if ($_SESSION["user"]["admin"]) {
                header("Location: " . getServerAbsPathForActions() . "bar");
            } else {
                header("Location: index.php");
            }
        }
    }
    
    function alta()
    {
        if (isset($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["password"])) {
            $user = new User();
            
            $user->first_name = $_POST["first_name"];
            $user->last_name = $_POST["last_name"];
            $user->email = $_POST["email"];
            $user->password = $_POST["password"];
            
            //TODO: Incluir campo imagen etc
            
            $repo = new UserRepository();
            if ($repo->save($user)) {
                echo "Se ha dado de alta el usuario";
            } else {
                echo "Error: No se ha dado de alta el usuario";
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }
    
    function update()
    {
        if (isset($_POST["id"], $_POST["first_name"], $_POST["last_name"])) {
            $user = new User();
            
            $user->id = $_POST["id"];
            $user->first_name = $_POST["first_name"];
            $user->last_name = $_POST["last_name"];
            $user->email = $_POST["email"];
            $user->created_date = $_POST["created_date"];
            //$user->password = $_POST["password"];
            //TODO: Incluir campo imagen etc
            
            $repo = new UserRepository();
            if ($repo->update($user)) {
                echo "Se ha modificado el usuario";
            } else {
                echo "Error: No se ha modificado el usuario";
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }
    
    function delete()
    {
        if (isset($_POST["id"])) {
            $repo = new UserRepository();
            $user = new User();
            
            $user->id = $_POST["id"];
            
            if ($repo->delete($user)) {
                echo "Se ha borrado el usuario";
            } else {
                http_response_code(400);
                echo "Error: No se ha podido borrar el usuario";
            }
        } else {
            echo "Error: FALTAN campos POST";
        }
    }

    function jsonAll($page, $orderBy = false, $orderDir = false)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        $repo = new UserRepository();
        
        $offset = ($page - 1) * self::AMOUNT_OF_RESULTS_PER_PAGE;
        
        if ($orderBy && $orderDir) {
            echo json_encode($repo->findAll($offset, self::AMOUNT_OF_RESULTS_PER_PAGE, $orderBy, $orderDir));
        } else {
            echo json_encode($repo->findAll($offset, self::AMOUNT_OF_RESULTS_PER_PAGE));
        }
    }
    
    function json($id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $repo = new UserRepository();
        
        echo json_encode($repo->findById($id));
    }
    
    function completeDelete($id)
    {
        //isAdminForAPI();
        $repo = new UserRepository();
        $user = new User();
        $user->id = $id;

        if ($repo->removeLikes($id) && $repo->removeReviews($id) && $repo->delete($user)) {
            echo "Usuario + reseñas y likes eliminados";
        } else {
            echo "Error";
        }
    }
    
    function updateReview()
    {
        //isAdminForAPI();
        if (isset($_POST["user_id"], $_POST["review_id"], $_POST["title"], $_POST["desc"], $_POST["presentation"], $_POST["texture"], $_POST["taste"], $_POST["pincho_id"])) {
            $repo = new UserRepository();

            if ($repo->findById($_POST["user_id"])->admin) {
                http_response_code(400);
                echo "Error, el usuario a editar es administrador";
            } else {
                if ($repo->checkReviewOP($_POST["user_id"], $_POST["review_id"])) {
                    require "repository/ReviewRepository.php";
                    $repoReview = new ReviewRepository();
                    $review = new Review();
                    $review->id = $_POST["review_id"];
                    $review->user_id = $_POST["user_id"];
                    $review->title = $_POST["title"];
                    $review->desc = $_POST["desc"];
                    $review->presentation = $_POST["presentation"];
                    $review->texture = $_POST["texture"];
                    $review->taste = $_POST["taste"];
                    $review->pincho_id = $_POST["pincho_id"];

                    if ($repoReview->update($review)) {
                        echo "Reseña actualizada!";
                    } else {
                        http_response_code(400);
                        echo "Error al actualizar la reseña";
                    }
                } else {
                    http_response_code(400);
                    echo "Error: el usuario no es el autor de la reseña";
                }
            }
        } else {
            http_response_code(400);
            echo "Faltan campos POST";
        }
    }

    function deleteReview()
    {
        //isAdminForAPI();
        if (isset($_POST["user_id"], $_POST["review_id"])) {
            $repo = new UserRepository();

            if ($repo->findById($_POST["user_id"])->admin) {
                http_response_code(400);
                echo "Error, el usuario a editar es administrador";
            } else {
                if ($repo->checkReviewOP($_POST["user_id"], $_POST["review_id"])) {
                    require "repository/ReviewRepository.php";
                    $repoReview = new ReviewRepository();
                    $review = new Review();
                    $review->id = $_POST["review_id"];

                    if ($repoReview->delete($review)) {
                        echo "Reseña eliminada!";
                    } else {
                        http_response_code(400);
                        echo "Error al eliminar la reseña";
                    }
                } else {
                    http_response_code(400);
                    echo "Error: el usuario no es el autor de la reseña";
                }
            }
        } else {
            http_response_code(400);
            echo "Faltan campos POST";
        }
    }

    function deleteLikes($user_id)
    {
        //isAdminForAPI();
        $repo = new UserRepository();
        if ($repo->findById($user_id)->admin) {
            http_response_code(400);
            echo "Error, el usuario a editar es administrador";
        } else {
            if ($repo->removeLikes($user_id)) {
                echo "Likes del usuario eliminados!";
            } else {
                http_response_code(400);
                echo "Error al eliminar los likes del usuario";
            }
        }
    }

    function total()
    {
        header('Content-Type: application/json; charset=utf-8');
        $repo = new UserRepository();

        echo json_encode($repo->total());
    }

    //Public
    function profile($id)
    {
        $repo = new UserRepository();
        $user = $repo->findById($id);

        require_once "repository/ReviewRepository.php";
        $repoReview = new ReviewRepository();
        $reviews = $repoReview->byUser($id);

        
        $likedReviews = $repoReview->likedByUser($id);
        $dislikedReviews = $repoReview->dislikedByUser($id);

        require "view/user/profile.php";
    }

}
