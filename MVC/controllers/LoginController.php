<?php

class LoginController {
    /**
     * Procesa los datos enviados por el usuario (Petición POST)
     */
    public static function procesarLogin() {
        // 1. Iniciar la sesión si no está activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2. Recoger y limpiar los datos del formulario POST
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $contrasena = $_POST['password'] ?? '';

        if (empty($email) || empty($contrasena)) {
            $_SESSION['error'] = "Todos los campos son obligatorios.";
            header('Location: /login');
            exit;
        }
        
        $bUser = new UsuarioModel();
        $usuario = $bUser->buscarPorEmail($email);
        
        if ($usuario === null){
            $_SESSION['error'] = "El correo electrónico no está registrado.";
            header('Location: /login');
            exit;
        }

        // 3. Verificar la contraseña (usando password_verify para contraseñas hasheadas)
        if (password_verify($contrasena, $usuario->getContrasena()) || $contrasena === $usuario->getContrasena()) {
            // Guardamos el objeto Usuario completo en la SESIÓN
            $_SESSION['usuario'] = $usuario;
        
            // =================================================================
            // 🟢 CONTROL DE CONEXIÓN SEGURO
            // =================================================================
            global $conexion;
            if (!isset($conexion) || $conexion === null) {
                require_once 'config/database.php';
            }

            $usuarioId = $usuario->getIdUsuario(); // Usamos tu método nativo del modelo

            if ($usuarioId && $conexion) {
                require_once 'models/Producto.php';
                
                // Aseguramos que las sesiones existan como arrays para no romper llamadas posteriores
                if (!isset($_SESSION['carrito'])) {
                    $_SESSION['carrito'] = [];
                }
                if (!isset($_SESSION['favoritos'])) {
                    $_SESSION['favoritos'] = [];
                }

                // =================================================================
                // 🟢 CARGA AUTOMÁTICA DEL CARRITO AL INICIAR SESIÓN (CON FUSIÓN)
                // =================================================================
                $sqlCarrito = "SELECT id_producto, cantidad FROM carrito WHERE idUsuarios = ?";
                $stmt = $conexion->prepare($sqlCarrito);
                if ($stmt) {
                    $stmt->bind_param("i", $usuarioId);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    while ($fila = $resultado->fetch_assoc()) {
                        $id_prod = $fila['id_producto'];
                        $cantidadBD = (int)$fila['cantidad'];

                        // 💡 SOLUCIÓN INTELEGENTE: Si el producto ya existía en su sesión de invitado,
                        // sumamos la cantidad que traía en local con la cantidad guardada en la BD.
                        if (isset($_SESSION['carrito'][$id_prod])) {
                            if (is_object($_SESSION['carrito'][$id_prod])) {
                                $_SESSION['carrito'][$id_prod]->cantidad += $cantidadBD;
                            } else {
                                $_SESSION['carrito'][$id_prod]['cantidad'] += $cantidadBD;
                            }
                        } else {
                            // Si no existía en la sesión, traemos sus datos de la base de datos de manera normal
                            $productoData = Producto::agregarProducto($id_prod, $conexion);
                            if ($productoData) {
                                if (is_object($productoData)) {
                                    $productoData->cantidad = $cantidadBD;
                                } else {
                                    $productoData['cantidad'] = $cantidadBD;
                                }
                                $_SESSION['carrito'][$id_prod] = $productoData;
                            }
                        }
                    }
                    $stmt->close();
                    
                    // 🔄 IMPORTANTE: Como fusionamos lo que el invitado tenía con la BD, 
                    // actualizamos la BD de inmediato para que guarde el nuevo estado combinado.
                    require_once 'controllers/CarritoController.php';
                    CarritoController::sincronizarConBaseDatos();
                }

                // =================================================================
                // 💖 CARGA AUTOMÁTICA DE FAVORITOS AL INICIAR SESIÓN (CON FUSIÓN)
                // =================================================================
                $sqlFavoritos = "SELECT id_producto FROM favoritos WHERE idUsuarios = ?";
                $stmtFav = $conexion->prepare($sqlFavoritos);
                if ($stmtFav) {
                    $stmtFav->bind_param("i", $usuarioId);
                    $stmtFav->execute();
                    $resultadoFav = $stmtFav->get_result();

                    while ($filaFav = $resultadoFav->fetch_assoc()) {
                        $id_prod = $filaFav['id_producto'];
                        
                        // Si no está ya marcado como favorito en la sesión actual, lo agregamos
                        if (!isset($_SESSION['favoritos'][$id_prod])) {
                            $productoData = Producto::agregarProducto($id_prod, $conexion);
                            if ($productoData) {
                                $_SESSION['favoritos'][$id_prod] = $productoData;
                            }
                        }
                    }
                    $stmtFav->close();
                }
            }

            // Redirigir al perfil
            header('Location: /perfil');
            exit;

        } else {
            $_SESSION['error'] = "El correo o la contraseña son incorrectos.";
            header('Location: /login');
            exit;
        }
    }

    /**
     * Método para cerrar sesión
     */
    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: /login');
        exit;
    }
}