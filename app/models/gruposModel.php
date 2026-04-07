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

            // 2. Insertar al creador en grupos_usuarios como admin
            $sql_relacion = "INSERT INTO grupos_usuarios (id_usuario, id_grupo, rol) 
                             VALUES (:id_usuario, :id_grupo, 'admin')";

            $stmt2 = $this->db->prepare($sql_relacion);
            $stmt2->bindParam(':id_usuario', $creado_por);
            $stmt2->bindParam(':id_grupo', $id_grupo);
            $stmt2->execute();

            // 3. Inicializar contador de cacas para este usuario en este grupo
            $sql_contador = "INSERT INTO contador_cacas (id_usuario, id_grupo, total_cacas) 
                             VALUES (:id_usuario, :id_grupo, 0)";

            $stmt3 = $this->db->prepare($sql_contador);
            $stmt3->bindParam(':id_usuario', $creado_por);
            $stmt3->bindParam(':id_grupo', $id_grupo);
            $stmt3->execute();

            // Si todo ha ido bien, confirmamos la transacción
            $this->db->commit();

            return $id_grupo; // Devolvemos el ID del grupo creado

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

    public function insertarUsuarioAGrupo()
    {

    }

    public function eliminarUsuarioDelGrupo()
    {

    }


}


?>