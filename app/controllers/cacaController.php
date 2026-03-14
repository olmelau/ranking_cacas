<?php
require_once '../app/models/cacaModel.php';

class CacaController
{
    public function sumarCaca()
    {
        session_start();
        
        // Verificar que sea POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }
        
        // Verificar que el usuario está logueado
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: index.php?controller=home&action=home');
            exit();
        }
        
        // Obtener ID de usuario de la sesión
        $id_usuario = $_SESSION['id_usuario'];
        
        // Llamar al modelo para sumar a TODOS los grupos
        $modelo = new CacaModel();
        $modelo->registrarCaca($id_usuario);  

        // Redirigir de vuelta al dashboard
        header('Location: index.php?controller=dashboard&action=mostrarDashboard');
        exit();
    }
}
?>