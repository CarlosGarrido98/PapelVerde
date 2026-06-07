<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';

$usuario = new Usuario(

    null,

    $_POST['nombre'],

    $_POST['email'],

    password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    ),

    null,
    false,

    $_POST['sexo'] ?? null,

    $_POST['fecha_nacimiento'] ?? null,

    $_POST['direccion'] ?? null,

    $_POST['pais'] ?? null,

    $_POST['tarjeta'] ?? null,

    isset($_POST['activar_notificaciones']),

    isset($_POST['recibir_revista_digital'])

);

Usuario::registrar(
    $conexion,
    $usuario
);



echo "<pre>";
print_r($_POST);
echo "</pre>";

die();


header("Location: /");
exit;

