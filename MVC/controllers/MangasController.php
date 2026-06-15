<?php

require_once 'config/database.php';
require_once 'models/Producto.php';

class MangasController
{
    // Funcion para 
    public static function mostrar()
    {
        global $conexion;

        $mangas = Producto::obtenerMangas(
            $conexion
        );

        //Cargar la Vista de los Mangas 
        require 'views/TodoMangas.php';
    }
}