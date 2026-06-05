<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';

$ofertas = Producto::obtenerOfertas($conexion);
$librosCarrusel = Producto::obtenerLibrosCarrusel($conexion);

require_once __DIR__ . '/../views/home.php';