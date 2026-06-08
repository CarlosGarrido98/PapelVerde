<?php
require_once ("controllers/LoginController.php");
require_once ("models/UsuarioModel.php");

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

            case '/formulario':
                require_once 'views/formulario.php';
                break;

            case '/login':
                require_once 'views/login.php';
                break;

            case '/about':
                    require_once 'views/about.php';
                    break;

            case '/perfil':
                    require_once 'views/perfil.php';
                    break;
            
            case '/logout':
                LoginController::logout();
                break;


            case '/carrito/agregar':
                require_once 'controllers/CarritoController.php';
                CarritoController::agregar();
                break;  
            

            default:
                require_once 'views/404.php';
                break;
            
        }
        
    break;
    
    case 'POST':
        switch ($request) {

            case '/login':
                LoginController::procesarLogin();
                break;
            
            case '/registrarUsuario':
                require_once 'controllers/RegistroController.php';  


            default:
            echo "Error, método no permitido";
            break;
            
        }
        
    break;

    default:
        echo "Error, método no permitido";
        break;
}