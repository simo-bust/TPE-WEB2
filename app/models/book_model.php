<?php

class BookModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=libreria_tudai;charset=utf8', 'root', '');
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
    
        $book = $query->fetch(PDO::FETCH_OBJ);
    
        return $book;
    }

    public function getBooksByEditorial($id_editorial) {
        $query = $this->db->prepare('SELECT libro.*, editorial.nombre AS editorial_nombre FROM libro JOIN editorial ON libro.ID_Editorial = editorial.ID_Editorial WHERE libro.ID_Editorial = ?');
        $query->execute([$id_editorial]);
    
        // Retorna los libros pertenecientes a la editorial en un arreglo de objetos
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
