<?php

require_once '../app/models/gruposModel.php';

class GruposController
{

    public function nuevoGrupo(){
        require_once '../app/views/nuevoGrupoView.php';
        
    }

    public function registrarGrupo($datos)
    {
        session_start();
        $id_usuario = $_SESSION['id_usuario'];

        $nombre = $datos['nombre_grupo'];
        $descripcion = $datos['descripcion'] ?? null; // Si viene vacío, guarda NULL
        $password = $datos['password'];
        $creado_por = $id_usuario;

        $modelo = new GruposModel();
        $resultado = $modelo->crearGrupo($nombre, $descripcion, $password, $creado_por);
        
        if ($resultado) {
            header('Location: index.php?controller=grupos&action=mostrarGrupos');
        } else {
            header('Location: index.php?controller=grupos&action=nuevoGrupo&error=error_bd');
        }
        exit();
    }


    public function mostrarGrupos(){
        echo "Grupo creado ok ---PRUEBAS";
    }

}


?>