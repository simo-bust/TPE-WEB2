<?php
class EditorialModel {
    private $db;

    public function __construct() {
        // Conexión a la base de datos usando PDO
        $this->db = new PDO('mysql:host=localhost;dbname=libreria_tudai;charset=utf8', 'root', '');
        // Configuración para mostrar errores
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Obtiene todas las editoriales
    public function getEditoriales() {
        $query = $this->db->prepare('SELECT * FROM editorial');
        $query->execute();
    
        // Retorna los datos en un arreglo de objetos
        $editoriales = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $editoriales;
    }

    // Obtiene los libros por editorial
    public function getLibrosByEditorial($id_editorial) {
        $query = $this->db->prepare('SELECT * FROM libro WHERE ID_Editorial = ?');
        $query->execute([$id_editorial]);
    
        // Retorna los datos en un arreglo de objetos
        $libros = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $libros;
    }
}
?>
