<?php

session_start();


/**
 * La lógica de homeController es simplemente imprimir la vista sin acceso a la web.
 * Y dentro de esa vista está el formulario de Login o de registro que llamará a loginController o a registroController cuando se envie.
 */
class HomeController{

    public function home(){
        require_once '../app/views/homeView.php';
    }
}