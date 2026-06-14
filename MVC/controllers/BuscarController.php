<?php


require_once 'config/database.php'; // Carga tu archivo con la variable $conexion
require_once 'models/Producto.php'; // Tu entidad de Producto

class BuscarController {

    public static function index() {
        global $conexion; // Hacemos uso de tu variable de conexión mysqli

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Capturar término de búsqueda y limpiar espacios
        $busqueda = isset($_GET['q']) ? trim(htmlspecialchars($_GET['q'])) : '';

        if (empty($busqueda)) {
            header('Location: home');
            exit;
        }

        // Capturar los filtros provenientes del formulario lateral
        $filtroTipo = isset($_GET['tipo']) ? trim($_GET['tipo']) : 'todos';
        $precioMin  = isset($_GET['precio_min']) && $_GET['precio_min'] !== '' ? (float)$_GET['precio_min'] : null;
        $precioMax  = isset($_GET['precio_max']) && $_GET['precio_max'] !== '' ? (float)$_GET['precio_max'] : null;
        $orden      = isset($_GET['orden']) ? trim($_GET['orden']) : 'relevancia';

        // Ejecutar la consulta filtrada
        $productosEncontrados = Producto::buscarConFiltros($conexion, $busqueda, $filtroTipo, $precioMin, $precioMax, $orden);
        $totalResultados = count($productosEncontrados);

        // Renderizar la vista
        require_once 'views/resultadosBusqueda.php';
    }
}