<?php

require_once('../config/connDB.php');

class LoginModel
{

    private $db;

    public function __construct()
    {
        $this->db = ConnBD::conexion();
    }


    public function buscarUsuario($username, $email, $password)
    {

        $sql = "SELECT id_usuario FROM usuarios 
            WHERE username = :username AND email = :email AND password = :password";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();

        $usuario = $stmt->fetch();

        return $usuario[0]; //saca directamente el primer valor del array que es el que necesito (id_usuario).
    }


}


?>