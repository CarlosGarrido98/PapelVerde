<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Usuario.php';

class AdminController
{
        // Mostramos la gestión de los usuarios
        public static function gestionUsuarios()
        {
            global $conexion;

            $usuarios = UsuarioModel::obtenerTodos(
                $conexion
            );

            require 'views/gestionUsuarios.php';
        }

        //Mostramos la gestión de los productos 
        public static function gestionProductos()
        {
            global $conexion;

            $productos = Producto::obtenerTodos(
                $conexion
            );

            require 'views/gestionProductos.php';
        }

        // Mostramos el formulario para crear un producto
        public static function mostrarFormularioProducto()
        {
            require 'views/crearProducto.php';
        }

        // Guardamos Los productos 
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


        //Eliminamos un producto por su ID 
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

        //Mostramos el formulario para editar un producto
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

        // Actualizamos los datos de un producto
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


        // Eliminar un usuario por su id 
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