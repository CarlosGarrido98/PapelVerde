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

// Enrutamiento según el método HTTP
switch ($method) {

// Rutas que responden a peticiones GET
    case 'GET':
        switch ($request) {

            // Reedirigir al Home
            case '/':
                require_once 'controllers/HomeController.php';
                break;

            // Ir al Home    
            case '/home':
                require_once 'controllers/HomeController.php';
                break;
            // Ir a la Galeria 
            case '/galeria':
                require_once 'controllers/GaleriaController.php';
                break;
            // Acceder a Cada Producto
            case '/producto':
                require_once 'controllers/ProductoController.php';
                ProductoController::mostrarProducto();
                break;   
            // Acceder al Formulario 
            case '/formulario':
                require_once 'views/formulario.php';
                break;
            // Acceder al Login
            case '/login':
                require_once 'views/login.php';
                break;
            // Acceder al About 
            case '/about':
                require_once 'views/about.php';
                break;
            // Acceder al Perfil
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
            
            // Accedemos al buscador
            case '/buscar':
                require_once 'controllers/BuscarController.php';
                BuscarController::index();
                break;
            //Acceder a favoritos    
            case '/favoritos':
                require_once 'controllers/FavoritoController.php';
                FavoritoController::mostrarVista();
                break;
        
            case '/favoritos/toggle':
                require_once 'controllers/FavoritoController.php'; 
                FavoritoController::alternar();
                break;

            //Acceder a editar Perfil
            case '/editPerfil':
                PerfilController::editar();
                break;

            // Cerrar Sesión
            case '/logout':
                LoginController::logout();
                break;
            //Agregar al carrito 
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
            //Gestión de usuarios
            case '/gestionUsuarios':
                require_once 'controllers/AdminController.php';
                AdminController::gestionUsuarios();
                break;
            // Gestión de Productos
            case '/gestionProductos':
                require_once 'controllers/AdminController.php';
                AdminController::gestionProductos();
                break;
            //Gestión de añadir Producto
            case '/crearProducto':
                require_once 'controllers/AdminController.php';
                AdminController::mostrarFormularioProducto();
                break;
            //Gestión de eliminar Producto
            case '/eliminarProducto':
                require_once 'controllers/AdminController.php';
                AdminController::eliminarProducto();
                break;
            //Gestión de editar Producto
            case '/editarProducto':
                require_once 'controllers/AdminController.php';
                AdminController::mostrarEditarProducto();
                break;
            //Gestión de eliminar Usuario
            case '/eliminarUsuario':
                require_once 'controllers/AdminController.php';
                AdminController::eliminarUsuario();
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
            // Nos Registramos
            case '/registrarUsuario':
                require_once 'controllers/RegistroController.php';  
                break;
            // Actualizamos nuestro Perfil
            case '/actualizarPerfil':
                    PerfilController::actualizar();
                    break;

            //Para Añadir Productos 
            case '/guardarProducto':
                require_once 'controllers/AdminController.php';
                AdminController::guardarProducto();
                break;
            //Actualizamos los productos
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