
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Papel Verde  </title>
    <!-- Links a Bootstrap y css -->
    <link rel="icon"type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <!-- Links a Bootstrap y css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<?php include 'views/header.php'; ?>

<?php
$us = $_SESSION["usuario"];
?>

<main>
<<div class="container py-5">
    <div class="row g-4">

        <!-- COLUMNA IZQUIERDA -->
        <div class="col-lg-4">

            <div class="card shadow h-100">

                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-person-circle"></i>
                        Mi Perfil
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

            </div>

        </div>

        <!-- COLUMNA DERECHA -->
        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i>
                        Editar Datos
                    </h4>
                </div>

               
                <div class="card-body p-4">

                    <form action="/actualizarPerfil" method="POST" enctype="multipart/form-data">

                        <!-- FOTO -->
                        <div class="text-center mb-4">
                            <div class="mt-3">
                                <label for="foto" class="form-label fw-semibold">
                                    Cambia tu foto de perfil
                                </label>

                                <input
                                    type="file"
                                    id="foto"
                                    name="foto"
                                    class="form-control"
                                    accept="image/*">
                            </div>

                        </div>

                        <div class="row g-4">

                            <!-- Nombre -->
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">
                                    <i class="bi bi-person me-1"></i>
                                    Nombre
                                </label>

                                <input
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                                    class="form-control"
                                    value="<?= htmlspecialchars($us->getNombre()) ?>">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope me-1"></i>
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    value="<?= htmlspecialchars($us->getEmail()) ?>">
                            </div>

                                  <!-- País -->
                            <div class="col-md-6">
                                <label for="pais" class="form-label">
                                    <i class="bi bi-globe me-1"></i>
                                    País
                                </label>

                                <input
                                    type="text"
                                    id="pais"
                                    name="pais"
                                    class="form-control"
                                    value="<?= htmlspecialchars($us->getPais()) ?>">
                            </div>

                            <!-- Fecha -->
                            <div class="col-md-6">
                                <label for="fechaNacimiento" class="form-label">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    Fecha de nacimiento
                                </label>

                                <input
                                    type="date"
                                    id="fechaNacimiento"
                                    name="fechaNacimiento"
                                    class="form-control"
                                    value="<?= $us->getFechaNacimiento() ?>">
                            </div>

                            <!-- Sexo -->
                            <div class="col-md-6">
                                <label for="sexo" class="form-label">
                                    <i class="bi bi-gender-ambiguous me-1"></i>
                                    Sexo
                                </label>

                                <select name="sexo" id="sexo" class="form-select">

                                    <option value="">Seleccionar</option>

                                    <option value="Hombre"
                                        <?= ($us->getSexo() == 'Hombre') ? 'selected' : '' ?>>
                                        Hombre
                                    </option>

                                    <option value="Mujer"
                                        <?= ($us->getSexo() == 'Mujer') ? 'selected' : '' ?>>
                                        Mujer
                                    </option>

                                    <option value="Otro"
                                        <?= ($us->getSexo() == 'Otro') ? 'selected' : '' ?>>
                                        Otro
                                    </option>

                                </select>
                            </div>


                            <!-- Dirección -->
                            <div class="col-12">
                                <label for="direccion" class="form-label">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    Dirección
                                </label>

                                <input
                                    type="text"
                                    id="direccion"
                                    name="direccion"
                                    class="form-control"
                                    value="<?= htmlspecialchars($us->getDireccion()) ?>">
                            </div>


                            <!-- Tarjeta de crédito -->
                            <div class="col-12">
                                <label for="tarjetaCredito" class="form-label">
                                    <i class="bi bi-credit-card me-1"></i>
                                    Tarjeta de crédito
                                </label>

                                <input
                                    type="text"
                                    id="tarjetaCredito"
                                    name="tarjetaCredito"
                                    class="form-control"
                                    value="<?= ($us->getTarjetaCredito()) ?>">
                                
                                </div>

                            <!-- Notificaciones -->
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="activarNotificaciones"
                                        name="activarNotificaciones"
                                        <?= $us->isActivarNotificaciones() ? 'checked' : '' ?>>

                                    <label class="form-check-label" for="activarNotificaciones">
                                        <i class="bi bi-bell me-1"></i> 
                                        Activar notificaciones
                                    </label>   
                                    </div>

                            <!-- Revista digital -->
                            <div class="col-md-6">
                                <div class="form-check ">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="recibirRevistaDigital"
                                        name="recibirRevistaDigital"
                                        <?= $us->isRecibirRevistaDigital() ? 'checked' : '' ?>>

                                    <label class="form-check-label" for="recibirRevistaDigital">
                                        <i class="bi bi-newspaper me-1"></i>
                                        Suscribirse a la revista digital   
                                    </label>
                            </div>

                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">

                            <a href="/" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i>
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i>
                                Guardar cambios
                            </button>

                        </div>

                    </form>

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
