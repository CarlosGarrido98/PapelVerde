<?php

require_once 'config/database.php';
require_once 'models/Producto.php';

class LibrosController
{
    public static function mostrar()
    {
        global $conexion;

        $mangas = Producto::obtenerMangas(
            $conexion
        );

        require 'views/TodoMangas.php';
    }
}