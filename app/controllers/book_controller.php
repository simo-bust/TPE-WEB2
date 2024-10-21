<?php
require_once './app/models/book_model.php';
require_once './app/models/editorial_model.php';
require_once './app/views/view.php';

class BookController {
    private $bookModel;
    private $editorialModel; 
    private $view;

    public function __construct() {
        session_start(); 
        $this->bookModel = new BookModel();
        $this->editorialModel = new EditorialModel();
        $this->view = new View();
    }
    
     // Listar libros
    public function listBooks() {
        // Obtener libros desde el modelo
        $books = $this->bookModel->getBooks();
        
        // Pasar los libros y el estado de sesión a la vista
        $this->view->showListBooks($books);
    }

    public function bookDetail($id) {
        $book = $this->bookModel->getBookById($id); // Obtener libro específico
        if ($book) {
            // Obtener la editorial usando el ID de la editorial del libro
            $editorial = $this->editorialModel->getEditorialById($book->ID_Editorial);
            
            $this->view->showBookDetail($book, $editorial);
        } else {
            echo "Libro no encontrado";
        }
    }

    // Mostrar el formulario para agregar un nuevo libro
    public function showAddBookForm() {
        // Obtener las editoriales desde el modelo
        $editorials = $this->editorialModel->getEditoriales();
        
        // Enviar las editoriales a la vista para el desplegable
        $this->view->showAddBookForm($editorials);
    }

    // Agregar un nuevo libro
    public function addBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $genero = $_POST['genero'];
            $precio = $_POST['precio'];
            $idEditorial = $_POST['idEditorial'];
            $descripcion = $_POST['descripcion'];

            // Agregar libro a la base de datos
            $this->bookModel->insertBook($titulo, $autor, $genero, $precio, $idEditorial, $descripcion);

            // Redirigir a la lista de libros después de agregar
            header('Location: ' . BASE_URL . 'home');
            exit();
        } else {
            $this->showAddBookForm();
        }
    }

    public function deleteBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
            $id = $_POST['book_id'];
            $this->bookModel->deleteBook($id); // Eliminar libro de la base de datos
            // Redirigir a la lista de libros después de eliminar
            header('Location: ' . BASE_URL . 'home');
            exit();
        } else {
            echo "Método no permitido";
        }
    }

    public function showEditBookForm($id) {
        $book = $this->bookModel->getBookById($id); // Obtener el libro por ID
        $editorials = $this->editorialModel->getEditoriales(); // Obtener todas las editoriales
        $this->view->showEditBookForm($book, $editorials);
    }

    // Actualizar un libro
    public function updateBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $genero = $_POST['genero'];
            $precio = $_POST['precio'];
            $idEditorial = $_POST['idEditorial'];

            // Actualizar libro en la base de datos
            $this->bookModel->updateBook($titulo, $autor, $genero, $precio, $id, $idEditorial);

            // Redirigir a la lista de libros después de la actualización
            header('Location: ' . BASE_URL . 'home');
            exit();
        }
    }

}