<?php

require_once 'config/database.php';
require_once 'models/Producto.php';

class LibrosController
{
    public static function mostrar()
    {
        global $conexion;

        $libros = Producto::obtenerLibros(
            $conexion
        );

        require 'views/Todolibros.php';
    }
}