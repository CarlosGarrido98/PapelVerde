<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';



$librosCarrusel = Producto::obtenerLibrosCarrusel($conexion);

$mangasCarrusel = Producto::obtenerMangasCarrusel($conexion);

$comicsCarrusel = Producto::obtenerComicsCarrusel($conexion);


require_once __DIR__ . '/../views/galeria.php';