<?php 

//llamo a la conexion de la base de datos
require_once ('../config/connDB.php');

class CacaModel{

    private $db;

    public function __construct(){
        $this->db = ConnBD::conexion();

    }

    public function buscarSiExisteUser($id_usuario, $id_grupo){
        $sql = "SELECT COUNT(*) FROM 
                grupos_usuarios WHERE id_grupo = :id_grupo AND id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_grupo", $id_grupo);
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
    

    public function registrarCaca(){
        $sql = 'INSERT INTO contador_cacas VALUES (id_usuario, id_grupo, total_cacas)';
    }

    public function eliminarCaca(){
        //este metodo borrara la ultima caca registrada
    }

    
}



?>