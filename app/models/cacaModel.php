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
    $stmt->execute();

    $sql2 = "UPDATE grupos_usuarios
        SET cacas_user_grupo = cacas_user_grupo + 1 
        WHERE id_usuario = :id_usuario";

    $stmt = $this->db->prepare($sql2);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    $stmt->execute();

    $sql3= "UPDATE grupos
        SET total_cacas = 
            (SELECT SUM(cacas_user_grupo) 
            FROM grupos_usuarios
            WHERE id_grupo = 
                    (SELECT id_grupo
                    FROM grupos_usuarios
                    WHERE id_usuario = :id_usuario)
            )";
    $stmt = $this->db->prepare($sql3);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    return $stmt->execute();
    }
    


    public function eliminarCaca(){
        //este metodo borrara la ultima caca registrada
    }

    
}



?>