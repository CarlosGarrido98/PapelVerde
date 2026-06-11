<?php

require_once 'models/Producto.php';
require_once 'config/database.php';

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

        require 'views/productoDetalle.php';
    }
}