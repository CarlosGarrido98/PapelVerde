<?php

class PerfilController
{
    // Muestra el formulario de edición del perfil
    public static function editar()
    {
        require 'views/editPerfil.php';
    }

    // Muestra la lista de favoritos del usuario
    public static function mostrarFavoritos()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: /login');
            exit;
        }

        require_once 'views/favoritos.php';
    }

    // Actualiza los datos del perfil del usuario
    public static function actualizar()
    {
        session_start();

        $usuario = $_SESSION['usuario'];

        $usuario->setNombre($_POST['nombre']);
        $usuario->setEmail($_POST['email']);
        $usuario->setDireccion($_POST['direccion']);
        $usuario->setPais($_POST['pais']);
        $usuario->setFechaNacimiento($_POST['fechaNacimiento']);
        $usuario->setSexo($_POST['sexo']);
        $usuario->setTarjetaCredito($_POST['tarjetaCredito']);
        $usuario->setActivarNotificaciones(isset($_POST['activarNotificaciones']));
        $usuario->setRecibirRevistaDigital(isset($_POST['recibirRevistaDigital']));

        // Procesar la imagen de perfil
        if (!empty($_FILES['foto']['name'])) {

            $carpeta = "img/perfiles/";

            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $nombreArchivo = time() . "_" . $_FILES['foto']['name'];

            move_uploaded_file(
                $_FILES['foto']['tmp_name'],
                $carpeta . $nombreArchivo
            );

            $usuario->setImagenUrl($carpeta . $nombreArchivo);
        }

        // Guardar cambios en la base de datos
        $modelo = new UsuarioModel();
        $modelo->actualizarUsuario($usuario);

        // Actualizar la sesión con los nuevos datos
        $_SESSION['usuario'] = $usuario;

        header("Location: /perfil");
        exit;
    }
}