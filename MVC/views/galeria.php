<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Productos - Papel Verde </title>
    <!-- Links a Bootstrap y css -->
    <link rel="icon"type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <!-- Links a Bootstrap y css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<?php include 'views/header.php'; ?>

<main>

<section class="container my-5 text-center" style="color: #254B36;">
    <h1>Galería</h1>

    <div
        style="
            width: auto;
            height: 3px;
            background-color: #254B36;
            margin: 10px auto 0;
            border-radius: 10px;
        ">
    </div>
</section>
<!-- Galería de libros -->
<section class="container my-5">

    <div class="d-flex justify-content-center align-items-center mb-3 text-center">
        <h3 class="fw-bold" style="color: #254B36; ">
            Colección de Libros
        </h3>

        <a href="#" class="text-success text-decoration-none">
            
        </a>
    </div>

    <div class="carousel-container position-relative">

        <button class="carousel-btn left" id="prevBtnLibros">
            <i class="bi bi-chevron-left"></i>
        </button>

       <div class="carousel-track" id="carouselTrackLibros">


            <?php while($libro = mysqli_fetch_assoc($librosCarrusel)): ?>
 
                <div class="book-card position-relative pb-5">

                <a href="/producto?id=<?= $libro['id_producto'] ?>">
                    <img 
                        src="<?= $libro['imagen_url'] ?>"
                        alt="<?= $libro['nombre'] ?>"
                    >
                </a>

                    <h6>
                        <?= $libro['nombre'] ?>
                    </h6>

                    <p>
                        <?= $libro['autor'] ?>
                    </p>

                    <span>
                        €<?= number_format($libro['precio'],2,',','.') ?>
                    </span>

                    
                    <button class="btn-añadir position-absolute bottom-0 end-0 m-2 d-none d-xl-block" 
                            data-id="<?= $libro['id_producto'] ?>">
                        <i class="bi bi-plus"></i>
                    </button>

                    <button class="btn-añadir position-absolute bottom-0 end-0 bi bi-plus-lg d-xl-none d-block" data-id="<?= $libro['id_producto'] ?>"></button>
                </div>

            <?php endwhile; ?>

        </div>

        <button class="carousel-btn right" id="nextBtnLibros">
            <i class="bi bi-chevron-right"></i>
        </button>

    </div>

<!-- Galería de mangas -->
<section class="container my-5"> 
    <div class="d-flex justify-content-center align-items-center mb-3 text-center">
        <h3 class="fw-bold" style="color: #254B36; ">
            Colección de Mangas
        </h3>

        <a href="#" class="text-success text-decoration-none">
            
        </a>
    </div>

    <div class="carousel-container position-relative">

        <button class="carousel-btn left" id="prevBtnMangas">
            <i class="bi bi-chevron-left"></i>
        </button>

        <div class="carousel-track" id="carouselTrackMangas">

            <?php while($manga = mysqli_fetch_assoc($mangasCarrusel)): ?>
 
                <div class="book-card position-relative pb-5">

                    <a href="/producto?id=<?= $manga['id_producto'] ?>">
                    <img
                        src="<?= $manga['imagen_url'] ?>"
                        alt="<?= $manga['nombre'] ?>"
                    >
                    </a>

                    <h6>
                        <?= $manga['nombre'] ?>
                    </h6>

                    <p>
                        <?= $manga['autor'] ?>
                    </p>

                    <span>
                        €<?= number_format($manga['precio'],2,',','.') ?>
                    </span>

                     <button class="btn-añadir position-absolute bottom-0 end-0 m-2 d-none d-xl-block" 
                            data-id="<?= $manga['id_producto'] ?>">
                        <i class="bi bi-plus"></i>
                    </button>

                    <button class="btn-añadir position-absolute bottom-0 end-0 bi bi-plus-lg d-xl-none d-block" data-id="<?= $manga['id_producto'] ?>"></button>

                </div>

            <?php endwhile; ?>

        </div>

        <button class="carousel-btn right" id="nextBtnMangas">
            <i class="bi bi-chevron-right"></i>
        </button>

    </div>

<!-- Galería de comics -->
<section class="container my-5"> 
    <div class="d-flex justify-content-center align-items-center mb-3 text-center">
        <h3 class="fw-bold" style="color: #254B36; ">
            Colección de Comics
        </h3>

        <a href="#" class="text-success text-decoration-none">
            
        </a>
    </div>

    <div class="carousel-container position-relative">

        <button class="carousel-btn left" id="prevBtnComics">
            <i class="bi bi-chevron-left"></i>
        </button>

        <div class="carousel-track" id="carouselTrackComics">

            <?php while($comic = mysqli_fetch_assoc($comicsCarrusel)): ?>
 
                <div class="book-card position-relative pb-5">

                    <a href="/producto?id=<?= $comic['id_producto'] ?>">
                    <img
                        src="<?= $comic['imagen_url'] ?>"
                        alt="<?= $comic['nombre'] ?>"
                    >
                    </a>

                    <h6>
                        <?= $comic['nombre'] ?>
                    </h6>

                    <p>
                        <?= $comic['autor'] ?>
                    </p>

                    <span>
                        €<?= number_format($comic['precio'],2,',','.') ?>
                    </span>
                    
                     <button class="btn-añadir position-absolute bottom-0 end-0 m-2 d-none d-xl-block" 
                            data-id="<?= $comic['id_producto'] ?>">
                        <i class="bi bi-plus"></i>
                    </button>
                    <button class="btn-añadir position-absolute bottom-0 end-0  bi bi-plus-lg d-xl-none d-block" data-id="<?= $comic['id_producto'] ?>"></button>
                </div>

            <?php endwhile; ?>

        </div>

        <button class="carousel-btn right" id="nextBtnComics">
            <i class="bi bi-chevron-right"></i>
        </button>

    </div>


</section>

</main>


<?php include 'views/footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/carruselgaleria.js"></script>
</body>    

</html>