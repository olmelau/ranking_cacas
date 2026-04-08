<?php
// Headers básicos para API
header("Access-Control-Allow-Origin: http://localhost:4200"); // La URL de tu Angular
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

// Manejar peticiones OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Obtener el método HTTP
$metodo = $_SERVER['REQUEST_METHOD'];

// Inicializar variables
$controller = 'home';
$action = 'home';
$parametros = [];

// Switch para manejar diferentes métodos HTTP
switch ($metodo) {
    case 'GET':
        $controller = $_GET['controller'] ?? 'home';
        $action = $_GET['action'] ?? 'home';
        $parametros = $_GET;
        break;
        
    case 'POST':
        // Verificar el Content-Type
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        
        if (strpos($contentType, 'application/json') !== false) {
            // Si es JSON (para API/Angular)
            $json = file_get_contents('php://input');
            $datos = json_decode($json, true) ?? [];
        } else {
            // Si es form-data (para formularios HTML)
            $datos = $_POST;
        }
        
        $controller = $datos['controller'] ?? 'home';
        $action = $datos['action'] ?? 'home';
        
        unset($datos['controller']);
        unset($datos['action']);
        
        $parametros = $datos;
        break;
}

// Cargar controlador
$controllerName = $controller . 'Controller';
$controllerFile = '../app/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerInstance = new $controllerName();
    
    // Ejecutar acción
    if (method_exists($controllerInstance, $action)) {
        // Pasar los parámetros al método
        var_dump($controller, $action, $parametros);
        $controllerInstance->$action($parametros);
    } else {
        http_response_code(404);
        echo "Acción no encontrada: " . $action;
    }
} else {
    http_response_code(404);
    echo "Controlador no encontrado: " . $controllerName;
    echo "<br>Archivo buscado: " . $controllerFile;
    
}
?>