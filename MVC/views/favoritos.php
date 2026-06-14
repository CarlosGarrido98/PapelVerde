<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Favoritos | Papel Verde</title>
    
    <link rel="icon" type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
      
    </style>
</head>
<body class="bg-light">

<?php include 'views/header.php'; ?>

<main class="container py-5">
    

    <?php if (empty($listaFavoritos)): ?>
        
        <div class="vacio-contenedor p-5 bg-white rounded-4 shadow-sm animate__animated animate__fadeIn">
            <i class="bi bi-heartbreak text-muted mb-4" style="font-size: 4.5rem; opacity: 0.5;"></i>
            <h3 class="fw-bold mb-2" style="color: #254B36;">Tu lista está vacía</h3>
            <p class="text-muted mb-4">Aún no has añadido ningún producto a tus favoritos. ¡Explora nuestro catálogo y dale amor a tus próximas lecturas!</p>
            <a href="/" class="btn text-white px-4 py-2" style="background-color: #254B36; border-radius: 10px;">
                <i class="bi bi-compass me-2"></i>Descubrir Catálogo
            </a>
        </div>

    <?php else: ?>

    <div class="d-flex align-items-center gap-3 mb-5">
        
        <div>
            <h1 class="fw-bold m-0" style="color: #254B36;">Favoritos</h1>
            <p class="text-muted m-0">Libros que te han gustado</p>
        </div>

    </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($listaFavoritos as $id_producto => $item): ?>
                
                <?php 
                    $tipo = $item['tipo'] ?? 'libro';
                    $badgeColor = 'bg-primary';
                    if ($tipo === 'manga') $badgeColor = 'bg-primary text-white';
                    if ($tipo === 'comic') $badgeColor = 'bg-warning text-dark';
                    if ($tipo === 'libro') $badgeColor = 'bg-success text-white';
                  
                ?>

                <div class="col" id="item-favorito-<?= $id_producto ?>">
                    <div class="card h-100 favorito-card shadow-sm p-3 position-relative">
                        
                        <a href="#" class="btn-eliminar-fav btn-favorito" data-id="<?= $id_producto ?>" title="Quitar de favoritos">
                            <i class="bi bi-heart-fill"></i>
                        </a>

                        <div class="img-contenedor mb-3">
                            <span class="badge tipo-badge <?= $badgeColor ?>"><?= $tipo ?></span>
                            <a href="/producto?id=<?= $id_producto ?>">
                                <img src="<?= $item['imagen_url'] ?>" class="favorito-img img-fluid" alt="<?= $item['nombre'] ?>">
                            </a>
                        </div>

                        <div class="card-body mt-5 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="fw-bold  titulo-producto mb-1">
                                    <a href="/producto?id=<?= $id_producto ?>" class="text-decoration-none" style="color: inherit;">
                                        <?= $item['nombre'] ?>
                                    </a>
                                </h5>
                            </div>

                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="precio-tag"><?= number_format($item['precio'], 2, ',', '.') ?> €</span>
                                    
                                    <span class="small <?= $item['stock'] > 0 ? 'text-success' : 'text-danger' ?>">
                                        <?= $item['stock'] > 0 ? 'En Stock' : 'Agotado' ?>
                                    </span>
                                </div>

                                <button class="btn btn-success btn-carrito-fav btn-añadir w-100 py-2 text-white" data-id="<?= $id_producto ?>">
                                    <i class="bi bi-cart-plus-fill me-2"></i>Añadir al carrito
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</main>

<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/addFavorito.js"></script>
</body>
</html>