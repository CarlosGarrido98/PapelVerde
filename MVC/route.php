<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// index.php

$method = $_SERVER["REQUEST_METHOD"];

// Obtener la URL solicitada
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
