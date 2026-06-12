<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Usuario.php';

class AdminController
{
        public static function gestionUsuarios()
        {
            global $conexion;

            $usuarios = UsuarioModel::obtenerTodos(
                $conexion
            );

            require 'views/gestionUsuarios.php';
        }

        public static function gestionProductos()
        {
            global $conexion;

            $productos = Producto::obtenerTodos(
                $conexion
            );

            require 'views/gestionProductos.php';
        }

        public static function mostrarFormularioProducto()
        {
            require 'views/crearProducto.php';
        }

        public static function guardarProducto()
        {
            global $conexion;

            Producto::crearProducto(
                $conexion,
                $_POST
            );

            header('Location: /gestionProductos');
            exit;
        }


}