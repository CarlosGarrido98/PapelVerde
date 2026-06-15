<?php

require_once 'config/database.php';
require_once 'models/Producto.php';

class LibrosController
{
    //Función para mostrar los libros
    public static function mostrar()
    {
        global $conexion;

        $libros = Producto::obtenerLibros(
            $conexion
        );

        //Cargar la vista de los libros 
        require 'views/Todolibros.php';
    }
}