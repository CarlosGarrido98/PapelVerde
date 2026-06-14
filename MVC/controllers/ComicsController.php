<?php

require_once 'config/database.php';
require_once 'models/Producto.php';

class ComicsController
{
    public static function mostrar()
    {
        global $conexion;

        $comics = Producto::obtenerComics(
            $conexion
        );

        require 'views/TodoComics.php';
    }
}