<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo "<title>{$producto['nombre']} - Papel Verde</title>";
    ?>
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

    <div class="card producto-card border-0 shadow-lg p-4">

        <div class="row align-items-center g-5">

            <div class="col-md-5 text-center">
                <img
                    src="<?= $producto['imagen_url'] ?>"
                    class="img-fluid producto-img"
                    alt="<?= $producto['nombre'] ?>"
                >
            </div>

            <div class="col-md-7">

                <span class="badge bg-success mb-3">
                    Disponible
                </span>

                <h1 class="fw-bold mb-3">
                    <?= $producto['nombre'] ?>
                </h1>

                <h2 class="precio mb-4">
                    <?= number_format($producto['precio'], 2, ',', '.') ?> €
                </h2>

                <p class="text-muted descripcion">
                    <?= $producto['sinopsis'] ?>
                </p>

                <div class="stock-box mb-4">
                    <i class="bi bi-box-seam"></i>
                    Stock disponible:
                    <strong><?= $producto['stock'] ?></strong>
                </div>

                <button class="btn btn-success btn-lg px-4">
                    <i class="bi bi-cart-plus-fill"></i>
                    Añadir al carrito
                </button>

            </div>

        </div>

    </div>

</main>


<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/carrusel.js"></script>
</body>    

</html>
