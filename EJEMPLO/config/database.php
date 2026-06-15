<?php
//Datos de la conexión con la BDD
$host = "localhost";
$user = "root";
$password = "";
$database = "ejemplo";

// Crear la conexión con MySQL
$conexion = mysqli_connect(
    $host,
    $user,
    $password,
    $database
);

//  Verficar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}