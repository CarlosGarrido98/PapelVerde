<?php
require_once 'models/Usuario.php';
require_once 'config/database.php';

class UsuarioModel {
    

    /**
     * Busca un usuario por email usando MySQLi Orientado a Objetos
     */
    public function buscarPorEmail(string $email): ?Usuario {
        global $conexion;
        // 1. Preparar la consulta (usamos el signo '?' como marcador de posición)
        $stmt = mysqli_prepare($conexion, "SELECT idUsuarios, nombre, email, contrasena, imagenURL, admin FROM usuarios WHERE email = ? LIMIT 1");

        if (!$stmt) {
            return null;
        }

        // 2. Vinculamos el parámetro
        mysqli_stmt_bind_param($stmt, "s", $email);
        
        // 3. Ejecutamos
        mysqli_stmt_execute($stmt);
        
        // 4. Obtenemos el resultado
        $resultado = mysqli_stmt_get_result($stmt);
        $datos = mysqli_fetch_assoc($resultado);

        // 5. Cerramos el statement
        mysqli_stmt_close($stmt);

        // Si el correo no existe en la base de datos
        if (!$datos) {
            return null;
        }

        // 6. Retornamos tu clase Usuario con los datos inyectados
        return new Usuario(
            $datos['idUsuario'],
            $datos['nombre'],
            $datos['email'],
            $datos['contrasena'],
            $datos['imagenURL'],
            (bool)$datos['admin']
        );
    }
}