<?php

require_once '../app/models/gruposModel.php';

class GruposController
{

    public function nuevoGrupo()
    {
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


    public function mostrarGrupos()
    {

        session_start();

        if (!isset($_SESSION['id_usuario'])) {
            header('Location: index.php?controller=home&action=home');
            exit();
        }
        $id_usuario = $_SESSION['id_usuario'];
        $modelo = new GruposModel();

        $grupos = $modelo->recuperarGrupos($id_usuario);
        if ($grupos) {
            include '../app/views/misGruposView.php';
        } else {
            echo " la consulta está mal";
        }
    }

}


?>