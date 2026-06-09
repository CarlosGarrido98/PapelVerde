// ===== REFERENCIAS =====
const inpNombre = document.getElementById("nombre");
const cajaNombreError = document.getElementById("nameError");

const inpEmail = document.getElementById("email");
const cajaEmailError = document.getElementById("emailError");

const inpPassword = document.getElementById("password");
const cajaPasswordError = document.getElementById("passwordError");

const inpConfirmPassword = document.getElementById("confirmPassword");
const cajaConfirmPasswordError = document.getElementById("confirmPasswordError");

const inpDireccion = document.getElementById("direccion");
const inpPais = document.getElementById("pais");
const tarjetaContainer = document.getElementById("tarjetaContainer");
const inpTarjeta = document.getElementById("tarjeta");

const form = document.getElementById("registroForm");


// ===== BLOQUEAR CAMPOS DESDE DESPUÉS DE LA CONTRASEÑA =====
function bloquearCamposInferiores() {
    document.querySelectorAll(
        "#registroForm select, #registroForm input[type='date'], #registroForm #direccion, #registroForm #pais, #registroForm #tarjeta, #registroForm input[type='checkbox']"
    ).forEach(el => el.disabled = true);
}

// Ejecutar al inicio
bloquearCamposInferiores();


// ===== DESBLOQUEAR CAMPOS =====
function desbloquearCamposInferiores() {
    document.querySelectorAll(
        "#registroForm select, #registroForm input[type='date'], #registroForm #direccion, #registroForm #pais, #registroForm #tarjeta, #registroForm input[type='checkbox']"
    ).forEach(el => el.disabled = false);
}


// ===== EVENTOS =====
inpNombre.addEventListener("blur", validarNombre);
inpEmail.addEventListener("blur", validarEmail);
inpPassword.addEventListener("blur", validarPassword);
inpConfirmPassword.addEventListener("blur", validarConfirmPassword);

inpDireccion.addEventListener("input", comprobarMostrarTarjeta);
inpPais.addEventListener("change", comprobarMostrarTarjeta);


// ===== SUBMIT =====
form.addEventListener("submit", function(e) {

    let nombreValido = validarNombre();
    let emailValido = validarEmail();
    let passwordValido = validarPassword();
    let confirmPasswordValido = validarConfirmPassword();

    if (!nombreValido || !emailValido || !passwordValido || !confirmPasswordValido) {
        e.preventDefault();
    } 
    
   else {
        // AQUI PARA QUE SALTE EL MODAL DE REGISTRO EXITOSO
       let miModal = new bootstrap.Modal(document.getElementById('registroModal'));
      miModal.show();
      e.preventDefault();
    }
   
});


// ===== MENSAJES =====
function mostrarMensaje(elemento, mensaje, tipo, iconoClase) {
    elemento.textContent = "";

    let icono = document.createElement("i");
    icono.classList.add("bi", iconoClase);

    let texto = document.createTextNode(" " + mensaje);

    elemento.appendChild(icono);
    elemento.appendChild(texto);

    elemento.classList.remove("text-danger", "text-success");

    elemento.classList.add(tipo === "error" ? "text-danger" : "text-success");
}


// ===== VALIDACIONES =====

// Nombre
function validarNombre(){
      let nombre = inpNombre.value.trim();
    let numPalabras = nombre.split(/\s+/).filter(p => p.length > 0).length;

    let regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ]+\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+$/;

    if (nombre === "") {
        mostrarMensaje(cajaNombreError, "Introduce nombre y apellidos!", "error", "bi-x-circle");
        return false;

    } else if (numPalabras !== 2) {
        mostrarMensaje(cajaNombreError, "Debes introducir nombre y apellido (máx 2 palabras)", "error", "bi-x-circle");
        return false;

    } else if (!regex.test(nombre)) {
        mostrarMensaje(cajaNombreError, "Solo letras, sin números ni símbolos", "error", "bi-x-circle");
        return false;

    } else {
        mostrarMensaje(cajaNombreError, "Nombre válido", "success", "bi-check-circle");
        return true;
    }
}

// Email
function validarEmail() {
    let email = inpEmail.value.trim();
    let regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (email === "") {
        mostrarMensaje(cajaEmailError, "Introduce tu email!", "error", "bi-x-circle");
        return false;

    } else if (!regexEmail.test(email)) {
        mostrarMensaje(cajaEmailError, "Email no válido!", "error", "bi-x-circle");
        return false;

    } else {
        mostrarMensaje(cajaEmailError, "Email válido", "success", "bi-check-circle");
        return true;
    }
}

// Password
function validarPassword() {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    let password = inpPassword.value;

    if (password === "") {
        mostrarMensaje(cajaPasswordError, "Introduce contraseña!", "error", "bi-x-circle");
        return false;

    } else if (!regex.test(password)) { 
        mostrarMensaje(cajaPasswordError, "Debe tener 8 caracteres, mayúsculas, minúsculas, número y símbolo", "error", "bi-x-circle");
        return false;

    } else {  
        mostrarMensaje(cajaPasswordError, "Contraseña válida", "success", "bi-check-circle");
        return true;
    }
}

// Confirm password
function validarConfirmPassword() { 
    if (inpConfirmPassword.value === "") {
        mostrarMensaje(cajaConfirmPasswordError, "Confirma contraseña!", "error", "bi-x-circle");
        return false;

    } else if (inpConfirmPassword.value !== inpPassword.value) {
        mostrarMensaje(cajaConfirmPasswordError, "Las contraseñas no coinciden!", "error", "bi-x-circle");

        bloquearCamposInferiores(); //  si no coinciden, volvemos a bloquear

        return false;

    } else {
        mostrarMensaje(cajaConfirmPasswordError, "Las contraseñas coinciden", "success", "bi-check-circle");

        desbloquearCamposInferiores(); // si coinciden, desbloqueamos los campos inferiores

        return true;
    }    
}


// ===== TARJETA =====
function comprobarMostrarTarjeta() {
    if (inpDireccion.value.trim() !== "" && inpPais.value !== "") {
        tarjetaContainer.style.display = "block";
    } else {
        tarjetaContainer.style.display = "none";
        inpTarjeta.value = "";
    }
}


// ===== RESET SI CAMBIA PASSWORD =====
inpPassword.addEventListener("input", () => {
    inpConfirmPassword.value = "";

    bloquearCamposInferiores(); // Se vuelve a bloquear
});



// Funcionalidad para mostrar/ocultar contraseña
const togglePassword = document.getElementById("togglePassword");
const togglePasswordConfirm = document.getElementById("togglePasswordConfirm");

// Función para alternar el tipo de input entre "password" y "text"
togglePassword.addEventListener("click", function () {

    if (inpPassword.type === "password") {
        inpPassword.type = "text";
        togglePassword.classList.remove("bi-eye");
        togglePassword.classList.add("bi-eye-slash");
    } else {
        inpPassword.type = "password";
        togglePassword.classList.remove("bi-eye-slash");
        togglePassword.classList.add("bi-eye");
    }

});

// Función para alternar el tipo de input entre "password" y "text" para el campo Confirmar Contraseña
togglePasswordConfirm.addEventListener("click", function () {
    if (inpConfirmPassword.type === "password") {
        inpConfirmPassword.type = "text";
        togglePasswordConfirm.classList.remove("bi-eye");
        togglePasswordConfirm.classList.add("bi-eye-slash");
    } else {
        inpConfirmPassword.type = "password";
        togglePasswordConfirm.classList.remove("bi-eye-slash");
        togglePasswordConfirm.classList.add("bi-eye");
    }

});
