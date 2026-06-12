<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Usuarios | Papel Verde  </title>
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

    <div class="d-flex justify-content-between mb-4">

    <h1>Gestión de Productos</h1>

    <a href="/crearProducto"
       class="btn btn-success">

        <i class="bi bi-plus-circle"></i>
        Añadir Producto

    </a>

</div>

    <table class="table table-hover align-middle">

        <thead class="table-success">

            <tr>

                <th>Imagen</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

        <?php while($producto = mysqli_fetch_assoc($productos)): ?>

            <tr>

                <td>

                    <img
                        src="<?= $producto['imagen_url'] ?>"
                        width="60"
                        height="80"
                        style="object-fit:cover;"
                        class="rounded shadow"
                    >

                </td>

                <td>
                    <?= $producto['nombre'] ?>
                </td>

                <td>

                    <?php if($producto['tipo'] == 'libro'): ?>

                        <span class="badge bg-success">
                            Libro
                        </span>

                    <?php elseif($producto['tipo'] == 'comic'): ?>

                        <span class="badge bg-primary">
                            Cómic
                        </span>

                    <?php else: ?>

                        <span class="badge bg-danger">
                            Manga
                        </span>

                    <?php endif; ?>

                </td>

                <td>
                    <?= number_format(
                        $producto['precio'],
                        2,
                        ',',
                        '.'
                    ) ?> €
                </td>

                <td>

                    <?php if($producto['stock'] <= 3): ?>

                        <span class="badge bg-danger">
                            <?= $producto['stock'] ?>
                        </span>

                    <?php else: ?>

                        <?= $producto['stock'] ?>

                    <?php endif; ?>

                </td>

                <td>

                    <a
                        href="/editarProducto?id=<?= $producto['id_producto'] ?>"
                        class="btn btn-sm btn-primary">

                        <i class="bi bi-pencil"></i>

                    </a>

                    <a
                        href="/eliminarProducto?id=<?= $producto['id_producto'] ?>"
                        class="btn btn-sm btn-danger">

                        <i class="bi bi-trash"></i>

                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</div>

</main>
<?php include 'views/footer.php'; ?>


</body>    

</html>
