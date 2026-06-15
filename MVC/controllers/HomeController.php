<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';

//Cogemos los productos para la pagina Home
$ofertas = Producto::obtenerOfertas($conexion);
$librosCarrusel = Producto::obtenerLibrosCarrusel($conexion);

//Cargamos La vista
require_once __DIR__ . '/../views/home.php';