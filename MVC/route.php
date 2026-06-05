<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// index.php

$method = $_SERVER["REQUEST_METHOD"];

// Obtener la URL solicitada
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Ejemplo de enrutamiento básico con switch


switch ($method) {
    case 'GET':

        switch ($request) {
            case '/':
                require_once 'views/home.php';
                break;
        
            case '/bienvenida':
                require_once 'views/Bienvenida.php';
                break;

            case '/otrapagina':
                require_once 'views/login.php';
                break;

            case '/registro':
                require_once 'views/Registro.php';
                break;

            default:
                http_response_code(404);
                require 'views/home.php';
                break;
        }

        break;

    case 'POST':
        switch ($request) {

            case'/comprobar':
                require_once 'controls/procesar.php';
                break;
        
            case '/insertarDatos':
                require_once 'controls/insertarDatos.php';
                break;

            case '/actualizarDatos':
                require_once 'controls/ActualizarDatos.php';
                break;
            
            }

            
    
    default:
        echo "Error, método no permitido";
        break;
}