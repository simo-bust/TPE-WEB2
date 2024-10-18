<?php
require_once './app/models/book_model.php';  // Modelo de libros
require_once './app/models/editorial_model.php';  // Modelo de editoriales
require_once './app/views/view.php';  // Clase de vistas

class EditorialController {
    private $bookModel;
    private $editorialModel;
    private $view;

    public function __construct() {
        $this->bookModel = new BookModel();  // Instancia del modelo de libros
        $this->editorialModel = new EditorialModel();  // Instancia del modelo de editoriales
        $this->view = new View();  // Instancia de la vista
    }

    // Mostrar todas las editoriales
    public function listEditorials() {
        $editorials = $this->editorialModel->getEditoriales();  // Obtener todas las editoriales
        $this->view->showListEditorials($editorials);  // Pasar las editoriales a la vista para mostrarlas
    }

    // Mostrar los libros que pertenecen a una editorial específica
    public function booksByEditorial($id_editorial) {
        $books = $this->bookModel->getBooksByEditorial($id_editorial);  // Obtener libros por editorial
        if ($books) {
            $this->view->showBooksByEditorial($books);  // Mostrar los libros en la vista
        } else {
            echo "No se encontraron libros para esta editorial";
        }
    }
}








