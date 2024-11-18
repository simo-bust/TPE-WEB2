<?php
require_once './app/models/book_model.php';  
require_once './app/models/editorial_model.php';  
require_once './app/views/view.php';  

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

     // Mostrar el formulario para agregar una nueva editorial
    public function showAddEditorialForm() {
        
        // Enviar las editoriales a la vista para el desplegable
        $this->view->showAddEditorialForm();
    }

    //
    public function addEditorial() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $nombre = $_POST['nombre'];
            $pais = $_POST['pais'];

            // Agregar editorial a la base de datos
            $this->editorialModel->insertEditorial($nombre,$pais);

            // Redirigir a la lista de editoriales después de agregar
            header('Location: ' . BASE_URL . 'editorial');
            exit();
        } else {
            $this->showAddEditorialForm();
        }
    }

    public function deleteEditorial() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editorial_id'])) {
            $idborrar = $_POST['editorial_id'];
            $this->editorialModel->deleteEditorial($idborrar); // Eliminar la editorial de la base de datos
            // Redirigir a la lista de editoriales después de eliminar
            header('Location: ' . BASE_URL . 'editorial');
            exit();
        } else {
            echo "Método no permitido";
        }
    }

    public function showEditEditorialForm($id) {
        $editorial = $this->editorialModel->getEditorialById($id); // Obtener la editorial por ID
        $this->view->showEditEditorialForm($editorial);
    }

    public function updateEditorial() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $pais = $_POST['pais'];

            // Actualizar editorial en la base de datos
            $this->editorialModel->updateEditorial($nombre,$pais,$id);

            // Redirigir a la lista de editoriales después de la actualización
            header('Location: ' . BASE_URL . 'editorial');
            exit();
        }
    }

}








