<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papel Verde</title>
    <link rel="icon" type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<?php include 'views/header.php'; ?>

<main> 
 <section class="container-fluid bg-white">
        
       <div class="row justify-content-center"> 

            <div class="col-12 col-xl-6 Formulario justify-content-center align-content-center" style="background-image: url(img/imgPapelVerde/fondoFormu.webp); background-size: cover;">
                <div class="m-4">
                    <h2 class="text-center mb-4" style="color: #254B36;">ÚNETE A NUESTRA COMUNIDAD</h2>
                    
                    <p class="fw-italic d-block d-xl-none text-center">Recibe las últimas noticias, ofertas exclusivas y recomendaciones personalizadas de libros sostenibles.</p>
                    <p class="d-xl-block d-none fs-5 text-center">Recibe las últimas noticias, ofertas exclusivas y recomendaciones personalizadas de libros sostenibles.</p>
                        <div class="mb-3 d-flex justify-content-center">
                            <a href="formulario"><button style="width: 12em;" class="btn-unirse fs-4">Registrate Gratis → </button></a>
                        </div>      
                </div>
                <!-- <p class="text-center"><i style="color: green;" class="bi bi-patch-check-fill"></i> Sin spam. Cancela cuando quieras</p> -->
            </div>
            
            <div class="Ofertas col-12 col-xl-6">

                <h2 class="text-center my-4" style="color: #254B36;">Ofertas especiales</h2>

                <div class="articulos row justify-content-between">

                    <?php while($libro = mysqli_fetch_assoc($ofertas)): ?>

                        <div class="col-6">

                            <div class="card rounded-4 shadow h-100 position-relative">

                                <div class="rounded-top-4" style="
                                        background-image:url('<?= $libro['imagen_url'] ?>');
                                        height:40vh;
                                        background-size:cover;
                                        background-position:center;
                                    ">
                                </div>

                                <div class="card-body pb-5"> <h5 class="card-title"><?= $libro['nombre'] ?></h5>

                                    <p class="card-text"><?= $libro['autor'] ?></p>

                                    <div class="d-flex justify-content-between align-items-center">

                                        <p class="prize-text mb-0">
                                            €<?= number_format($libro['precio'], 2, ',', '.') ?>
                                        </p>

                                        <button class="btn-añadir d-none d-xl-block" data-id="<?= $libro['id_producto'] ?>">
                                            Añadir <i class="bi bi-plus"></i>
                                        </button>

                                    </div>

                                </div>

                                <button class="btn-añadir position-absolute bottom-0 end-0 m-3 bi bi-plus-lg d-xl-none d-block" data-id="<?= $libro['id_producto'] ?>"></button>

                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>
            </div>
        </div>
    </section>
    
    <br><br>

    <section class="container my-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold" style="color: #254B36;">Colección de Libros</h3>
            <a href="galeria" class="text-success text-decoration-none">Ver todos →</a>
        </div>

        <div class="carousel-container position-relative">

            <button class="carousel-btn left" id="prevBtn">
                <i class="bi bi-chevron-left"></i>
            </button>

            <div class="carousel-track" id="carouselTrack">

               <?php while($libro = mysqli_fetch_assoc($librosCarrusel)): ?>

                    <div class="book-card position-relative pb-5"> 

                        <img src="<?= $libro['imagen_url'] ?>" alt="<?= $libro['nombre'] ?>">
                        <h6><?= $libro['nombre'] ?></h6>
                        <p><?= $libro['autor'] ?></p>
                        <span>€<?= number_format($libro['precio'], 2, ',', '.') ?></span>

                        <button class="btn-añadir position-absolute bottom-0 end-0 m-2 d-none d-xl-block" 
                                data-id="<?= $libro['id_producto'] ?>">
                            <i class="bi bi-plus"></i>
                        </button>

                        <button class="btn-añadir position-absolute bottom-0 end-0  bi bi-plus-lg d-xl-none d-block" data-id="<?= $libro['id_producto'] ?>"></button>

                    </div>

                    



                <?php endwhile; ?>

            </div>

            <button class="carousel-btn right" id="nextBtn">
                <i class="bi bi-chevron-right"></i>
            </button>

        </div>

    </section>

</main>

<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/carrusel.js"></script>
</body>    
</html>