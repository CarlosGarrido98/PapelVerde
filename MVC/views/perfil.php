<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil </title>
    <!-- Links a Bootstrap y css -->
    <link rel="icon"type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <!-- Links a Bootstrap y css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<?php 
include 'views/header.php'; 
    

    $us = $_SESSION["usuario"];
?>

<main class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-lg-6">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body text-center p-4">

                    <!-- Foto de perfil -->
                    <img
                        src="<?php echo $us->getImagenUrl() ?? 'img/default-avatar.png'; ?>"
                        alt="Foto de perfil"
                        class="rounded-circle img-fluid mb-3"
                        style="width: 150px; height: 150px; object-fit: cover;"
                    >

                    <!-- Nombre -->
                    <h2 class="fw-bold">
                        Bienvenido,
                        <?php echo $us->getNombre() ?? 'Usuario'; ?>
                    </h2>

                    <!-- Correo -->
                    <p class="text-muted fs-5">
                        <?php echo $us->getEmail() ?? 'Email no disponible'; ?>
                    </p>

                    <hr>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                        <a href="/editar" class="btn btn-success">
                            Editar Perfil
                        </a>

                        <a href="/logout" class="btn btn-danger">
                            Cerrar Sesión
                        </a>

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
