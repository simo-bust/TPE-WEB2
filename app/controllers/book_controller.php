<?php
require_once  './app/models/book_model.php';
require_once  './app/views/view.php';

class BookController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new BookModel();
        $this->view = new View();
    }

    // Listar todos los libros
    public function listBooks() {
        $books = $this->model->getBooks(); // Obtener libros desde el modelo
        $this->view->showListBooks($books);    // Pasar los libros a la vista para que los muestre
    }

    // Mostrar el detalle de un libro por ID
    public function bookDetail($id) {
        $book = $this->model->getBookById($id); // Obtener libro específico
        if ($book) {
            $this->view->showBookDetail($book); // Método para mostrar detalles (crear en la vista)
        } else {
            echo "Libro no encontrado";
        }
    }
}






