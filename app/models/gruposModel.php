<?php

//llamo a la conexion de la base de datos
require_once ('../config/connDB.php');

class GruposModel{

    private $db;

    public function __construct() {
        $this->db =  ConnBD::conexion();
    }

   public function crearGrupo($nombre, $descripcion, $password, $creado_por) {
    $sql = "INSERT INTO grupos (nombre_grupo, descripcion, password, creado_por) 
            VALUES (:nombre, :descripcion, :password, :creado_por)";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion); //no pasa nada si viene null
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':creado_por', $creado_por);
    
    return $stmt->execute();
}

   

    public function eliminarGrupo(){

    }

    public function recuperarGrupos(){

    }

     public function insertarUsuarioAGrupo(){
        
    }

    public function eliminarUsuarioDelGrupo(){

    }


}


?>