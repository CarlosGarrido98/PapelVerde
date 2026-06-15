<?php

require_once 'models/Producto.php';

class ProductoController
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function index()
    {
        $productoModel = new Producto($this->db);

        $productos = $productoModel->obtenerTodos();

        require 'views/productos.php';
    }
}