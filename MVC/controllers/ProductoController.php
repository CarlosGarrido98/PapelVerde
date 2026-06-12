<?php


require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';



class ProductoController
{
    public static function mostrarProducto()
{
    global $conexion;

    $id = $_GET['id'] ?? null;

    if (!$id) {
        header('Location: /galeria');
        exit;
    }

    $producto = Producto::obtenerProductoPorId($conexion, $id);

    if (!$producto) {
        require 'views/404.php';
        exit;
    }

    $librosCarrusel = Producto::obtenerLibrosCarrusel($conexion);
    $mangasCarrusel = Producto::obtenerMangasCarrusel($conexion);
    $comicsCarrusel = Producto::obtenerComicsCarrusel($conexion);

    require 'views/productoDetalle.php';
    
}
}