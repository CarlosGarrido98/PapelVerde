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

    
        public static function eliminarProducto()
        {
            global $conexion;

            $id = $_GET['id'];

            Producto::eliminarProducto(
                $conexion,
                $id
            );

            header('Location: /gestionProductos');
            exit;
        }


        public static function mostrarEditarProducto()
        {
            global $conexion;

            $id = $_GET['id'];

            $producto = Producto::obtenerProductoPorId(
                $conexion,
                $id
            );

            require 'views/editarProducto.php';
        }


        public static function actualizarProducto()
        {
            global $conexion;

            Producto::actualizarProducto(
                $conexion,
                $_POST
            );

            header('Location: /gestionProductos');
            exit;
        }


        public static function eliminarUsuario()
        {
            global $conexion;

            $id = $_GET['id'];

            UsuarioModel::eliminarUsuario(
                $conexion,
                $id
            );

            header('Location: /gestionUsuarios');
            exit;
        }


}