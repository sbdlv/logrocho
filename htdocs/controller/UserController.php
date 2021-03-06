<?php
require_once "repository/UserRepository.php";
add_to_breadcrumbs("Usuarios", get_server_index_base_url() . "user/list");

/**
 * @author Sergio Barrio <sergiobarriodelavega@gmail.com>
 */
class UserController
{
    private const AMOUNT_OF_RESULTS_PER_PAGE = 4;

    function list()
    {
        $activeMenu = "user";
        $repo = new UserRepository();
        $users = $repo->findAll();
        require "view/User/list.php";
    }

    function edit($id)
    {
        $activeMenu = "user";
        add_to_breadcrumbs("Usuario #$id");
        $repo = new UserRepository();
        $user = $repo->findById($id);
        require "view/User/edit.php";
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
        require "view/User/login.php";
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
                        "first_name" => explode("@", $_POST["email"])[0],
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
        header("Location: " . get_server_index_base_url() . "user/login");
    }

    private function redirectSession()
    {
        if (isset($_SESSION["logged"]) && $_SESSION["logged"]) {
            if ($_SESSION["user"]["admin"]) {
                header("Location: " . get_server_index_base_url() . "bar/list");
            } else {
                header("Location: " . get_server_index_base_url());
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

    function jsonAll($page, $resultsPerPage = 4, $orderBy = false, $orderDir = false)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        $repo = new UserRepository();

        $offset = ($page - 1) * $resultsPerPage;

        if ($orderBy && $orderDir) {
            echo json_encode($repo->findAll($offset, $resultsPerPage, $orderBy, $orderDir));
        } else {
            echo json_encode($repo->findAll($offset, $resultsPerPage));
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
        //is_admin_for_api();
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
        //is_admin_for_api();
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
        //is_admin_for_api();
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
        //is_admin_for_api();
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
    function profile()
    {
        if(!is_logged()){
            require "404.php";
            return;
        }
        
        $id = $_SESSION["user"]["id"];
        $activeMenu = "user";

        if ($id != $_SESSION["user"]["id"]) {
            require "404.php";
            die;
        }

        $repo = new UserRepository();
        $user = $repo->findById($id);

        require_once "repository/ReviewRepository.php";
        $repoReview = new ReviewRepository();
        $reviews = $repoReview->byUser($id);


        $likedReviews = $repoReview->likedByUser($id);
        $dislikedReviews = $repoReview->dislikedByUser($id);

        require "view/User/profile.php";
    }

    function update_profile()
    {
        if (!is_logged()) {
            http_response_code(400);
            echo "Primero necesitar iniciar sesión.";
            return;
        }

        if (isset($_POST["first_name"], $_POST["last_name"], $_POST["email"])) {
            $repo = new UserRepository();
            $user = $repo->findById($_SESSION["user"]["id"]);

            //Set new data
            $user->first_name = $_POST["first_name"];
            $user->last_name = $_POST["last_name"];
            $user->email = $_POST["email"];

            $repo->update($user);
            echo "OK";
        } else {
            http_response_code(400);
            echo "Faltan campos POST";
        }
    }

    function voteReview()
    {
        if (!is_logged()) {
            http_response_code(400);
            echo "Primero necesitar iniciar sesión.";
            return;
        }

        if (isset($_POST["isLike"], $_POST["review_id"])) {
            $repo = new UserRepository();
            if ($repo->voteReview($_SESSION["user"]["id"], $_POST["review_id"], $_POST["isLike"])) {
            } else {
                http_response_code(400);
                echo "No se ha podido votar la reseña";
            }
        } else {
            http_response_code(400);
            echo "Faltan campos POST";
        }
    }

    public function removeVote($review_id)
    {
        $review_id = intval($review_id);

        if (is_logged()) {
            $repo = new UserRepository();
            if ($repo->removeVote($_SESSION["user"]["id"], $review_id)) {
                echo "OK";
            } else {
                http_response_code(400);
                echo "No se ha podido eliminar tu voto. Intentalo de nuevo más tarde.";
            }
        } else {
            http_response_code(400);
            echo "Primero necesitar iniciar sesión.";
        }
    }

    public function deleteMyReview($review_id)
    {
        if (!is_logged()) {
            http_response_code(400);
            echo "Primero necesitar iniciar sesión.";
            return;
        }
        
        $repo = new UserRepository();

        require_once "repository/ReviewRepository.php";
        $repoReview = new ReviewRepository();

        if ($repo->checkReviewOP($_SESSION["user"]["id"], $review_id)) {
            if ($repoReview->delete((object) [
                "id" => $review_id
            ])) {
                echo "OK";
            } else {
                http_response_code(400);
                echo "No se ha podido borrar tu reseña";
            }
        } else {
            http_response_code(400);
            echo "No eres el autor de la reseña especificada";
        }
    }
}
