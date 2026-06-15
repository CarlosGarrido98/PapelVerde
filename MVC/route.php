<?php
require_once ("controllers/LoginController.php");
require_once ("models/UsuarioModel.php");
require_once("controllers/PerfilController.php");

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

            case '/producto':
                require_once 'controllers/ProductoController.php';
                ProductoController::mostrarProducto();
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

            //Vistas de Los Productos 

            case '/libros':
                require_once 'controllers/LibrosController.php';
                LibrosController::mostrar();
                break;

            case '/mangas':
                require_once 'controllers/MangasController.php';
                MangasController::mostrar();
                break;

            case '/comics':
                require_once 'controllers/ComicsController.php';
                ComicsController::mostrar();
                break;
                

            case '/buscar':
                require_once 'controllers/BuscarController.php';
                BuscarController::index();
                break;
                        
            case '/favoritos':
                require_once 'controllers/FavoritoController.php';
                FavoritoController::mostrarVista();
                break;

            case '/favoritos/toggle':
                require_once 'controllers/FavoritoController.php'; 
                FavoritoController::alternar();
                break;


            case '/editPerfil':
                PerfilController::editar();
                break;


            case '/logout':
                LoginController::logout();
                break;

            case '/carrito/agregar':
                require_once 'controllers/CarritoController.php';
                CarritoController::agregar();
                break;  

             case '/carrito/borrarProducto':
                require_once 'controllers/CarritoController.php';
                CarritoController::borrarProducto();
                break;

            case '/carrito/borrarCarrito':
                require_once 'controllers/CarritoController.php';
                CarritoController::borrarCarrito();
                break;  

            
            // Gestiones 

            case '/gestion':
                require_once 'views/gestion.php';
                break;

                
            case '/gestionUsuarios':
                require_once 'controllers/AdminController.php';
                AdminController::gestionUsuarios();
                break;

            case '/gestionProductos':
                require_once 'controllers/AdminController.php';
                AdminController::gestionProductos();
                break;

            case '/crearProducto':
                require_once 'controllers/AdminController.php';
                AdminController::mostrarFormularioProducto();
                break;


            case '/eliminarProducto':
                require_once 'controllers/AdminController.php';
                AdminController::eliminarProducto();
                break;

            case '/editarProducto':
            require_once 'controllers/AdminController.php';
            AdminController::mostrarEditarProducto();
            break;

            case '/eliminarUsuario':
            require_once 'controllers/AdminController.php';
            AdminController::eliminarUsuario();
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
                break;

            case '/actualizarPerfil':
                    PerfilController::actualizar();
                    break;

            //Para Añadir Productos 
            case '/guardarProducto':
                require_once 'controllers/AdminController.php';
                AdminController::guardarProducto();
                break;

            case '/actualizarProducto':
                require_once 'controllers/AdminController.php';
                AdminController::actualizarProducto();
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