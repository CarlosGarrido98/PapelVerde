<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';



// Cogemos productos para los carruseles 
$librosCarrusel = Producto::obtenerLibrosCarrusel($conexion);
$mangasCarrusel = Producto::obtenerMangasCarrusel($conexion);
$comicsCarrusel = Producto::obtenerComicsCarrusel($conexion);

// Cargamos la vista de la galeria
require_once __DIR__ . '/../views/galeria.php';