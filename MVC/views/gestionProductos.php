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
                    <a href="/producto?id=<?= $producto['id_producto'] ?>">
                    <img

                        src="<?= $producto['imagen_url'] ?>"
                        width="60"
                        height="80"
                        style="object-fit:cover;"
                        class="rounded shadow"
                    >
                     </a>
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

                    <!-- Actualizar Producto -->
                    <a
                        href="/editarProducto?id=<?= $producto['id_producto'] ?>"
                        class="btn btn-sm btn-primary">

                        <i class="bi bi-pencil"></i>

                    </a>

                    <!-- Eliminar  Producto -->    
     

                    <button
                        class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEliminar<?= $producto['id_producto'] ?>">

                        <i class="bi bi-trash"></i>

                    </button>

                

                <!-- MODAL PARA ELIMINAR PRODUCTOS  -->

                <div class="modal fade"
                    id="modalEliminar<?= $producto['id_producto'] ?>"
                    tabindex="-1">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <div class="modal-header bg-danger text-white">

                                <h5 class="modal-title">
                                    Eliminar producto
                                </h5>

                                <button
                                    type="button"
                                    class="btn-close btn-close-white"
                                    data-bs-dismiss="modal">
                                </button>

                            </div>

                            <div class="modal-body text-center">

                                <i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i>

                                <p class="mt-3">

                                    ¿Seguro que quieres eliminar

                                    <strong>
                                        <?= $producto['nombre'] ?>
                                    </strong>?

                                </p>

                                <small class="text-muted">
                                    Esta acción no se puede deshacer.
                                </small>

                            </div>

                            <div class="modal-footer">

                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">

                                    Cancelar

                                </button>

                                <a
                                    href="/eliminarProducto?id=<?= $producto['id_producto'] ?>"
                                    class="btn btn-danger">

                                    Eliminar

                                </a>

                            </div>

                        </div>

                    </div>

                </div>


                    

                </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</div>

</main>
<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>    

</html>
