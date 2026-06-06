<?php
require_once 'config/database.php';

class CarritoController {
    public static function agregar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id_libro = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id_libro) {
            // [OPCIONAL] Conectas a la BBDD para validar que el libro existe de verdad
            global $conexion;
            require_once 'models/Producto.php';
            $existe = ProductoModel::agregarProducto($conexion, $id_libro);

            if ($existe) { // Solo si existe en la BBDD lo guardamos
                if (!isset($_SESSION['carrito'])) {
                    $_SESSION['carrito'] = [];
                }
                $_SESSION['carrito'][] = $id_libro;
            }
        }

        // Enviamos la respuesta de éxito a tu JavaScript (carrito.js)
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'totalProductos' => isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0
        ]);
        exit;
    }
}