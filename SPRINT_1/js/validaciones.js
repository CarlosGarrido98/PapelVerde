// Obtener referencias a elementos del DOM
// Campo Nombre y su caja de error
const inpNombre = document.getElementById("nombre");
const cajaNombreError = document.getElementById("nameError");

// Campo Email y su caja de error
const inpEmail = document.getElementById("email");
const cajaEmailError = document.getElementById("emailError");

// Campo Contraseña y su caja de error
const inpPassword = document.getElementById("password");
const cajaPasswordError = document.getElementById("passwordError"); 

// Campo Confirmar Contraseña y su caja de error
const inpConfirmPassword = document.getElementById("confirmPassword");
const cajaConfirmPasswordError = document.getElementById("confirmPasswordError"); 

// Campos Dirección, País y contenedor de Tarjeta
const inpDireccion = document.getElementById("direccion");
const inpPais = document.getElementById("pais");
const tarjetaContainer = document.getElementById("tarjetaContainer");

// Campo Tarjeta
const inpTarjeta = document.getElementById("tarjeta");


// Validar al perder el foco del campo Nombre
inpNombre.addEventListener("blur", validarNombre);
inpEmail.addEventListener("blur", validarEmail);

// Validar al perder el foco del campo Contraseña
inpPassword.addEventListener("blur", validarPassword);

// Validar que las contraseña
inpConfirmPassword.addEventListener("blur",validarConfirmPassword);

// Mostrar u ocultar el campo Tarjeta al modificar Dirección o País
inpDireccion.addEventListener("input", comprobarMostrarTarjeta);
inpPais.addEventListener("change", comprobarMostrarTarjeta);



// Validar al enviar el formulario
const form = document.getElementById("registroForm");

// Validación al enviar el formulario
form.addEventListener("submit", function(e) {

    let nombreValido = validarNombre();
    let emailValido = validarEmail();
    let passwordValido = validarPassword();
    let confirmPasswordValido = validarConfirmPassword();


    // Si alguna validación falla, bloquea el envío del formulario
    if (!nombreValido || !emailValido || !passwordValido || !confirmPasswordValido ) {
        e.preventDefault(); //  bloquea envío
    }else {

        // Si todo es válido, muestra el modal de registro exitoso
        let miModal = new bootstrap.Modal(document.getElementById('registroModal'));
        miModal.show();
        e.preventDefault();
    }
});


function mostrarMensaje(elemento, mensaje, tipo, iconoClase) {
    elemento.textContent = "";

    let icono = document.createElement("i");
    icono.classList.add("bi", iconoClase);

    let texto = document.createTextNode(" " + mensaje);

    elemento.appendChild(icono);
    elemento.appendChild(texto);

    elemento.classList.remove("text-danger", "text-success");

    if (tipo === "error") {
        elemento.classList.add("text-danger");
    } else {
        elemento.classList.add("text-success");
    }
}

/* Funciones */

// Validación del campo Nombre y Apellidos
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
// Validación del campo Email
function validarEmail() {
    let email = inpEmail.value.trim();
    let regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (email === "") {
        mostrarMensaje(cajaEmailError, "Introduce tu email!", "error", "bi-x-circle");
        return false;

    } else if (!regexEmail.test(email)) {
        mostrarMensaje(cajaEmailError, "Introduce un email válido!", "error", "bi-x-circle");
        return false;

    } else {
        mostrarMensaje(cajaEmailError, "Email válido", "success", "bi-check-circle");
        return true;
    }
}

function validarPassword() {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    let password = inpPassword.value;

    if (password === "") {
        mostrarMensaje(cajaPasswordError, "Introduce tu contraseña!", "error", "bi-x-circle");
        inpConfirmPassword.disabled = true;
        return false;

    } else if (!regex.test(password)) { 
        mostrarMensaje(cajaPasswordError, "Debe tener 8 caracteres, mayúsculas, minúsculas, número y símbolo", "error", "bi-x-circle");
        inpConfirmPassword.disabled = true;
        return false;

    } else {  
        mostrarMensaje(cajaPasswordError, "Contraseña válida", "success", "bi-check-circle");
        inpConfirmPassword.disabled = false;

        validarConfirmPassword(); // 🔥 bien puesto aquí

        return true;
    }
}

// Validación del campo Confirmar Contraseña
function validarConfirmPassword() { 
    if (inpConfirmPassword.value === "") {
        mostrarMensaje(cajaConfirmPasswordError, "Confirma tu contraseña!", "error", "bi-x-circle");
        return false;

    } else if (inpConfirmPassword.value !== inpPassword.value) {
        mostrarMensaje(cajaConfirmPasswordError, "Las contraseñas no coinciden!", "error", "bi-x-circle");
        return false;

    } else {
        mostrarMensaje(cajaConfirmPasswordError, "Contraseña coincide", "success", "bi-check-circle");
        return true;
    }    
}


function comprobarMostrarTarjeta() {
    if (inpDireccion.value.trim() !== "" && inpPais.value !== "") {
        tarjetaContainer.style.display = "block";
    } else {
        tarjetaContainer.style.display = "none";
        document.getElementById("tarjeta").value = ""; // limpiar
    }
}







/* Limpiar campo Confirmar Contraseña y Botón para mirar contraseña*/

// Limpiar el campo Confirmar Contraseña si se modifica el campo Contraseña
inpPassword.addEventListener("input", () => {
    inpConfirmPassword.value = "";
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


