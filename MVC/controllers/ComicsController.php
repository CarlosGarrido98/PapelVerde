<?php

require_once 'config/database.php';
require_once 'models/Producto.php';

class ComicsController
{
    //Funcion para mostrar 
    public static function mostrar()
    {
        global $conexion;

        $comics = Producto::obtenerComics(
            $conexion
        );

        //Cargamos la vista
        require 'views/TodoComics.php';
    }
}