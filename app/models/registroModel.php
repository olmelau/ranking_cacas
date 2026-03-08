<?php

//llamo a la conexion de la base de datos
require_once ('../config/connDB.php');

class RegistroModel{


    private $db;

    public function __construct() {

        $this->db = ConnBD::conexion();
    }

    public function registrarUsuario($username, $email, $password){

        //1. comprobar si el email existe
        $sql = "SELECT id_usuario FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->fetch()) {
            return [
                'success' => false,
                'error' => 'email_existe',
                'mensaje' => 'El email ya está registrado'
            ];
        }

        // 2. Comprobar si el username ya existe
        $sql = "SELECT id_usuario FROM usuarios WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->fetch()) {
            return [
                'success' => false,
                'error' => 'username_existe',
                'mensaje' => 'El nombre de usuario ya existe'
            ];
        }


         // 3. Insertar nuevo usuario
        $sql = "INSERT INTO usuarios (username, email, password) 
                VALUES (:username, :email, :password)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return [
                'success' => true,
                'error' => null,
                'mensaje' => 'Usuario registrado correctamente',
                // Cuando se hace un INSERT con PDO, puedes obtener el ID autogenerado así:
                'id_usuario' => $this->db->lastInsertId()
            ];
        } else {
            return [
                'success' => false,
                'error' => 'error_bd',
                'mensaje' => 'Error al guardar en la base de datos'
            ];
        }
    
    }
}