<?php
require_once 'config/database.php';

class FavoritoController {

    public static function alternar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id_libro = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $esFavorito = false;

        if ($id_libro) {
            if (!isset($_SESSION['favoritos'])) {
                $_SESSION['favoritos'] = [];
            }

            // Si ya existe en la sesión, lo quitamos; si no, lo añadimos
            if (isset($_SESSION['favoritos'][$id_libro])) {
                unset($_SESSION['favoritos'][$id_libro]);
                $esFavorito = false;
            } else {
                global $conexion;
                require_once 'models/Producto.php';
                $producto = Producto::agregarProducto($id_libro, $conexion); 

                if ($producto) {
                    $_SESSION['favoritos'][$id_libro] = $producto;
                    $esFavorito = true;
                }
            }

            // Sincronizamos los cambios inmediatamente con la Base de Datos
            self::sincronizarConBaseDatos();
        }

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'esFavorito' => $esFavorito,
            'totalFavoritos' => isset($_SESSION['favoritos']) ? count($_SESSION['favoritos']) : 0
        ]);
        exit;
    }

    /**
     * Vuelca la sesión actual en la base de datos de forma segura
     */
    public static function sincronizarConBaseDatos() {
        if (!isset($_SESSION['usuario'])) {
            return;
        }

        global $conexion;

        if (!isset($conexion) || $conexion === null) {
            require_once 'config/database.php';
        }

        if (!$conexion) {
            error_log("Error: No se pudo acceder a la variable de conexión \$conexion en favoritos.");
            return;
        }

        $usuario = $_SESSION['usuario'];
        $usuarioId = null;

        // 🕵️‍♂️ Extracción ultra-flexible idéntica a la del Carrito Controller
        if (is_object($usuario)) {
            if (isset($usuario->idUsuarios)) {
                $usuarioId = $usuario->idUsuarios;
            } elseif (isset($usuario->id)) {
                $usuarioId = $usuario->id;
            } elseif (isset($usuario->id_usuario)) {
                $usuarioId = $usuario->id_usuario;
            } elseif (method_exists($usuario, 'getIdUsuarios')) {
                $usuarioId = $usuario->getIdUsuarios();
            } elseif (method_exists($usuario, 'getIdUsuario')) {
                $usuarioId = $usuario->getIdUsuario();
            }
        } elseif (is_array($usuario)) {
            $usuarioId = $usuario['idUsuarios'] ?? $usuario['id'] ?? $usuario['id_usuario'] ?? null;
        }

        // Si no encontramos un ID válido, cancelamos para evitar errores de SQL
        if (!$usuarioId) {
            error_log("Error: No se pudo encontrar el ID del usuario en la sesión desde Favoritos.");
            return;
        }

        // 1. Limpiamos los favoritos anteriores en la BD para este usuario
        $sqlDelete = "DELETE FROM favoritos WHERE idUsuarios = ?";
        $stmtDelete = $conexion->prepare($sqlDelete);
        if ($stmtDelete) {
            $stmtDelete->bind_param("i", $usuarioId);
            $stmtDelete->execute();
            $stmtDelete->close();
        } else {
            error_log("Error en prepare DELETE favoritos: " . $conexion->error);
        }

        // 2. Insertamos la lista actual que tiene en la sesión
        if (isset($_SESSION['favoritos']) && !empty($_SESSION['favoritos'])) {
            $sqlInsert = "INSERT INTO favoritos (idUsuarios, id_producto) VALUES (?, ?)";
            $stmtInsert = $conexion->prepare($sqlInsert);

            if ($stmtInsert) {
                foreach ($_SESSION['favoritos'] as $productoId => $item) {
                    $stmtInsert->bind_param("ii", $usuarioId, $productoId);
                    $stmtInsert->execute();
                }
                $stmtInsert->close();
            } else {
                error_log("Error en prepare INSERT favoritos: " . $conexion->error);
            }
        }
    }

    public static function mostrarVista() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si no está logueado, lo mandamos al login
        if (!isset($_SESSION['usuario'])) {
            header('Location: /login');
            exit;
        }

        $listaFavoritos = $_SESSION['favoritos'] ?? [];

        require_once 'views/favoritos.php'; 
    }
}