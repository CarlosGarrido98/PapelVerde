<?php 
// 1. Aseguramos que la sesión está activa para leer el carrito real
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

// 2. Contamos cuántas UNIDADES REALES hay en la sesión sumando sus cantidades
$totalProductos = 0;
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $itemCarrito) {
        if (is_object($itemCarrito)) {
            $totalProductos += isset($itemCarrito->cantidad) ? $itemCarrito->cantidad : 1;
        } else {
            $totalProductos += isset($itemCarrito['cantidad']) ?    $itemCarrito['cantidad'] : 1;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papel Verde</title>
    <link class="icon" type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <header class="bg-light">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-xl-3 col-4 d-xl-block d-none">
                    <a href="https://www.facebook.com"> <button class="btn bi bi-facebook fs-5"></button></a>   
                    <a href="https://www.instagram.com"> <button class="btn bi bi-instagram fs-5"></button></a>
                    <a href="https://www.twitter.com"> <button class="btn bi bi-twitter-x fs-5"></button></a>
                </div>

                <div class="col-xl-3 col-4 d-xl-none d-flex justify-content-around">
                    <a href="https://www.facebook.com" class="bi bi-facebook w-25 text-dark"></a>   
                    <a href="https://www.instagram.com" class="bi bi-instagram w-25 text-dark"></a>
                    <a href="https://www.twitter.com" class="bi bi-twitter-x w-25 text-dark"></a>
                </div>
                
                <div class="col-xl-6 col-4 d-flex justify-content-center">
                    <a href="home"><img src="img/imgPapelVerde/Logotipo1.png" class="img-fluid" style="max-width: 150px;" alt="Logo de Papel Verde"></a>
                </div>

                <div class="col-xl-3 col-4 d-flex justify-content-end align-items-center">
                    <?php
                    $ret = '<a href="login"><button class="btn bi bi-person fs-5"></button></a>';
                    if(isset($_SESSION["usuario"])){
                        $ret = '<a href="perfil" class="me-2">
                                    <img src="'.$_SESSION["usuario"]->getImagenUrl().'"
                                         alt="Foto de perfil"
                                         class="rounded-circle img-fluid"
                                         style="width: 40px; height: 40px; object-fit: cover;"
                                    >
                                </a>';
                    }
                    echo $ret;
                    ?>
                    
                    <button class="btn bi bi-cart fs-5 position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#carritoLateral" aria-controls="carritoLateral">
                        <?php if($totalProductos > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                <?= $totalProductos; ?>
                            </span>
                        <?php endif; ?>
                    </button>
                </div>
                
            </div>
        </div>
    </header>

    <nav class="nav border border-1" style='background-image: url("img/imgPapelVerde/bg-footer.webp")'>
        <div class="nav-box d-flex justify-content-center m-3">
            <ul class="list-nav">
                <li class="nav-item"><a class="link-n" href="home">Home</a></li>
                <li class="nav-item"><a class="link-n" href="galeria">Galería</a></li>
                <li class="nav-item"><a class="link-n" href="about">About</a></li>
                <?php
                if(isset($_SESSION["usuario"])){
                    if($_SESSION["usuario"]->isAdministrador() == 1){
                        echo '<li class="nav-item"><a class="link-n" href="gestion">Gestión</a></li>';
                    }
                }
                ?>
            </ul>
            
            <form action="/buscar" method="GET" class="d-flex nav-search">
                <input class="input-buscador" type="search" name="q" placeholder="Buscar..." required>
                <button class="bi bi-search mx-2 btn-buscar" type="submit"></button>
            </form>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="carritoLateral" aria-labelledby="carritoLateralLabel">
        <div class="offcanvas-header bg-light border-bottom">
            <h5 class="offcanvas-title" id="carritoLateralLabel"><i class="bi bi-cart3 me-2"></i>Tu Carrito</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        
        <div class="offcanvas-body d-flex flex-column justify-content-between">
            
            <div class="productos-carrito-wrapper">
                <?php if ($totalProductos > 0 && isset($_SESSION['carrito'])): ?>
                    
                    <?php foreach ($_SESSION['carrito'] as $idLibro => $itemCarrito): 
                        $nombre = is_object($itemCarrito) ? $itemCarrito->getNombre() : $itemCarrito['nombre'];
                        $precio = is_object($itemCarrito) ? $itemCarrito->getPrecio() : $itemCarrito['precio'];
                        $imagen = is_object($itemCarrito) ? $itemCarrito->getImagenUrl() : $itemCarrito['imagen_url'];
                        
                        // Leemos la cantidad real que tu controlador ya calculó en la sesión
                        $cantidad = is_object($itemCarrito) ? $itemCarrito->cantidad : $itemCarrito['cantidad'];
                        $precioTotalProducto = $precio * $cantidad;
                    ?>
                        <div class="card mb-3 border-0 border-bottom pb-2 producto-item" data-id="<?= $idLibro; ?>">
                            <div class="row g-0 align-items-center">
                                <div class="col-3">
                                    <img src="<?= $imagen; ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($nombre); ?>">
                                </div>
                                <div class="col-7 ps-2">
                                    <h6 class="card-title mb-0" style="font-size: 0.9rem;"><?= htmlspecialchars($nombre); ?></h6>
                                    <p class="card-text text-muted mb-0" style="font-size: 0.8rem;">
                                        Cantidad: <span class="producto-cantidad"><?= $cantidad; ?></span>
                                    </p>
                                    <small class="text-success fw-bold">
                                        $<span class="producto-precio-total"><?= number_format($precioTotalProducto, 2); ?></span>
                                    </small>
                                </div>
                                <div class="col-2 text-end">
                                    <button class="btn text-danger bi bi-trash3 p-1 btn-eliminar-producto" data-id="<?= $idLibro; ?>"></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <div class="text-center my-5 text-muted carrito-vacio-estado">
                        <i class="bi bi-cart-x fs-1"></i>
                        <p class="mt-2">El carrito está vacío.</p>
                    </div>
                <?php endif; ?>
            </div> <div class="border-top pt-3 bg-white">
                <div class="d-flex justify-content-between mb-3 fw-bold">
                    <span id="total-prod">Total de productos: <?= $totalProductos; ?></span> 
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <a href="carrito/checkout" class="btn btn-success w-100 py-2 <?= $totalProductos === 0 ? 'disabled' : ''; ?>">Procesar Pedido</a>
                    </div>
                    <div class="col-6 mb-2">
                        <a id="borrar-carrito" class="btn btn-danger w-100 py-2 <?= $totalProductos === 0 ? 'd-none' : ''; ?>" href="#">Borrar Carrito</a>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-outline-secondary btn-sm w-100" data-bs-dismiss="offcanvas">Seguir comprando</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bundle.min.js"></script>
    <script src="js/carrito.js"></script> 
</body>
</html>