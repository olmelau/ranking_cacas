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
    // $stmt->bindParam(':id_grupo', $id_grupo, PDO::PARAM_INT);
    // $stmt->execute();
    return $stmt->execute();
    
    // Si no afectó ninguna fila, es que no existía → INSERT
    // if ($stmt->rowCount() == 0) {
    //     $sql2 = "INSERT INTO contador_cacas (id_usuario, id_grupo, total_cacas) 
    //              VALUES (:id_usuario, :id_grupo, 1)";
    //     $stmt2 = $this->db->prepare($sql2);
    //     $stmt2->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    //     $stmt2->bindParam(':id_grupo', $id_grupo, PDO::PARAM_INT);
    //     return $stmt2->execute();
    }
    


    public function eliminarCaca(){
        //este metodo borrara la ultima caca registrada
    }

    
}



?>