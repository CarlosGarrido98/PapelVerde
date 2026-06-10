<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Papel Verde</title>
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
     <section class ="Formulario container-fluid bg-white">
    

    <h1 class="text-center" style="color: #254B36;"> Únete a Papel Verde </h1>
        
    <!-- Modal exitoso-->
    <div class="modal fade" id="registroModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¡Éxito!</h5>
            </div>
            <div class="modal-body">
                Tu registro se ha completado exitosamente!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
            </div>
            </div>
        </div>
    </div>


    <!-- Formulario de registro -->
    <form id="registroForm" method="POST" action="/registrarUsuario" >
            <!-- Nombre -->
            <label>Nombre y Apellidos</label>
            <input type="text" name="nombre" id="nombre" required placeholder="Ej: Juan Garcia">
            <span class="warn" id="nameError"></span>
            
            <!-- Correo -->
            <label>Correo electrónico </label>
            <input type="email" name="email" id="email" required placeholder="Ej: juan@gmail.com">
            <span class="warn" id="emailError"></span>

            <!-- Contraseña -->
            <label>Contraseña </label>
                <div style="position: relative;">
                <input type="password" name="password" id="password" required>
                <i id="togglePassword" 
                class="bi bi-eye" 
                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                </i>
                </div> 
            <span class="warn" id="passwordError"></span>

            <!-- Confirmar contraseña -->
            <label>Confirmar contraseña </label>
            <div style="position: relative;">
                 <input type="password" name="confirmPassword" id="confirmPassword" required>
                <i id="togglePasswordConfirm" 
                class="bi bi-eye" 
                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                </i>
                </div> 
            <span class="warn" id="confirmPasswordError"></span>

            <!-- Sexo -->
            <label>Sexo</label>
            <select name="sexo">
                <option value="">Seleccionar</option>
                <option>Hombre</option>
                <option>Mujer</option>
                <option>Otro</option>
            </select>

            <!-- Fecha -->
            <label>Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">

            <!-- Dirección -->
            <label>Dirección</label>
            <input type="text" name="direccion" id="direccion">

            <!-- País -->
            <label>País</label>
            <select name="pais" id="pais">
                <option value="">Seleccionar</option>
                <option>España</option>
                <option>México</option>
                <option>Argentina</option>
                <option>Colombia</option>
                <option>Otro</option>
            </select>

            <!-- Tarjeta (oculta  hasta que se seleccione una dirección y  un país) -->
            <div id="tarjetaContainer" style="display: none;" >
                <label>Tarjeta de crédito</label>
                <input type="text" id="tarjeta"  name="tarjeta" placeholder="1234 5678 9012 3456">
            </div>

            <!-- Cajitas Checkboxes -->
            <label>
                <input type="checkbox" name="activar_notificaciones"> Activar notificaciones
            </label>

            <label>
                <input type="checkbox" name="recibir_revista_digital"> Recibir revista digital
            </label>

            <br><br>
            <button type="submit">Registrarse</button>

            </form>

    </section>



</main>


<?php include 'views/footer.php'; ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/validaciones.js"></script>
</body>    

</html>