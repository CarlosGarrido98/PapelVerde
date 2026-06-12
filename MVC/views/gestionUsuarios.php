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

    <table class="table table-hover">

        <thead>

            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>País</th>
                <th>Rol</th>
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

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</div>
</main>

<?php include 'views/footer.php'; ?>

</body>    

</html>
