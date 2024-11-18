<?php
require_once './libs/config.php';

class BookModel {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            "mysql:host=".MYSQL_HOST .
            ";dbname=".MYSQL_DB.";charset=utf8",
            MYSQL_USER, MYSQL_PASS);
            $this->deploy();

        }

        private function deploy() {
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();
            if(count($tables) == 0) {
                $sql ="
                CREATE TABLE `editorial` (
                    `ID_Editorial` int(11) NOT NULL,
                    `nombre` varchar(50) NOT NULL,
                    `pais` varchar(50) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

                CREATE TABLE `libro` (
                    `ID_Libro` int(11) NOT NULL,
                    `titulo` varchar(100) NOT NULL,
                    `autor` varchar(50) NOT NULL,
                    `genero` varchar(50) NOT NULL,
                    `precio` int(11) NOT NULL,

                    `descripcion` text NOT NULL,

                    `ID_Editorial` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
                ";
            $this->db->query($sql);
            }
        }
        
        // Obtiene todos los libros
        public function getBooks() {
            $query = $this->db->prepare('SELECT * FROM libro');
            $query->execute();
        
            // Retorna los datos en un arreglo de objetos
            $books = $query->fetchAll(PDO::FETCH_OBJ);
        
            return $books;
    }

    // Obtiene un libro por su ID
    public function getBookById($id) {
        $query = $this->db->prepare('SELECT * FROM libro WHERE ID_Libro = ?');
        $query->execute([$id]);
        
        return $query->fetch(PDO::FETCH_OBJ);
    }
    

    public function getBooksByEditorial($id_editorial) {
        $query = $this->db->prepare('SELECT libro.*, editorial.nombre AS editorial_nombre FROM libro JOIN editorial ON libro.ID_Editorial = editorial.ID_Editorial WHERE libro.ID_Editorial = ?');
        $query->execute([$id_editorial]);
    
        // Retorna los libros pertenecientes a la editorial en un arreglo de objetos
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertBook($titulo, $autor, $genero, $precio, $idEditorial, $descripcion) {
        $query = $this->db->prepare('INSERT INTO libro (titulo, autor, genero, precio, ID_Editorial, descripcion) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$titulo, $autor, $genero, $precio, $idEditorial, $descripcion]);
        var_dump($query->errorInfo());
    }

    // Eliminar un libro
    public function deleteBook($id) {
        $query = $this->db->prepare('DELETE FROM libro WHERE ID_Libro = ?');
        $query->execute([$id]);
    }

     // Actualizar un libro
    public function updateBook($titulo, $autor, $genero, $precio, $id, $idEditorial) {
        $query = $this->db->prepare("UPDATE libro SET titulo = ?, autor = ?, genero = ?, precio = ?, ID_Editorial = ? WHERE ID_Libro = ?");
        $query->execute([$titulo, $autor, $genero, $precio, $idEditorial, $id]);
    }
}
