<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Gestión | Papel Verde  </title>
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

    <div class="row justify-content-center">

        <div class="col-12 col-lg-10 col-xl-8">

            <div class="card shadow border-0">

                <div class="card-header text-white"
                     style='background-image: url("img/imgPapelVerde/bg-footer.webp")'>

                    <h4 class="mb-0 text-center">
                        <i class="bi bi-shield-lock"></i>
                        Panel de Administración
                    </h4>

                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-12 col-md-4">
                            <a href="/gestionProductos" class="admin-card productos">
                                <i class="bi bi-book-half"></i>
                                <span>Gestión de Productos</span>
                            </a>
                        </div>

                        <div class="col-12 col-md-4">
                            <a href="/gestionUsuarios" class="admin-card usuarios">
                                <i class="bi bi-people-fill"></i>
                                <span>Gestión de Usuarios</span>
                            </a>
                        </div>

                        <div class="col-12 col-md-4">
                            <a href="/gestionPedidos" class="admin-card pedidos">
                                <i class="bi bi-bag-check-fill"></i>
                                <span>Gestión de Pedidos</span>
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>


<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/carrusel.js"></script>
</body>    

</html>
