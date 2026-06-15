<?php
require_once 'models/Usuario.php';
require_once 'config/database.php';

class UsuarioModel {
    
//Buscar el usuario por correo electronico 
public function buscarPorEmail(string $email): ?Usuario {
    
    global $conexion;
    // 1. Preparar la consulta (usamos el signo '?' como marcador de posición)
    $stmt = mysqli_prepare($conexion, "SELECT * FROM usuarios WHERE email = ? LIMIT 1");

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
        $datos['idUsuarios'],
        $datos['nombre'],
        $datos['email'],
        $datos['contrasena'],
        $datos['imagenURL'],
        (bool)$datos['admin'],

        $datos['sexo'] ?? null,
        $datos['fecha_nacimiento'] ?? null,
        $datos['direccion'] ?? null,
        $datos['pais'] ?? null,
        $datos['tarjeta_credito'] ?? null,
        false, // Por defecto no activamos las notificaciones
        false  // Por defecto no suscribimos a la revista digital


        );
    }



// Función para actualizar un Usuario
public function actualizarUsuario(Usuario $usuario): bool
    {
        global $conexion;

        $sql = "UPDATE usuarios
                SET nombre=?,
                    email=?,
                    direccion=?,
                    pais=?,
                    fecha_nacimiento=?,
                    imagenURL=?,
                    sexo=?,
                    tarjeta_credito=?,
                    activar_notificaciones=?,
                    recibir_revista_digital=?   
                WHERE idUsuarios=?";

        $stmt = mysqli_prepare($conexion, $sql);

        if (!$stmt) {
            die(mysqli_error($conexion));
        }

        $nombre = $usuario->getNombre();
        $email = $usuario->getEmail();
        $direccion = $usuario->getDireccion();
        $pais = $usuario->getPais();
        $fechaNacimiento = $usuario->getFechaNacimiento();
        $imagenURL = $usuario->getImagenUrl();
        $sexo = $usuario->getSexo();
        $tarjetaCredito = $usuario->getTarjetaCredito();
        $activarNotificaciones = $usuario->isActivarNotificaciones() ? 1 : 0;
        $recibirRevistaDigital = $usuario->isRecibirRevistaDigital() ? 1 : 0;

        $idUsuario = $usuario->getIdUsuario();


        mysqli_stmt_bind_param(
        $stmt,
        "ssssssssiii",
        $nombre,
        $email,
        $direccion,
        $pais,
        $fechaNacimiento,
        $imagenURL,
        $sexo,
        $tarjetaCredito,
        $activarNotificaciones,
        $recibirRevistaDigital,
        $idUsuario
        );

        return mysqli_stmt_execute($stmt);
    }

        
// Funcion para obtnere todos los usuarios 
public static function obtenerTodos(mysqli $conexion)
    {
            $sql = "
                SELECT
                    idUsuarios,
                    nombre,
                    email,
                    pais,
                    admin,
                    imagenURL
                FROM usuarios
                ORDER BY nombre
            ";

            return mysqli_query(
                $conexion,
                $sql
            );
    }
    

// Función para borrar un usuario
public static function eliminarUsuario(
            mysqli $conexion,
            int $id
        )
    {
            $sql = "
                DELETE FROM usuarios
                WHERE idUsuarios = $id
            ";

            return mysqli_query(
                $conexion,
                $sql
            );
    }
}