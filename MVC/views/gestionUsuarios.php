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

    <h1 class="mb-4">
        Gestión de Usuarios
    </h1>

<div class="table-responsive">

    <table class="table table-hover">

        <thead>

            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>País</th>
                <th>Rol</th>
                <th>Eliminar</th>
            </tr>

        </thead>

        <tbody>

        <?php while($usuario = mysqli_fetch_assoc($usuarios)): ?>

            <tr>

                <td>
                    <img
                        src="<?= $usuario['imagenURL'] ?>"
                        width="50"
                        height="50"
                        class="rounded-circle"
                    >
                </td>

                <td>
                    <?= $usuario['nombre'] ?>
                </td>

                <td>
                    <?= $usuario['email'] ?>
                </td>

                <td>
                    <?= $usuario['pais'] ?>
                </td>

                <td>

                    <?php if($usuario['admin']): ?>

                        <span class="badge bg-danger">
                            Admin
                        </span>

                    <?php else: ?>

                        <span class="badge bg-success">
                            Usuario
                        </span>

                    <?php endif; ?>

                </td>


                <td>
                        // ARREGLAR LO DEL BOTO

                        <button
                            class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEliminar<?= $usuario['idUsuarios'] ?>">

                            <i class="bi bi-trash"></i>

                        </button>


                            <div class="modal fade"
                                id="modalEliminar<?= $usuario['idUsuarios'] ?>"
                                tabindex="-1">

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">

                                        <div class="modal-header bg-danger text-white">

                                            <h5 class="modal-title">
                                                Eliminar usuario
                                            </h5>

                                            <button
                                                type="button"
                                                class="btn-close btn-close-white"
                                                data-bs-dismiss="modal">
                                            </button>

                                        </div>

                                        <div class="modal-body text-center">

                                            <i class="bi bi-person-x-fill text-danger fs-1"></i>

                                            <p class="mt-3">

                                                ¿Seguro que quieres eliminar a

                                                <strong>
                                                    <?= $usuario['nombre'] ?>
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
                                                href="/eliminarUsuario?id=<?= $usuario['idUsuarios'] ?>"
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
</div>
</main>

<?php include 'views/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>    

</html>
