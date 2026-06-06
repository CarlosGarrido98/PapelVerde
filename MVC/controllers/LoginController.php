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

        if ($contrasena === $usuario->getContrasena()) {
            // ¡Logueado con éxito! Guardamos sus datos esenciales en la SESIÓN
            $_SESSION['usuario'] = $usuario;
        

            // Redirigir al Home o al panel de Gestión si es admin
            header('Location: /perfil');
            exit;

        } else {
            // Si falla, guardamos el error en la sesión y lo mandamos de vuelta
            $_SESSION['error'] = "El correo o la contraseña son incorrectos.";
            header('Location: /login');
            exit;
        }
    }

    /**
     * Método extra para cerrar sesión
     */
    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy(); // Destruye la sesión
        header('Location: /login');
        exit;
    }
}