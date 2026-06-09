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



<main >

<?php
session_start();

$usuario = $_SESSION['usuario'];
?>

<section class="container my-5">

    <h2 class="mb-4">Mi Perfil</h2>

    <form
        action="/actualizarPerfil"
        method="POST"
        enctype="multipart/form-data"
    >

        <!-- FOTO -->

        <div class="text-center mb-4">

            <img
                src="<?= $usuario->getImagenUrl() ?>"
                class="rounded-circle border"
                width="180"
                height="180"
                style="object-fit: cover;"
            >

            <div class="mt-3">

                <input
                    type="file"
                    name="fotoPerfil"
                    class="form-control"
                >

            </div>

        </div>

        <div class="row">

    <div class="col-md-6 mb-3">

        <label>Nombre</label>

        <input
            type="text"
            name="nombre"
            class="form-control"
            value="<?= $usuario->getNombre() ?>"
        >

    </div>

    <div class="col-md-6 mb-3">

        <label>Email</label>

        <input
            type="email"
            name="email"
            class="form-control"
            value="<?= $usuario->getEmail() ?>"
        >

    </div>

</div>

<select
    name="sexo"
    class="form-select"
>

    <option value="Masculino">Masculino</option>

    <option value="Femenino">Femenino</option>

    <option value="Otro">Otro</option>

</select>

<input
    type="text"
    name="direccion"
    class="form-control"
    value="<?= $usuario->getDireccion() ?>"
>

<input
    type="checkbox"
    name="activar_notificaciones"
    value="1"

    <?= $usuario->isActivarNotificaciones()
        ? 'checked'
        : '' ?>
>

<input
    type="checkbox"
    name="recibir_revista_digital"
    value="1"

    <?= $usuario->isRecibirRevistaDigital()
        ? 'checked'
        : '' ?>
>

<button
    class="btn btn-success"
    type="submit"
>
    Guardar cambios
</button>

</form>

</section>




</main>


<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/carrusel.js"></script>
</body>    

</html>
