<?php

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';

$idUsuario =
    $_SESSION['usuario']->getIdUsuario();

Usuario::actualizarPerfil(

    $conexion,

    $idUsuario,

    $_POST['nombre'],

    $_POST['email'],

    $_POST['sexo'] ?? null,

    $_POST['fecha_nacimiento'] ?? null,

    $_POST['direccion'] ?? null,

    $_POST['pais'] ?? null,

    $_POST['tarjeta'] ?? null,

    isset($_POST['activar_notificaciones']),

    isset($_POST['recibir_revista_digital']),

    

);


header('Location: /perfil');
exit;