<?php
require_once './libs/response.php';
require_once './app/views/view.php';
require_once './app/controllers/book_controller.php';
require_once './app/controllers/editorial_controller.php';
require_once './app/controllers/login_controller.php';
require_once './app/middlewares/sessionStatus.php';


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);

// Crear instancia del controlador
$bookController = new BookController();
$editorialController = new EditorialController();
$loginController = new UserController();

switch ($params[0]) {
    case 'home':
        $bookController->listBooks();
        break;
    case 'detail':
        if (isset($params[1])) {
            $bookController->bookDetail($params[1]);
        } else {
            echo "ID de libro no proporcionado";
        }
        break;
    case 'editorial':
        $editorialController->listEditorials();
        break;
    case 'booksByEditorial':
        if (isset($params[1])) {
            $editorialController->booksByEditorial($params[1]);
        } else {
            echo "ID de editorial no proporcionado";
        }
        break;
    case "addBook":
        sessionStatus($res);
        $bookController->addBook();
        break;
    case "editBook":
        sessionStatus($res);
        if (isset($params[1])) {
            $bookController->showEditBookForm($params[1]); // Mostrar formulario de edición
        } else {
            echo "ID de libro no proporcionado para edición";
        }
        break;
    case "updateBook":
        sessionStatus($res);
        $bookController->updateBook(); // Actualizar libro
        break;
    case "deleteBook":
        sessionStatus($res); 
        $bookController->deleteBook(); // Llama a la función para eliminar el libro
        break;    
    case 'login':
        $loginController->showLogin();
        break;
    case 'auth':
        $loginController->login();
        break;
    case 'logout':
        sessionStatus($res);
        $loginController->logout();
        break;
    default:
        echo "404 Page Not Found";
        break;
}


