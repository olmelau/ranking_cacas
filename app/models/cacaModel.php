<?php 

//llamo a la conexion de la base de datos
require_once ('../config/connDB.php');

class CacaModel{

    private $db;

    public function __construct(){
        $this->db = ConnBD::conexion();

    } 

    public function registrarCaca($id_usuario) {
    // Intentar actualizar primero
    $sql = "UPDATE contador_cacas 
            SET total_cacas = total_cacas + 1 
            WHERE id_usuario = :id_usuario";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    return $stmt->execute();
    
    }
    


    public function eliminarCaca(){
        //este metodo borrara la ultima caca registrada
    }

    
}



?>