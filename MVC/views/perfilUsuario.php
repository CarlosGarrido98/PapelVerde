    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Perfil | Papel Verde  </title>
        <!-- Links a Bootstrap y css -->
        <link rel="icon"type="image/png" href="img/imgPapelVerde/Logoico.ico">
        <!-- Links a Bootstrap y css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    <body>

    <?php 

    // Sacar el usuario de la sesion
        $us = $_SESSION["usuario"];
    ?>

    <main class="container py-5">



    <div class="container py-5">
        <div class="row g-4">

            <!-- COLUMNA IZQUIERDA -->
            <div class="col-lg-4">

                <div class="card shadow h-100">

                    <div class="card-header bg-success text-white " style='background-image: url("img/imgPapelVerde/bg-footer.webp")'>
                        <h4 class="mb-0">
                            <i class="bi bi-person-circle"></i>
                            Bienvenido@ !   <?= htmlspecialchars($us->getNombre()) ?>
                        </h4>
                    </div>

                    <div class="card-body text-center">

                        <img
                            src="<?= htmlspecialchars($us->getImagenUrl()) ?>"
                            class="rounded-circle border shadow mb-3"
                            width="180"
                            height="180"
                            style="object-fit:cover;">

                        <h4><?= htmlspecialchars($us->getNombre()) ?></h4>

                        <p class="text-muted">
                            <?= htmlspecialchars($us->getEmail()) ?>
                        </p>

                        <hr>

                        <div class="text-start">

                            <p>
                                <strong>País:</strong><br>
                                <?= htmlspecialchars($us->getPais()) ?>
                            </p>

                            <p>
                                <strong>Dirección:</strong><br>
                                <?= htmlspecialchars($us->getDireccion()) ?>
                            </p>

                            <p>
                                <strong>Fecha nacimiento:</strong><br>
                                <?= htmlspecialchars($us->getFechaNacimiento()) ?>
                            </p>

                            <p>
                                <strong>Sexo:</strong><br>
                                <?= htmlspecialchars($us->getSexo()) ?>
                            </p>

                        </div>

                    </div>

                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                            <a href="/editPerfil" class="btn btn-success">
                                Editar Perfil
                            </a>
                            
                            <a href="/logout" class="btn btn-danger">
                                Cerrar Sesión
                            </a>

                        </div>
                    
                        <br>

                </div>

            </div>


            <!-- COLUMNAS DE LA DERECHA -->

            <div class="col-lg-8">

                <div class="card shadow">

                    <div class="card-header bg-success text-white" style='background-image: url("img/imgPapelVerde/bg-footer.webp")'>
                        <h4 class="mb-0">
                            <i class="bi bi-pencil-square"></i>
                            Panel de Usuario 
                        </h4>
                    </div>

                    <!-- Aqui iran los favoritos --> 
                    <div class="card-body p-4">
                    <div class="card-body">

                    <div class="row g-4 justify-content-center">

                        <div class="col-12 col-md-6">
                            <a href="/favoritos" class="admin-card favoritos">
                                <i class="bi bi-heart-fill"></i>
                                <span>Mis Favoritos</span>
                            </a>
                        </div>

                        <div class="col-12 col-md-6">
                            <a href="/misPedidos" class="admin-card pedidos">
                                <i class="bi bi-bag-check-fill"></i>
                                <span>Mis Pedidos</span>
                            </a>
                        </div>

                    </div>

    </div>
                    
                    </div>


                </div>

            </div>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    </body>    

    </html>
