<?php
require_once './app/views/view.php';
require_once './app/controllers/book_controller.php';
require_once './app/controllers/editorial_controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // Acción por defecto si no se envía ninguna

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else{
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
        $bookController->bookDetail($params[1]);
        break;
    case 'editorial':
        $editorialController->listEditorials();  // Asegúrate de llamar al método correcto
        break;
    case 'booksByEditorial':
        $editorialController->booksByEditorial($params[1]);  // Mostrar libros por editorial
        break;
    default:
        echo "404 Page Not Found";
        break;
}

