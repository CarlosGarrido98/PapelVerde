<?php

# Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "papel_verde");

# Verificar conexión
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

# Crear un array para almacenar los productos
$productos = [];

# Recorrer los resultados y agregar cada producto al array
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

# Devolver los productos en formato JSON
echo json_encode($productos);