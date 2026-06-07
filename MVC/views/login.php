<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Links a Bootstrap y css -->
    <link rel="icon"type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <!-- Links a Bootstrap y css -->
    <link rel="stylesheet" href="css/formstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<?php include 'views/header.php'; ?>
<main> 
  <!-- Modal exitoso-->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¡Éxito!</h5>
            </div>
            <div class="modal-body">
                Login exitoso! (prueba)
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
            </div>
            </div>
        </div>
    </div>


    <section class ="Formulario container-fluid bg-white flex-grow-1">
        
        <form id="LoginForm" action="/login" method="POST">
            <h1 class="text-center" style="color: #254B36;"> Bienvenid@!</h1>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input name = "email" type="email" class="form-control" id="email" placeholder="Ej: juan@gmail.com">
                <span class="warn" id="emailError"></span>
            </div>
            
            <div class="mb-3" style="position: relative;">
                <label for="password" class="form-label">Contraseña</label>
                <input name = "password" type="password" class="form-control" id="password" placeholder="Tu contraseña">
                <i id="togglePassword" class="bi bi-eye" 
                style="position: absolute; right: 15px; top: 70%; transform: translateY(-50%); cursor: pointer;">
                </i>
                 
            </div>
            

            <button type="submit" class="btn btn-success w-100" style="background-color: #254B36; border-color: #254B36;">Iniciar Sesión</button>

        </form>



    </section>

</main>


<?php include 'views/footer.php'; ?>

<!-- Scripts  -->
<script src="js/login.js"> </script>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>