<?php
require_once './app/views/view.php';
require_once './app/controllers/book_controller.php';
require_once './app/controllers/editorial_controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // Acción por defecto si no se envía ninguna

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

// tabla de ruteo
$params = explode('/', $action);

// Crear instancia del controlador
$bookController = new BookController();
$editorialController = new EditorialController();

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
        $bookController->addBook();
        break;
    case "editBook":
        if (isset($params[1])) {
            $bookController->showEditBookForm($params[1]); // Mostrar formulario de edición
        } else {
            echo "ID de libro no proporcionado para edición";
        }
        break;
    case "updateBook":
        $bookController->updateBook(); // Actualizar libro
        break;
    default:
        echo "404 Page Not Found";
        break;
}


