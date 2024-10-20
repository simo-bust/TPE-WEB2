<?php
require_once './app/models/book_model.php';
require_once './app/models/editorial_model.php'; // Ahora incluimos el modelo de Editorial
require_once './app/views/view.php';

class BookController {
    private $bookModel;
    private $editorialModel; // Agregamos una propiedad para el modelo de Editorial
    private $view;

    public function __construct() {
        $this->bookModel = new BookModel();
        $this->editorialModel = new EditorialModel(); // Inicializamos el modelo de Editorial
        $this->view = new View();
    }

    // Listar todos los libros
    public function listBooks() {
        // Verifica si se ha enviado una solicitud POST para eliminar un libro
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
            $this->BookDelete($_POST['book_id']); // Elimina el libro
        }
    
        // Obtener libros desde el modelo
        $books = $this->bookModel->getBooks(); 
        // Pasar los libros a la vista para que los muestre
        $this->view->showListBooks($books);
    }

    public function bookDetail($id) {
        $book = $this->bookModel->getBookById($id); // Obtener libro específico
        if ($book) {
            // Obtener la editorial usando el ID de la editorial del libro
            $editorial = $this->editorialModel->getEditorialById($book->ID_Editorial);
            
            // Pasar tanto el libro como la editorial a la vista
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
            $descripcion = $_POST['descripcion']; // Asegúrate de capturar la descripción

            // Agregar libro a la base de datos
            $this->bookModel->insertBook($titulo, $autor, $genero, $precio, $idEditorial, $descripcion);

            // Redirigir a la lista de libros después de agregar
            header('Location: ' . BASE_URL . 'home');
            exit();
        } else {
            // Si no se envía POST, simplemente mostrar el formulario
            $this->showAddBookForm();
        }
    }

    public function BookDelete($id) {
        $this->bookModel->deleteBook($id); // Eliminar libro de la base de datos
        // No es necesario hacer nada aca, ya que listBooks se encargará de mostrar la lista actualizada.
    }

    public function showEditBookForm($id) {
        $book = $this->bookModel->getBookById($id); // Obtener el libro por ID
        $editorials = $this->editorialModel->getEditoriales(); // Obtener todas las editoriales
        $this->view->showEditBookForm($book, $editorials); // Mostrar vista de formulario de edición
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