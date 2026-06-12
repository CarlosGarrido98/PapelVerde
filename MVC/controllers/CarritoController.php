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

                // Convertimos el stock a un entero limpio
                $stockDisponible = is_object($producto) ? (int)$producto->stock : (int)$producto['stock'];

                // 1. Averiguamos cuánta cantidad ya tiene acumulada en el carrito
                $cantidadActualEnCarrito = 0;
                if (isset($_SESSION['carrito'][$id_libro])) {
                    $itemEnCarrito = $_SESSION['carrito'][$id_libro];
                    $cantidadActualEnCarrito = is_object($itemEnCarrito) ? $itemEnCarrito->cantidad : $itemEnCarrito['cantidad'];
                }

                // Calculamos cuánto sumaría si le permitimos agregar este clic
                $cantidadSolicitada = $cantidadActualEnCarrito + 1;

                // ========================================================
                // VALIDACIÓN DE STOCK REAL
                // ========================================================
                if ($cantidadSolicitada > $stockDisponible) {
                    // Si la nueva cantidad supera al stock, detenemos el proceso y avisamos al JS
                    header('Content-Type: application/json');
                    echo json_encode([ 
                        'status' => 'no_stock',
                        'message' => 'Lo sentimos, no hay suficiente stock disponible.',
                        'stockDisponible' => $stockDisponible
                    ]);
                    exit;
                }

                // 2. Si pasa la validación de stock, procedemos a guardar o sumar de forma normal
                if (isset($_SESSION['carrito'][$id_libro])) {
                    if (is_object($_SESSION['carrito'][$id_libro])) {
                        $_SESSION['carrito'][$id_libro]->cantidad++;
                    } else {
                        $_SESSION['carrito'][$id_libro]['cantidad']++;
                    }
                    $producto = $_SESSION['carrito'][$id_libro];
                } else {
                    if (is_object($producto)) {
                        $producto->cantidad = 1;
                    } else {
                        $producto['cantidad'] = 1;
                    }
                    $_SESSION['carrito'][$id_libro] = $producto;
                }
            }
        }

        // 3. Calculamos el total de productos acumulados para el diseño global
        $totalProductosReal = 0;
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $totalProductosReal += is_object($item) ? $item->cantidad : $item['cantidad'];
            }
        }

        // 🟢 Sincronizamos los cambios en la base de datos
        self::sincronizarConBaseDatos();

        header('Content-Type: application/json');
        echo json_encode([  
            'status' => 'success',
            'totalProductos' => $totalProductosReal, 
            'producto' => $producto 
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

        // 🟢 Sincronizamos los cambios en la base de datos
        self::sincronizarConBaseDatos();

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
        
        // 🟢 Sincronizamos los cambios en la base de datos (esto limpiará la tabla del usuario)
        self::sincronizarConBaseDatos();

        // 2. Avisamos que respondemos en JSON
        header('Content-Type: application/json');
        
        // 3. SOLUCIÓN: Enviamos una respuesta JSON real para que JavaScript la reciba
        echo json_encode([
            'status' => 'success',
            'message' => 'El carrito ha sido vaciado correctamente'
        ]);
        
        exit; 
    }

    public static function sincronizarConBaseDatos() {
        // Si el usuario no ha iniciado sesión, no tocamos la base de datos
        if (!isset($_SESSION['usuario'])) {
            return;
        }

        global $conexion;
        
        // 🟢 SOLUCIÓN 1: Si 'global $conexion' viene vacío, intentamos incluir el archivo 
        // o usar la clase de base de datos que tengas para forzar la conexión.
        if (!isset($conexion) || $conexion === null) {
            require_once 'config/database.php';
            // Nota: Si en config/database.php tu conexión se asigna a otra variable (ej: $conn o una clase Database),
            // asegúrate de mapearla aquí. Si se llama $conexion, al hacer el require_once debería revivir.
        }

        // Si aun así la conexión no existe, dejamos un registro en el log para saberlo
        if (!$conexion) {
            error_log("Error: No se pudo acceder a la variable de conexión \$conexion en el carrito.");
            return;
        }

        $usuario = $_SESSION['usuario'];
        $usuarioId = null;

        // 🕵️‍♂️ Extracción ultra-flexible del ID (revisamos tanto objetos como arrays)
        if (is_object($usuario)) {
            if (isset($usuario->idUsuarios)) {
                $usuarioId = $usuario->idUsuarios;
            } elseif (isset($usuario->id)) {
                $usuarioId = $usuario->id;
            } elseif (isset($usuario->id_usuario)) {
                $usuarioId = $usuario->id_usuario;
            } elseif (method_exists($usuario, 'getIdUsuarios')) {
                $usuarioId = $usuario->getIdUsuarios();
            }
        } elseif (is_array($usuario)) {
            $usuarioId = $usuario['idUsuarios'] ?? $usuario['id'] ?? $usuario['id_usuario'] ?? null;
        }

        // Si no encontramos un ID válido, cancelamos para no romper la query
        if (!$usuarioId) {
            error_log("Error: No se pudo encontrar el ID del usuario en la sesión.");
            return;
        }

        // 1. Limpiamos el carrito previo de este usuario para actualizarlo de forma limpia
        $sqlDelete = "DELETE FROM carrito WHERE idUsuarios = ?";
        $stmtDelete = $conexion->prepare($sqlDelete);
        if ($stmtDelete) {
            $stmtDelete->bind_param("i", $usuarioId);
            $stmtDelete->execute();
            $stmtDelete->close();
        } else {
            error_log("Error en el prepare de DELETE: " . $conexion->error);
        }

        // 2. Si hay productos en la sesión, los insertamos en la tabla uno a uno
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            $sqlInsert = "INSERT INTO carrito (idUsuarios, id_producto, cantidad) VALUES (?, ?, ?)";
            $stmtInsert = $conexion->prepare($sqlInsert);

            if ($stmtInsert) {
                foreach ($_SESSION['carrito'] as $productoId => $item) {
                    // Detectamos si el item del carrito actual es un objeto o un array para leer la cantidad
                    $cantidad = is_object($item) ? ($item->cantidad ?? 1) : ($item['cantidad'] ?? 1);

                    $stmtInsert->bind_param("iii", $usuarioId, $productoId, $cantidad);
                    $stmtInsert->execute();
                }
                $stmtInsert->close();
            } else {
                error_log("Error en el prepare de INSERT: " . $conexion->error);
            }
        }
    }
}