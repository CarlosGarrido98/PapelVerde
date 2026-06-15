<?php

require_once 'config/database.php';
require_once 'controllers/ProductoController.php';

// index.php

$method = $_SERVER["REQUEST_METHOD"];

// Obtener la URL solicitada
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Ejemplo de enrutamiento básico con switch
$script_dir = dirname($_SERVER['SCRIPT_NAME']);

// Eliminar el directorio del script de la URL solicitada
if ($script_dir !== '/') {
    $request = str_replace($script_dir, '', $request);
}

// Asegurar que siempre empiece con '/' y no termine en '/' (ej. de '/galeria/' a '/galeria')
$request = rtrim($request, '/');
if (empty($request)) {
    $request = '/';
}


// Enrutamiento según el método HTTP
switch ($method) {

// Rutas que responden a peticiones GET
    case 'GET':
        switch ($request) {

            // Reedirigir al Home
            case '/':

                $controller = new ProductoController($conexion);
                $controller->index();
                break;



            // Si no encuentra ningun resultado se va a la vista del error:404
            default:
                require_once 'views/404.php';
                break;
            
        }
        
    break;

    // Rutas que procesan formularios y envíos de datos
    case 'POST':
        switch ($request) {
            //Accedemos al Login 
            case '/login':
                LoginController::procesarLogin();
                break;
   
              
            
            default:
                echo "Error, método no permitido";
                break;
            
        }
        
        break;

        default:
        echo "Error, método no permitido";
        break;

    }
