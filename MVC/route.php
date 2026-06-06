<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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


switch ($method) {
    case 'GET':
        switch ($request) {

            case '/':
                require_once 'controllers/HomeController.php';
                break;

            case '/home':
                require_once 'controllers/HomeController.php';
                break;

            case '/galeria':
                require_once 'controllers/GaleriaController.php';
                break;

            default:
                echo "Página no encontrada";
                break;
        }
    break;
    
    case 'POST':
        switch ($request) {

           
            default:
            echo "Error, método no permitido";
            break;
        }
    break;

    default:
        echo "Error, método no permitido";
        break;
}