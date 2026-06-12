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

    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="carritoLateral" aria-labelledby="carritoLateralLabel">
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
            </div> 
            
            <div class="border-top pt-3 bg-white">
                <div class="d-flex justify-content-between mb-3 fw-bold">
                    <span id="total-prod">Total de productos: <?= $totalProductos; ?></span> 
                </div>
                <div class="row text-center">
                    <?php if (isset($_SESSION["usuario"])): ?>
                        <div class="col-6 mb-2">
                            <a href="carrito/checkout" class="btn btn-success w-100 py-2 <?= $totalProductos === 0 ? 'disabled' : ''; ?>">Procesar Pedido</a>
                        </div>
                    <?php else: ?>
                        <div class="col-6 mb-2">
                            <a href="carrito/checkout" class="btn btn-success w-100 py-2 <?= $totalProductos === 0 ? 'disabled' : ''; ?>" data-bs-toggle="modal" data-bs-target="#authRequeridoModal">Procesar Pedido</a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="col-6 mb-2">
                        <a id="borrar-carrito" class="btn btn-danger w-100 py-2 <?= $totalProductos === 0 ? 'd-none' : ''; ?>">Borrar Carrito</a>
                    </div>
                    
                    </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="authRequeridoModal" tabindex="-1" aria-labelledby="authRequeridoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pt-4 px-4 d-flex justify-content-end">
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center px-5 pb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-lock fs-1" style="color: #254B36;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3" id="authRequeridoModalLabel">¿Listo para leer?</h4>
                    <p class="text-muted fs-6 lh-base">
                        Necesitas tener un usuario para comprar y procesar tu pedido. Inicia sesión para recuperar tu carrito guardado o crea una cuenta en unos segundos.
                    </p>
                </div>
                <div class="modal-footer d-flex flex-column gap-2 border-0 px-5 pb-5">
                    <a href="/login" class="btn btn-success w-100 py-2.5 fw-semibold shadow-sm text-white rounded-3" 
                    style="background-color: #254B36; border-color: #254B36; font-size: 1rem;">
                        Iniciar Sesión
                    </a>
                    <a href="/formulario" class="btn btn-link w-100 text-decoration-none fw-semibold pt-2" 
                    style="color: #254B36; font-size: 0.95rem;">
                        ¿No tienes cuenta? Regístrate aquí
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/carrito.js"></script>