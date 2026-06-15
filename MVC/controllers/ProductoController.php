<?php


require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';



class ProductoController
{
    //Muestra la ficha detallada de un producto
    public static function mostrarProducto()
{
    global $conexion;

    $id = $_GET['id'] ?? null;

    // Redirigir si no se ha indicado un producto

    if (!$id) {
        header('Location: /galeria');
        exit;
    }

    $producto = Producto::obtenerProductoPorId($conexion, $id);

      // Mostrar página de error si el producto no existe
    if (!$producto) {
        require 'views/404.php';
        exit;
    }


  // Obtener productos para los carruseles relacionados
    $librosCarrusel = Producto::obtenerLibrosCarrusel($conexion);
    $mangasCarrusel = Producto::obtenerMangasCarrusel($conexion);
    $comicsCarrusel = Producto::obtenerComicsCarrusel($conexion);

    //Cargar la vista 
    require 'views/productoDetalle.php';
    
}
}