<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Productos | Papel Verde  </title>
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



<div class="container py-5">

    <div class="card shadow-lg border-0">

        <div class="card-header text-white"
             style='background-image:url("img/imgPapelVerde/bg-footer.webp")'>

            <h3 class="mb-0">
                <i class="bi bi-pencil-square"></i>
                Editar Producto
            </h3>

        </div>

        <div class="card-body">

            <div class="row g-5">

                <!-- INFORMACIÓN ACTUAL -->

                <div class="col-lg-4">

                    <div class="text-center">

                        <img
                            src="<?= $producto['imagen_url'] ?>"
                            class="img-fluid rounded shadow mb-3"
                            style="max-height:300px; object-fit:cover;">

                        <h3 class="fw-bold">
                            <?= $producto['nombre'] ?>
                        </h3>

                        <h4 class="text-success">
                            <?= number_format(
                                $producto['precio'],
                                2,
                                ',',
                                '.'
                            ) ?> €
                        </h4>

                        <span class="badge bg-success fs-6">
                            <?= ucfirst($producto['tipo']) ?>
                        </span>

                    </div>

                    <hr>

                    <div class="mt-3">

                        <p>
                            <strong>Stock:</strong>
                            <?= $producto['stock'] ?>
                        </p>

                        <p>
                            <strong>Sinopsis:</strong><br>
                            <?= $producto['sinopsis'] ?>
                        </p>

                        <?php if($producto['tipo'] == 'libro'): ?>

                            <p>
                                <strong>Autor:</strong>
                                <?= $producto['libro_autor'] ?>
                            </p>

                            <p>
                                <strong>Editorial:</strong>
                                <?= $producto['libro_editorial'] ?>
                            </p>

                            <p>
                                <strong>ISBN:</strong>
                                <?= $producto['libro_isbn'] ?>
                            </p>

                            <p>
                                <strong>Páginas:</strong>
                                <?= $producto['num_paginas'] ?>
                            </p>

                        <?php elseif($producto['tipo'] == 'comic'): ?>

                            <p>
                                <strong>Autor:</strong>
                                <?= $producto['comic_autor'] ?>
                            </p>

                            <p>
                                <strong>Ilustrador:</strong>
                                <?= $producto['ilustrador'] ?>
                            </p>

                            <p>
                                <strong>Editorial:</strong>
                                <?= $producto['comic_editorial'] ?>
                            </p>

                            <p>
                                <strong>ISBN:</strong>
                                <?= $producto['comic_isbn'] ?>
                            </p>

                        <?php elseif($producto['tipo'] == 'manga'): ?>

                            <p>
                                <strong>Autor:</strong>
                                <?= $producto['manga_autor'] ?>
                            </p>

                            <p>
                                <strong>Editorial:</strong>
                                <?= $producto['manga_editorial'] ?>
                            </p>

                            <p>
                                <strong>Volumen:</strong>
                                <?= $producto['volumen'] ?>
                            </p>

                            <p>
                                <strong>Colección:</strong>
                                <?= $producto['coleccion'] ?>
                            </p>

                            <p>
                                <strong>ISBN:</strong>
                                <?= $producto['manga_isbn'] ?>
                            </p>

                        <?php endif; ?>

                    </div>

                </div>

                <!-- FORMULARIO -->

                <div class="col-lg-8">

                    <form
                        action="/actualizarProducto"
                        method="POST">

                        <input
                            type="hidden"
                            name="id_producto"
                            value="<?= $producto['id_producto'] ?>">

                        <div class="mb-3">

                            <label class="form-label">
                                Nombre
                            </label>

                            <input
                                type="text"
                                name="nombre"
                                value="<?= $producto['nombre'] ?>"
                                class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Precio
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="precio"
                                value="<?= $producto['precio'] ?>"
                                class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Stock
                            </label>

                            <input
                                type="number"
                                name="stock"
                                value="<?= $producto['stock'] ?>"
                                class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Sinopsis
                            </label>

                            <textarea
                                name="sinopsis"
                                rows="5"
                                class="form-control"><?= $producto['sinopsis'] ?></textarea>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="bi bi-check-circle"></i>
                            Guardar cambios

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>









    

</main>


<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>    

</html>
