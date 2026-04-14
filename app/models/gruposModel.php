<?php

//llamo a la conexion de la base de datos
require_once('../config/connDB.php');

class GruposModel
{

    private $db;

    public function __construct()
    {
        $this->db = ConnBD::conexion();
    }
    /**
     * Crea un grupo y automáticamente asigna al creador como admin
     * return int|false ID del grupo creado o false si falla
     */
    public function crearGrupo($nombre, $descripcion, $password, $creado_por)
    {
        try {
            // Iniciar transacción (para que si falla algo no se quede a medias)
            $this->db->beginTransaction();

            var_dump($nombre);

            // 1. Insertar el grupo
            $sql_grupo = "INSERT INTO grupos (nombre_grupo, password, creado_por, total_cacas, fecha_registro, descripcion) 
                          VALUES (:nombre, :password, :creado_por, 0, CURRENT_TIMESTAMP, :descripcion)";

            $stmt = $this->db->prepare($sql_grupo);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':creado_por', $creado_por);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->execute();


            // Obtener el ID del grupo recién creado
            $id_grupo = $this->db->lastInsertId();

            var_dump($id_grupo);

            // 2. Insertar al creador en grupos_usuarios como admin
            $sql_relacion = "INSERT INTO grupos_usuarios (id_usuario, id_grupo, cacas_user_grupo, rol, fecha_union) 
                             VALUES (:id_usuario, :id_grupo, 0, 'admin', CURRENT_TIMESTAMP)";

            $stmt2 = $this->db->prepare($sql_relacion);
            $stmt2->bindParam(':id_usuario', $creado_por);
            $stmt2->bindParam(':id_grupo', $id_grupo);
            $stmt2->execute();

            $this->db->commit();

            return true; // Devolvemos el ID del grupo creado

        } catch (Exception $e) {
            // Si algo falla, deshacemos todos los cambios
            $this->db->rollBack();
            return false;
        }
    }



    public function eliminarGrupo()
    {

    }

    //este método busca los grupos a los que pertenece un usuario
    public function recuperarGrupos($id_usuario)
    {
        $sql = "SELECT g.*, gu.rol 
                FROM grupos g
                INNER JOIN grupos_usuarios gu ON g.id_grupo = gu.id_grupo
                WHERE gu.id_usuario = :id_usuario
                ORDER BY g.nombre_grupo ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertarUsuarioAGrupo($id_usuario, $nombreGrupo, $password)
    {
        try{
            $this->db->beginTransaction();

            $sql = "SELECT id_grupo
                    FROM grupos 
                    WHERE nombre_grupo = :nombre_grupo AND password = :password";
    
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":nombre_grupo", $nombreGrupo, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
    
            $stmt->execute();
    

            $id_grupo= $stmt->fetchColumn();
      
            //comprobamos que coincidan el nombre del grupo y la contraseña
            if ($id_grupo != false) {
    
                $sql2 = "INSERT INTO grupos_usuarios (id_usuario, id_grupo, cacas_user_grupo, rol, fecha_union) 
                         VALUES (:id_usuario, :id_grupo, 0, 'miembro', CURRENT_TIMESTAMP)";
                $stmt = $this->db->prepare($sql2);
                $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                $stmt->bindParam(":id_grupo", $id_grupo, PDO::PARAM_INT);
                
                $stmt->execute();
    
                $this->db->commit();
                
                return true;
    
    
            } else {
    

                echo "Fallo -> ";
                return false;
    
            }
        } catch (Exception $e){
             echo $e;

            $this->db->rollBack();
            return false;
        }





    }

    public function eliminarUsuarioDelGrupo()
    {

    }


}


?>