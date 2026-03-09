<?php

//necesito loginModel
require_once ('../app/models/LoginModel.php');

class loginController{
    
    //metodo para procesar login
    public function procesarLogin($datos){
        session_start();
        
        //Verificamos que el envio del fromulario sea por POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Si alguien intenta acceder por GET, lo redirigimos al home
            // Para iniciar sesión siempre tiene que ser POST
            header('Location: index.php?controller=home&action=home');
            exit(); 
        }

        //De los datos que nos llegan por parametros, sacamos la info del usuario
        //en este caso: $user y $email
        //La lógica de guardar en el array datos es del Index.
        
        $username = $datos['username'];
        $email = $datos['email'];
        $password = $datos['password'];

        $modelo = new LoginModel();
        $id_usuario = $modelo->buscarUsuario($username, $email, $password);

        if($id_usuario){
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            header('Location: index.php?controller=dashboard&action=mostrarDashboard');
            } else {
                header('Location: index.php?controller=home&action=home');
        }
    }

    //metodo para cerrar sesion
     public function logout()
    {
        session_start();
        // Destruir SESIÓN COMPLETAMENTE
        $_SESSION = []; // Vaciar array de sesión

        // Destruir la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destruir la sesión
        session_destroy();

        // Redirigir al home
        header('Location: index.php?controller=home&action=home');
        exit();
    }
}