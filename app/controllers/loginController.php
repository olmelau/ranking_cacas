<?php

//necesito loginModel
require_once ('../app/models/LoginModel.php');


class loginController{

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

        $modelo = new LoginModel();
        $id_usuario = $modelo->buscarUsuario($username, $email);

        if($id_usuario){
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['email'] = $email;

            header('Location: index.php?controller=dashboard&action=mostrarDashboard');
            } else {
                header('Location: index.php?controller=home&action=home');
        }
    }

}