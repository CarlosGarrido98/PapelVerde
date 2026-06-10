<?php
require_once 'config/database.php';

class CarritoController {
    public static function agregar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id_libro = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $producto = null;

        if ($id_libro) {
            global $conexion;
            require_once 'models/Producto.php';
            $producto = Producto::agregarProducto($id_libro, $conexion);

            if ($producto) { 
                if (!isset($_SESSION['carrito'])) {
                    $_SESSION['carrito'] = [];
                }   

                // 1. Controlamos si el producto YA existe usando el ID del libro como CLAVE
                if (isset($_SESSION['carrito'][$id_libro])) {
                    
                    // Si tu modelo devuelve un OBJETO en lugar de un Array asociativo:
                    if (is_object($_SESSION['carrito'][$id_libro])) {
                        // Si el objeto ya tiene un atributo público o una propiedad dinámica 'cantidad'
                        $_SESSION['carrito'][$id_libro]->cantidad++;
                    } else {
                        // Si tu modelo devuelve un ARRAY asociativo:
                        $_SESSION['carrito'][$id_libro]['cantidad']++;
                    }
                    
                    // Asignamos el producto actualizado para mandarlo en el json_encode
                    $producto = $_SESSION['carrito'][$id_libro];

                } else {
                    // 2. Si el producto NO existe, le creamos su primera cantidad = 1
                    if (is_object($producto)) {
                        $producto->cantidad = 1;
                    } else {
                        $producto['cantidad'] = 1;
                    }
                    
                    // Lo guardamos en el carrito usando el ID como clave única
                    $_SESSION['carrito'][$id_libro] = $producto;
                }
            }
        }

        // 3. Calculamos el total sumando las cantidades reales de cada producto
        $totalProductosReal = 0;
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                // Sumamos la propiedad cantidad dependiendo de si es objeto o array
                $totalProductosReal += is_object($item) ? $item->cantidad : $item['cantidad'];
            }
        }

        header('Content-Type: application/json');
        echo json_encode([  
            'status' => 'success',
            'totalProductos' => $totalProductosReal, // Enviamos el conteo real acumulado
            'producto' => $producto // Enviamos el producto entero con su atributo 'cantidad' incluido
        ]);
        exit;
    }

    public static function borrarProducto() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id_libro = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $cantidad_restante = 0;
        $precio_total_item = 0;
        $eliminado_con_exito = false;

        if ($id_libro && isset($_SESSION['carrito']) && isset($_SESSION['carrito'][$id_libro])) {
            // Usamos una copia normal para evitar conflictos de referencias en algunas versiones de PHP
            $item = $_SESSION['carrito'][$id_libro]; 

            // Detectamos de forma segura cómo leer la cantidad y el precio base
            $cantidad_actual = is_object($item) ? ($item->cantidad ?? 1) : ($item['cantidad'] ?? 1);
            
            // --- REVISIÓN SEGURA DE PRECIO ---
            // Intenta leer ->precio, si no existe intenta ->getPrecio(), si no lo trata como Array
            if (is_object($item)) {
                $precio_base = isset($item->precio) ? $item->precio : (method_exists($item, 'getPrecio') ? $item->getPrecio() : 0);
            } else {
                $precio_base = isset($item['precio']) ? $item['precio'] : 0;
            }

            if ($cantidad_actual > 1) {
                // Si hay más de uno, restamos 1 en la sesión
                if (is_object($_SESSION['carrito'][$id_libro])) {
                    $_SESSION['carrito'][$id_libro]->cantidad--;
                    $cantidad_restante = $_SESSION['carrito'][$id_libro]->cantidad;
                } else {
                    $_SESSION['carrito'][$id_libro]['cantidad']--;
                    $cantidad_restante = $_SESSION['carrito'][$id_libro]['cantidad'];
                }
                $precio_total_item = $precio_base * $cantidad_restante;
            } else {
                // Si solo queda uno, lo eliminamos por completo
                unset($_SESSION['carrito'][$id_libro]);
                $cantidad_restante = 0;
            }
            $eliminado_con_exito = true;
        }

        // Calculamos el TOTAL GLOBAL real de unidades que quedan
        $totalProductosReal = 0;
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $prod) {
                $totalProductosReal += is_object($prod) ? ($prod->cantidad ?? 1) : ($prod['cantidad'] ?? 1);
            }
        }

        // Forzamos la limpieza del búfer de salida por si PHP coló algún Warning previo en texto común
        if (ob_get_length()) ob_clean();

        header('Content-Type: application/json');
        echo json_encode([
            'status' => $eliminado_con_exito ? 'success' : 'error',
            'totalProductos' => $totalProductosReal,
            'cantidadRestante' => $cantidad_restante,
            'precioTotalItem' => $precio_total_item
        ]);
        exit;
    }

    public static function borrarCarrito(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // 1. Borramos el carrito
        $_SESSION['carrito'] = [];
        
        // 2. Avisamos que respondemos en JSON
        header('Content-Type: application/json');
        
        // 3. SOLUCIÓN: Enviamos una respuesta JSON real para que JavaScript la reciba
        echo json_encode([
            'status' => 'success',
            'message' => 'El carrito ha sido vaciado correctamente'
        ]);
        
        exit; // Buena práctica: detenemos la ejecución para que no se cuele ningún espacio en blanco accidental
    }
}