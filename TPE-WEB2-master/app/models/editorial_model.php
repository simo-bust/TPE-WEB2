<?php
require_once './libs/config.php';

class EditorialModel {
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

    public function getEditorialById($id_editorial) {
        $query = $this->db->prepare('SELECT * FROM editorial WHERE ID_Editorial = ?');
        $query->execute([$id_editorial]);
        return $query->fetch(PDO::FETCH_OBJ); // Retorna el objeto de la editorial
    }

    public function insertEditorial($nombre,$pais) {
        $query = $this->db->prepare('INSERT INTO editorial (nombre, pais) VALUES (?, ?)');
        $query->execute([$nombre, $pais]);
        var_dump($query->errorInfo());
    }

    public function deleteEditorial($idborrar) {
        $query = $this->db->prepare('DELETE FROM libro WHERE ID_Editorial = ?');
        $query->execute([$idborrar]);
        $query = $this->db->prepare('DELETE FROM editorial WHERE ID_Editorial = ?');
        $query->execute([$idborrar]);
    }

    public function updateEditorial($nombre, $pais, $idEditorial) {
        $query = $this->db->prepare("UPDATE editorial SET nombre = ?, pais = ? WHERE ID_Editorial = ?");
        $query->execute([$nombre, $pais, $idEditorial]);
    }

}
?>
