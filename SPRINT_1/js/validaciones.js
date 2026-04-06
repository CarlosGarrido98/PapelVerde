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


// Validar al perder el foco del campo Nombre
inpNombre.addEventListener("blur", validarNombre);
inpEmail.addEventListener("blur", validarEmail);

// Validar al perder el foco del campo Contraseña
inpPassword.addEventListener("blur", validarPassword);

// Validar que las contraseña
inpConfirmPassword.addEventListener("blur",validarConfirmPassword);

// Validar al enviar el formulario
const form = document.getElementById("registroForm");


// Validación al enviar el formulario
form.addEventListener("submit", function(e) {

    let nombreValido = validarNombre();
    let emailValido = validarEmail();
    let passwordValido = validarPassword();
    let confirmPasswordValido = validarConfirmPassword();

    if (!nombreValido || !emailValido || !passwordValido || !confirmPasswordValido) {
        e.preventDefault(); //  bloquea envío
    }
});


/* Funciones */

// Validación del campo Nombre y Apellidos
function validarNombre(){
    // Elimina espacios al inicio y al final, y cuenta palabras
    let nombre = inpNombre.value.trim();
    let numPalabras = nombre.split(/\s+/).filter(p => p.length > 0).length;

    // Regex para permitir solo letras (incluyendo acentos y ñ) y un espacio entre nombre y apellido
    let regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ]+\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+$/;

    // Validaciones
    // 1. No vacío
    if (nombre === "") {
       // cajaNombreError.innerHTML = "Introduce nombre y apellidos!";
        cajaNombreError.innerHTML = '<i class="bi bi-x-circle"></i> Introduce nombre y apellidos!';
        cajaNombreError.classList.remove("text-success");
        cajaNombreError.classList.add("text-danger");
        return false;
    // 2. Exactamente 2 palabras (nombre y apellido)
    } else if (numPalabras !== 2) {
        cajaNombreError.innerHTML = '<i class="bi bi-x-circle"></i> Debes introducir nombre y apellido ( Máximo 2 palabras)';
        cajaNombreError.classList.remove("text-success");
        cajaNombreError.classList.add("text-danger");
        return false;
    // 3. Solo letras y un espacio entre nombre y apellido
    } else if (!regex.test(nombre)) {
        cajaNombreError.innerHTML = '<i class="bi bi-x-circle"></i> Solo letras, sin números ni símbolos';
        cajaNombreError.classList.remove("text-success");
        cajaNombreError.classList.add("text-danger");
        return false;
    // Si todo es correcto
    } else {
        cajaNombreError.innerHTML = '<i class="bi bi-check-circle"></i> Nombre válido';
        cajaNombreError.classList.add("text-success");
        cajaNombreError.classList.remove("text-danger");
        return true;
    }
}

// Validación del campo Email
function validarEmail() {
    // Elimina espacios al inicio y al final
    let email = inpEmail.value.trim();
    let regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    //  Validaciones
    //  1. No vacío
    if (email === "") {
        cajaEmailError.innerHTML = '<i class="bi bi-x-circle"></i> Introduce tu email!'; 
        cajaEmailError.classList.remove("text-success");
        cajaEmailError.classList.add("text-danger");
        return false;
    //  2. Formato de email válido
    } else if (!regexEmail.test(email)) {
        cajaEmailError.innerHTML = '<i class="bi bi-x-circle"></i> Introduce un email válido!';
        cajaEmailError.classList.remove("text-success");
        cajaEmailError.classList.add("text-danger");
        return false;
    // Si todo es correcto
    } else {
        cajaEmailError.innerHTML = '<i class="bi bi-check-circle"></i> Email válido';
        cajaEmailError.classList.add("text-success");
        cajaEmailError.classList.remove("text-danger");
        return true;
    }
}

function validarPassword() {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (inpPassword.value === "") {
        cajaPasswordError.innerHTML = '<i class="bi bi-x-circle"></i> Introduce tu contraseña!';
        cajaPasswordError.classList.remove("text-success");
        cajaPasswordError.classList.add("text-danger");
        inpConfirmPassword.disabled = true; //  bloquear
        return false;
    }   else if (!regex.test(inpPassword.value)) { 
        cajaPasswordError.innerHTML = '<i class="bi bi-x-circle"></i> La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas, números y símbolos.';
        cajaPasswordError.classList.remove("text-success");
        cajaPasswordError.classList.add("text-danger");
        inpConfirmPassword.disabled = true; //  bloquear
        return false;
    }   else {  
        validarConfirmPassword();
        cajaPasswordError.innerHTML = '<i class="bi bi-check-circle"></i> Contraseña válida';
        cajaPasswordError.classList.add("text-success");
        cajaPasswordError.classList.remove("text-danger");
        inpConfirmPassword.disabled = false; //  desbloquear
        return true;
    }

}

// Validación del campo Confirmar Contraseña
function validarConfirmPassword() { 
    //  1. No vacío
    if (inpConfirmPassword.value === "") {
        cajaConfirmPasswordError.innerHTML = '<i class="bi bi-x-circle"></i> Confirma tu contraseña!';
        cajaConfirmPasswordError.classList.remove("text-success");
        cajaConfirmPasswordError.classList.add("text-danger");
        return false;
    //  2. Coincidir con el campo Contraseña
    } else if (inpConfirmPassword.value !== inpPassword.value) {
        cajaConfirmPasswordError.innerHTML = '<i class="bi bi-x-circle"></i> Las contraseñas no coinciden!';
        cajaConfirmPasswordError.classList.remove("text-success");
        cajaConfirmPasswordError.classList.add("text-danger");
        return false;
    // Si todo es correcto
    } else { cajaConfirmPasswordError.innerHTML = '<i class="bi bi-check-circle"></i> Contraseña coincide';
        cajaConfirmPasswordError.classList.add("text-success");
        cajaConfirmPasswordError.classList.remove("text-danger");
        return true;
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


