<?php

// Necesitamos el modelo de registro
require_once('../app/models/RegistroModel.php');

class RegistroController
{

    // Método para procesar el registro
    public function procesarRegistro($datos)
    {

        session_start();

        // Verificamos que el envío del formulario sea por POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Si alguien intenta acceder por GET, lo redirigimos al home
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        // Recogemos los datos del formulario
        $username = trim($datos['username'] ?? '');
        $email = trim($datos['email'] ?? '');
        $password = $datos['password'] ?? '';
        $confirm_password = $datos['confirm_password'] ?? '';

        // Validaciones básicas
        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            header('Location: index.php?controller=home&action=home&error=campos_vacios');
            exit();
        }

        // Validar formato de email (básico)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?controller=home&action=home&error=email_invalido');
            exit();
        }

        // Validar que las contraseñas coincidan
        if ($password !== $confirm_password) {
            header('Location: index.php?controller=home&action=home&error=password_no_coincide');
            exit();
        }

        // Validar longitud mínima de contraseña (opcional)
        if (strlen($password) < 4) {
            header('Location: index.php?controller=home&action=home&error=password_corta');
            exit();
        }

        // Creamos el modelo y registramos al usuario
        $modelo = new RegistroModel();
        $resultado = $modelo->registrarUsuario($username, $email, $password);

        // Procesamos el resultado
        if ($resultado['success']) {
            // Registro exitoso, redirigimos al dashboard
            header('Location: index.php?controller=dashboard&action=mostrarDashboard');
        } else {
            // Error en el registro, redirigimos con el tipo de error
            header('Location: index.php?controller=home&action=home&error=' . $resultado['error']);
        }
        exit();
    }

}
?>