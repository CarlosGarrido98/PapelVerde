<?php

class Producto
{
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
    LEFT JOIN libros l ON p.id_producto = l.id_producto
    LIMIT 10

    ";

    return mysqli_query($conexion, $sql);
}
}