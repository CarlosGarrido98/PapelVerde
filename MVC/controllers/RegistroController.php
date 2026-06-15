<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';

// Registrar un nuevo usuario con los datos del formulario
$resultado = Usuario::registrar(

    $conexion,

    $_POST['nombre'],

    $_POST['email'],

    $_POST['password'],

    $_POST['sexo'] ?? null,

    $_POST['fecha_nacimiento'] ?? null,

    $_POST['direccion'] ?? null,

    $_POST['pais'] ?? null,

    $_POST['tarjeta'] ?? null,

    isset($_POST['activar_notificaciones']),

    isset($_POST['recibir_revista_digital'])

);

// Redirigir al login si el registro fue exitoso
if ($resultado) {

    header("Location: /login");
    exit;

} else {

    die(mysqli_error($conexion));

}