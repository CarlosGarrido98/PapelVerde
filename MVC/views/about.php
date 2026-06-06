<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papel Verde</title>
    <!-- Links a Bootstrap y css -->
    <link rel="icon"type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <!-- Links a Bootstrap y css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<?php include 'views/header.php'; ?>

<br><br>
<main> 
    <!--Título-->
<section class="hero text-center">
    <div class="container">
        <h1 class="display-3 fw-bold">Papel Verde</h1>
        <p class="lead">
            Tu rincón favorito para descubrir libros, mangas y cómics.
        </p>
    </div>
</section>

<!-- HISTORIA -->
<section class="container py-5">
    <div class="row align-items-center">

        <div class="col-md-6">
            <img src="img/imgPapelVerde/logotipo.png"
                 class="img-fluid rounded shadow"
                 alt="Papel Verde">
        </div>

        <div class="col-md-6">
            <h2 class="fw-bold mb-3">Nuestra Historia</h2>

            <p>
                Papel Verde nació de la pasión por la lectura y el deseo
                de crear un espacio donde cualquier persona pueda encontrar
                historias que inspiren, emocionen y entretengan.
            </p>

            <p>
                Desde novelas clásicas hasta mangas y cómics modernos,
                buscamos ofrecer una colección diversa para todos los gustos.
            </p>
        </div>

    </div>
</section>

<!-- MISIÓN Y VISIÓN -->
<section class="container py-5">
    <div class="row">

        <div class="col-md-6">
            <div class="p-4 border rounded shadow-sm h-100">
                <h3 class="fw-bold text-success">
                    <i class="bi bi-bullseye"></i> Misión
                </h3>

                <p>
                    Promover el hábito de la lectura ofreciendo una amplia
                    variedad de libros, mangas y cómics de calidad para
                    lectores de todas las edades.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-4 border rounded shadow-sm h-100">
                <h3 class="fw-bold text-success">
                    <i class="bi bi-eye"></i> Visión
                </h3>

                <p>
                    Convertirnos en una referencia para los amantes de la
                    lectura y construir una comunidad apasionada por las historias.
                </p>
            </div>
        </div>

    </div>
</section>

<!-- VALORES -->
<section class="container py-5">

    <h2 class="text-center fw-bold mb-5">
        Nuestros Valores
    </h2>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="icon-box shadow-sm">
                <i class="bi bi-book"></i>
                <h5 class="mt-3">Lectura</h5>
                <p>Fomentamos el amor por los libros y el aprendizaje.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="icon-box shadow-sm">
                <i class="bi bi-people"></i>
                <h5 class="mt-3">Comunidad</h5>
                <p>Creamos espacios para compartir experiencias lectoras.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="icon-box shadow-sm">
                <i class="bi bi-lightbulb"></i>
                <h5 class="mt-3">Innovación</h5>
                <p>Buscamos nuevas formas de acercar la lectura.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="icon-box shadow-sm">
                <i class="bi bi-heart"></i>
                <h5 class="mt-3">Pasión</h5>
                <p>Amamos las historias y queremos compartirlas contigo.</p>
            </div>
        </div>

    </div>
</section>
<!-- EQUIPO -->
<section class="container py-5">

    <h2 class="text-center fw-bold mb-5">
        Nuestro Equipo
    </h2>

    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card shadow text-center">
                <div class="card-body">


                    <h5 class="card-title">
                        Carlos
                    </h5>

                    <p class="text-muted">
                        Desarrollador de Aplicaciones Web 
                    </p>

                    <p>
                        Responsable del desarrollo y mantenimiento
                        de la plataforma Papel Verde.
                    </p>

                </div>
            </div>
        </div>

    </div>

</section>

<!-- CONTACTO -->
<section class="container py-5">

    <div class="text-center">

        <h2 class="fw-bold mb-4">
            Contacto
        </h2>

        <p>
            <i class="bi bi-envelope-fill"></i>
            contacto@papelverde.com
        </p>

        <p>
            <i class="bi bi-telephone-fill"></i>
            +34 602456789
        </p>

    </div>


</main>


<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/carrusel.js"></script>
</body>    

</html>
