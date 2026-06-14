<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo "<title>{$producto['nombre']} | Papel Verde</title>"; ?>
    <link rel="icon" type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<?php include 'views/header.php'; ?>

<main class="container py-5">

    <div class="card producto-card border-0 shadow-lg p-4">
        <div class="row align-items-center g-5">

            <div class="col-md-5 text-center">
                <img src="<?= $producto['imagen_url'] ?>" class="img-fluid producto-img" alt="<?= $producto['nombre'] ?>">
            </div>

            <div class="col-md-7">
                <span class="badge bg-success mb-3">Disponible</span>
                <h1 class="fw-bold mb-3"><?= $producto['nombre'] ?></h1>
                <h2 class="precio mb-4"><?= number_format($producto['precio'], 2, ',', '.') ?> €</h2>
                <p class="text-muted descripcion"><?= $producto['sinopsis'] ?></p>

                <?php if($producto['tipo'] == 'libro'): ?>
                    <p><strong>Autor:</strong> <?= $producto['libro_autor'] ?></p>
                    <p><strong>Editorial:</strong> <?= $producto['libro_editorial'] ?></p>
                    <p><strong>ISBN:</strong> <?= $producto['libro_isbn'] ?></p>
                    <p><strong>Páginas:</strong> <?= $producto['num_paginas'] ?></p>
                <?php elseif($producto['tipo'] == 'comic'): ?>
                    <p><strong>Autor:</strong> <?= $producto['comic_autor'] ?></p>
                    <p><strong>Ilustrador:</strong> <?= $producto['ilustrador'] ?></p>
                    <p><strong>Editorial:</strong> <?= $producto['comic_editorial'] ?></p>
                    <p><strong>ISBN:</strong> <?= $producto['comic_isbn'] ?></p>
                <?php elseif($producto['tipo'] == 'manga'): ?>
                    <p><strong>Autor:</strong> <?= $producto['manga_autor'] ?></p>
                    <p><strong>Editorial:</strong> <?= $producto['manga_editorial'] ?></p>
                    <p><strong>Volumen:</strong> <?= $producto['volumen'] ?></p>
                    <p><strong>Colección:</strong> <?= $producto['coleccion'] ?></p>
                    <p><strong>ISBN:</strong> <?= $producto['manga_isbn'] ?></p>
                <?php endif; ?>

                <div class="stock-box mb-4">
                    <i class="bi bi-box-seam"></i> Stock disponible: <strong><?= $producto['stock'] ?></strong>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button class="btn btn-success btn-añadir btn-lg" data-id="<?= $producto['id_producto'] ?>" style="width: 30%;">
                        <i class="bi bi-cart-plus-fill me-2"></i> Añadir al carrito
                    </button>

                    <?php 
                    if (isset($_SESSION['usuario'])):
                    $esFavPrincipal = isset($_SESSION['favoritos'][$producto['id_producto']]); 
                        ?>
                        <button class="btn btn-lg px-4 btn-favorito <?= $esFavPrincipal ? 'btn-danger text-white' : 'btn-outline-danger' ?>" data-id="<?= $producto['id_producto'] ?>">
                            <i class="bi <?= $esFavPrincipal ? 'bi-heart-fill' : 'bi-heart' ?> me-2"></i> Favoritos
                        </button>
                        <?php 
                    endif;
                    ?>
                </div>

            </div>
        </div>
    </div>

    <br>
                
    <div class="d-flex justify-content-center align-items-center mb-3 text-center">
        <h3 class="fw-bold" style="color: #254B36;">También te puede interesar...</h3>
    </div>

    <?php if($producto['tipo'] == 'libro'): ?>
    <div class="carousel-container position-relative">
        <button class="carousel-btn left" id="prevBtnLibros"><i class="bi bi-chevron-left"></i></button>
        <div class="carousel-track" id="carouselTrackLibros">

            <?php while($libro = mysqli_fetch_assoc($librosCarrusel)): ?>
                <?php $esFav = isset($_SESSION['favoritos'][$libro['id_producto']]); ?>
                <div class="book-card position-relative pb-5">
                    <button class="btn btn-sm btn-favorito position-absolute top-0 end-0 m-2 border-0 bg-transparent <?= $esFav ? 'text-danger' : 'text-muted' ?>" data-id="<?= $libro['id_producto'] ?>" style="z-index: 10;">
                        <i class="bi <?= $esFav ? 'bi-heart-fill' : 'bi-heart' ?> fs-5"></i>
                    </button>

                    <a href="/producto?id=<?= $libro['id_producto'] ?>">
                        <img src="<?= $libro['imagen_url'] ?>" alt="<?= $libro['nombre'] ?>">
                    </a>
                    <h6><?= $libro['nombre'] ?></h6>
                    <p><?= $libro['autor'] ?></p>
                    <span>€<?= number_format($libro['precio'], 2, ',', '.') ?></span>
                    
                    <button class="btn-añadir position-absolute bottom-0 end-0 m-2 d-none d-xl-block" data-id="<?= $libro['id_producto'] ?>">
                        <i class="bi bi-plus"></i>
                    </button>
                    <button class="btn-añadir position-absolute bottom-0 end-0 bi bi-plus-lg d-xl-none d-block" data-id="<?= $libro['id_producto'] ?>"></button>
                </div>
            <?php endwhile; ?>

        </div>
        <button class="carousel-btn right" id="nextBtnLibros"><i class="bi bi-chevron-right"></i></button>
    </div>

    <?php elseif($producto['tipo'] == 'manga'): ?>
    <div class="carousel-container position-relative">
        <button class="carousel-btn left" id="prevBtnMangas"><i class="bi bi-chevron-left"></i></button>
        <div class="carousel-track" id="carouselTrackMangas">

            <?php while($manga = mysqli_fetch_assoc($mangasCarrusel)): ?>
                <?php $esFav = isset($_SESSION['favoritos'][$manga['id_producto']]); ?>
                <div class="book-card position-relative pb-5">
                    <button class="btn btn-sm btn-favorito position-absolute top-0 end-0 m-2 border-0 bg-transparent <?= $esFav ? 'text-danger' : 'text-muted' ?>" data-id="<?= $manga['id_producto'] ?>" style="z-index: 10;">
                        <i class="bi <?= $esFav ? 'bi-heart-fill' : 'bi-heart' ?> fs-5"></i>
                    </button>

                    <a href="/producto?id=<?= $manga['id_producto'] ?>">
                        <img src="<?= $manga['imagen_url'] ?>" alt="<?= $manga['nombre'] ?>">
                    </a>
                    <h6><?= $manga['nombre'] ?></h6>
                    <p><?= $manga['autor'] ?></p>
                    <span>€<?= number_format($manga['precio'], 2, ',', '.') ?></span>

                    <button class="btn-añadir position-absolute bottom-0 end-0 m-2 d-none d-xl-block" data-id="<?= $manga['id_producto'] ?>"><i class="bi bi-plus"></i></button>
                    <button class="btn-añadir position-absolute bottom-0 end-0 bi bi-plus-lg d-xl-none d-block" data-id="<?= $manga['id_producto'] ?>"></button>
                </div>
            <?php endwhile; ?>

        </div>
        <button class="carousel-btn right" id="nextBtnMangas"><i class="bi bi-chevron-right"></i></button>
    </div>

    <?php elseif($producto['tipo'] == 'comic'): ?>
    <div class="carousel-container position-relative">
        <button class="carousel-btn left" id="prevBtnComics"><i class="bi bi-chevron-left"></i></button>
        <div class="carousel-track" id="carouselTrackComics">

            <?php while($comic = mysqli_fetch_assoc($comicsCarrusel)): ?>
                <?php $esFav = isset($_SESSION['favoritos'][$comic['id_producto']]); ?>
                <div class="book-card position-relative pb-5">
                    <button class="btn btn-sm btn-favorito position-absolute top-0 end-0 m-2 border-0 bg-transparent <?= $esFav ? 'text-danger' : 'text-muted' ?>" data-id="<?= $comic['id_producto'] ?>" style="z-index: 10;">
                        <i class="bi <?= $esFav ? 'bi-heart-fill' : 'bi-heart' ?> fs-5"></i>
                    </button>

                    <a href="/producto?id=<?= $comic['id_producto'] ?>">
                        <img src="<?= $comic['imagen_url'] ?>" alt="<?= $comic['nombre'] ?>">
                    </a>
                    <h6><?= $comic['nombre'] ?></h6>
                    <p><?= $comic['autor'] ?></p>
                    <span>€<?= number_format($comic['precio'], 2, ',', '.') ?></span>
                    
                    <button class="btn-añadir position-absolute bottom-0 end-0 m-2 d-none d-xl-block" data-id="<?= $comic['id_producto'] ?>"><i class="bi bi-plus"></i></button>
                    <button class="btn-añadir position-absolute bottom-0 end-0 bi bi-plus-lg d-xl-none d-block" data-id="<?= $comic['id_producto'] ?>"></button>
                </div>
            <?php endwhile; ?>

        </div>
        <button class="carousel-btn right" id="nextBtnComics"><i class="bi bi-chevron-right"></i></button>
    </div>
    <?php endif; ?>

</main>

<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/carruselgaleria.js"></script>
<script src="js/productoDetalle.js"></script>
<script src="js/addFavorito.js"></script>
</body>    
</html>