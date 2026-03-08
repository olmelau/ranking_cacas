<!-- Esto es el index de la aplicacion
 desde aqui controlaremos cada peticion de la aplicacion -->

<?php

//Sacamos el nombre del controlador da igual si viene por GET o por POST. 
//Posteriormente en cada controlador comprobaremos por donde viene si fuese un requisito (Por ejemplo, login tiene que ser POST).
//Cualquier error de autentificacion y la primera vez que se entra por defecto, lanza el home.
$controller = $_GET['controller'] ?? $_POST['controller'] ?? 'home';
$action = $_GET['action'] ?? $_POST['action'] ?? 'home';

$datos = []; //El array donde guardaremos los datos
//ESTE SE LLAMA DESPUES EN CADA CONTROLADOR.

//Un ejemplo de GET o POST que nos llega es el siguiente: index.php?controller=login&action=comprobar&id=1&nombre=juan&cod_participante=100
//Tenemos que recorrer todo lo que nos llega
//Arriba ya hemos guardado en la variable $controller el valor login
//Y en la variable Action el valor comprobar, que sera un metodo dentro de la clase loginController.
//Esto aplica a cualquier controlador, tiene que tener un metodo con el nombre del action.

foreach ($_GET as $key => $value) { //Recorremos todos los valores que nos vienen en la URL, guardando como clave valor.
    if (!in_array($key, ['controller', 'action'])) { //Esta linea es porque no queremos incluir controller ni action en el array datos, ya que los hemos almacenado a mano anteriormente.
        $datos[$key] = $value; //Importante guardarlo como array porque no sabemos cuantos valores pasaremos, pueden ser 2 como en el login o 25 como en un formulario.
    }
}

//Lo mismo si el method es POST.

foreach ($_POST as $key => $value) {
    if (!in_array($key, ['controller', 'action'])) {
        $datos[$key] = $value;
    }
}


// Construir nombre del archivo y clase
$controllerName = $controller . 'Controller'; 
$controllerFile = '../app/controllers/' . $controllerName . '.php';
//Esto nos permite que para ampliar podamos crear un controlador que acabe en Controller.php y lo encontrará siempre.

if(file_exists($controllerFile)) { //Comprueba que existe el archivo.
    require_once $controllerFile; //Y le hacemos require.
    
    // Crear instancia del controlador, sea el nombre que sea, siempre debe llamarse la clase, con el nombre del archivo.
    $controllerInstance = new $controllerName(); 
    
    //Comprobamos si tiene datos.
     if(!empty($datos)){ //Si no está vacio, es decir, que tiene.
        if(method_exists($controllerInstance, $action)) {
        $controllerInstance->$action($datos); //Se llama a ese controlador que sea, con el metodo que este en action, pasando un array.
        }
    } else if(method_exists($controllerInstance, $action)) { //Si esta vacio.
        $controllerInstance->$action(); //Es que es un metodo que no necesita datos, como puede ser imprimir un formulario.
    } else {
        die("Método $action no encontrado en $controllerName"); //Si no cumple ninguna de las dos, es que encontró el archivo pero no el metodo.
    }
} else {
    die("Controlador $controllerName no encontrado"); //No encontró el archivo.
    }
    
   


?>