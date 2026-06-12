<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Favoritos | Papel Verde</title>
    <link rel="icon" type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php 
include 'views/header.php'; 

// Recuperamos los favoritos reales de la sesión (si no hay ninguno, pasamos un array vacío)
$listaFavoritos = $_SESSION['favoritos'] ?? [];
?>

<main>
    
    <div class="m-5">
        <div class="text-center text-white rounded d-flex justify-content-center" >
            <h2 class="text-center text-white rounded p-2 w-50" style='background-image: url("img/imgPapelVerde/bg-footer.webp")'>Tu lista de favoritos</h2>
        </div>

        <div class="row" id="contenedor-favoritos">
            
            <?php if (empty($listaFavoritos)): ?>
                <div class="col-12 text-center my-5 text-muted id="estado-vacio"">
                    <i class="bi bi-heartbreak fs-1 text-danger"></i>
                    <p class="mt-3 fs-5">Aún no tienes productos en tu lista de favoritos.</p>
                    <a href="home" class="btn btn-success mt-2" style="background-color: #254B36; border-color: #254B36;">Explorar Tienda</a>
                </div>
            <?php else: ?>
                
                <?php foreach ($_SESSION['favoritos'] as $idLibro => $itemFav): 
                    // Controlamos si el producto viene como Objeto o como Array asociativo
                    $nombre = is_object($itemFav) ? $itemFav->getNombre() : $itemFav['nombre'];
                    $precio = is_object($itemFav) ? $itemFav->getPrecio() : $itemFav['precio'];
                    $imagen = is_object($itemFav) ? $itemFav->getImagenUrl() : $itemFav['imagen_url'];
                    $autor  = is_object($itemFav) ? (method_exists($itemFav, 'getAutor') ? $itemFav->getAutor() : 'Autor') : ($itemFav['autor'] ?? 'Autor');
                ?>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mt-3 fila-favorito" id="fav-card-<?= $idLibro; ?>">
                        <div class="book-card position-relative pb-5 shadow m-2 bg-white rounded overflow-hidden"> 
                            
                            <button class="btn-añadir position-absolute btn-quitar-favorito" 
                                    style="top:-5px; right:-5px; width:25%; border-radius:300px; z-index: 10;"
                                    data-id="<?= $idLibro; ?>">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                            
                            <a href="/producto?id=<?= $idLibro; ?>">
                                <img src="<?= $imagen; ?>" class="img-fluid p-2" alt="<?= htmlspecialchars($nombre); ?>" style="max-height: 200px; object-fit: contain; width: 100%;">
                            </a>
                            <h6 class="px-2 mt-2 text-truncate" title="<?= htmlspecialchars($nombre); ?>"><?= htmlspecialchars($nombre); ?></h6>
                            <p class="px-2 text-muted text-truncate mb-1"><?= htmlspecialchars($autor); ?></p>
                            <span class="px-2 text-success fw-bold">€<?= number_format($precio, 2); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </div>

</main>

<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/validaciones.js"></script>

<script src="js/favoritos.js"></script> 

</body>    
</html>