<?php

require_once "models/Producto.php";

class HomeController
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function index()
    {
        $productoModel = new Producto($this->conexion);

        $productos = $productoModel->obtenerProductos();

        require "views/index.php";
    }
}