<?php

class Producto{

private $id_producto;
private $nombre;
private $precio;
private $stock;
private $tipo;
private $imagen_url;
private $sinopsis;

public function __construct($id_producto, $nombre, $precio, $stock, $tipo, $imagen_url, $sinopsis) {
    $this->id_producto = $id_producto;
    $this->nombre = $nombre;
    $this->precio = $precio;
    $this->stock = $stock;
    $this->tipo = $tipo;
    $this->imagen_url = $imagen_url;
    $this->sinopsis = $sinopsis;
}

public function getIdProducto() {
    return $this->id_producto; 
}

public function getNombre() {
    return $this->nombre;  
}

public function getPrecio() {
    return $this->precio;
}

public function getStock() {
    return $this->stock;
}

public function getTipo() {
    return $this->tipo;
} 

public function getImagenUrl() {
    return $this->imagen_url;
}

public function getSinopsis() {
    return $this->sinopsis;
}

public function setIdProducto($id_producto) {
    $this->id_producto = $id_producto;
}

public function setNombre($nombre) {
    $this->nombre = $nombre;
}

public function setPrecio($precio) {
    $this->precio = $precio;
}

public function setStock($stock) {
    $this->stock = $stock;
}

public function setTipo($tipo) {
    $this->tipo = $tipo;
}

public function setImagenUrl($imagen_url) {
    $this->imagen_url = $imagen_url;
}

public function setSinopsis($sinopsis) {
    $this->sinopsis = $sinopsis;
}





    // Método para obtener las ofertas (libros con id_producto 7 y 9)
    public static function obtenerOfertas($conexion)
    {
        $sql = "
            SELECT
                p.id_producto,
                p.nombre,
                p.precio,
                p.imagen_url,
                l.autor
            FROM productos p
            INNER JOIN libros l
                ON p.id_producto = l.id_producto
            WHERE p.id_producto IN (7,9)
        ";

        return mysqli_query($conexion, $sql);
    }

    // Método para obtener los libros para el carrusel
    public static function obtenerLibrosCarrusel($conexion)
{
    $sql = "
            SELECT
        p.id_producto,
        p.nombre,
        p.precio,
        p.imagen_url,
        l.autor
    FROM productos p
    RIGHT JOIN libros l ON p.id_producto = l.id_producto
    LIMIT 10

    ";

    return mysqli_query($conexion, $sql);
}
// Método para obtener los mangas para el carrusel
public static function obtenerMangasCarrusel($conexion)
{
    $sql = "
            SELECT
        p.id_producto,
        p.nombre,
        p.precio,
        p.imagen_url,
        m.autor
    FROM productos p
    RIGHT JOIN mangas m ON p.id_producto = m.id_producto
    ";

    return mysqli_query($conexion, $sql);   

}
// Método para obtener los cómics para el carrusel
public static function obtenerComicsCarrusel($conexion)
{
    $sql = "
            SELECT
        p.id_producto,
        p.nombre,
        p.precio,
        p.imagen_url,
        c.autor
    FROM productos p
    RIGHT JOIN comics c ON p.id_producto = c.id_producto
    ";

    return mysqli_query($conexion, $sql);   

}


public static function agregarProducto($id, $conexion){

    $stmt = mysqli_prepare($conexion, "SELECT * FROM productos WHERE id_producto = ?");

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $producto = mysqli_fetch_assoc($resultado);
    return $producto;
}


public static function obtenerProductoPorId($conexion, $id)
{
    $stmt = mysqli_prepare(
        $conexion,

                "SELECT  p.*,

            l.autor      AS libro_autor,
            l.editorial  AS libro_editorial,
            l.isbn       AS libro_isbn,
            l.num_paginas,

            c.autor      AS comic_autor,
            c.ilustrador,
            c.editorial  AS comic_editorial,
            c.numero,
            c.isbn       AS comic_isbn,

            m.autor      AS manga_autor,
            m.editorial  AS manga_editorial,
            m.volumen,
            m.coleccion,
            m.isbn       AS manga_isbn

        FROM productos p

        LEFT JOIN libros l
            ON p.id_producto = l.id_producto

        LEFT JOIN comics c
            ON p.id_producto = c.id_producto

        LEFT JOIN mangas m
            ON p.id_producto = m.id_producto

        WHERE p.id_producto = ?"
    );

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}











}