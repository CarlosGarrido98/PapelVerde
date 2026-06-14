<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros | Papel Verde  </title>
    <!-- Links a Bootstrap y css -->
    <link rel="icon"type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <!-- Links a Bootstrap y css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<?php include 'views/header.php'; ?>


<main class="container py-5">

    <h1 class="mb-5 text-center">
         Todos nuestros libros
    </h1>
    <hr>

    <div class="row g-4">

        <?php while($libro = mysqli_fetch_assoc($libros)): ?>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3">

            <div class="card h-100 shadow-sm">

                <a href="/producto?id=<?= $libro['id_producto'] ?>">

                    <img
                        src="<?= $libro['imagen_url'] ?>"
                        class="card-img-top contenedor-foto"
                        style="height:350px; object-fit:cover;">

                </a>

                <div class="card-body">

                    <h5 class="card-title">
                        <?= $libro['nombre'] ?>
                    </h5>

                    <p class="text-muted mb-1">
                        <?= $libro['autor'] ?>
                    </p>

                    <p class="small">
                        <?= $libro['editorial'] ?>
                    </p>

                    <p class="fw-bold text-success">
                        <?= number_format(
                            $libro['precio'],
                            2,
                            ',',
                            '.'
                        ) ?> €
                    </p>

                    <button class="btn-añadir position-absolute bottom-0 end-0 m-2 d-none d-xl-block" 
                            data-id="<?= $libro['id_producto'] ?>">
                        <i class="bi bi-plus"></i>
                    </button>

                    <button class="btn-añadir position-absolute bottom-0 end-0 bi bi-plus-lg d-xl-none d-block" data-id="<?= $libro['id_producto'] ?>"></button>

                </div>

            </div>

        </div>

        <?php endwhile; ?>

    </div>
    

</main>


<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>    

</html>
