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


// Validar al perder el foco del campo Nombre
inpNombre.addEventListener("blur", validarNombre);
inpEmail.addEventListener("blur", validarEmail);
inpPassword.addEventListener("blur", validarPassword);



// Validar al enviar el formulario
const form = document.getElementById("registroForm");


// Validación al enviar el formulario
form.addEventListener("submit", function(e) {

    let nombreValido = validarNombre();
    let emailValido = validarEmail();
    let passwordValido = validarPassword();

    if (!nombreValido || !emailValido || !passwordValido) {
        e.preventDefault(); // 🚫 bloquea envío
    }
});



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
        cajaNombreError.innerHTML = "Introduce nombre y apellidos!";
        cajaNombreError.classList.remove("text-success");
        cajaNombreError.classList.add("text-danger");
        return false;
    // 2. Exactamente 2 palabras (nombre y apellido)
    } else if (numPalabras !== 2) {
        cajaNombreError.innerHTML = "Debes introducir nombre y apellido ( Máximo 2 palabras)";
        cajaNombreError.classList.remove("text-success");
        cajaNombreError.classList.add("text-danger");
        return false;
    // 3. Solo letras y un espacio entre nombre y apellido
    } else if (!regex.test(nombre)) {
        cajaNombreError.innerHTML = "Solo letras, sin números ni símbolos";
        cajaNombreError.classList.remove("text-success");
        cajaNombreError.classList.add("text-danger");
        return false;
    // Si todo es correcto
    } else {
        cajaNombreError.innerHTML = "Nombre válido ✔";
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
        cajaEmailError.innerHTML = "Introduce tu email!";
        cajaEmailError.classList.remove("text-success");
        cajaEmailError.classList.add("text-danger");
        return false;
    //  2. Formato de email válido
    } else if (!regexEmail.test(email)) {
        cajaEmailError.innerHTML = "Introduce un email válido!";
        cajaEmailError.classList.remove("text-success");
        cajaEmailError.classList.add("text-danger");
        return false;
    // Si todo es correcto
    } else {
        cajaEmailError.innerHTML = "Email válido ✔";
        cajaEmailError.classList.add("text-success");
        cajaEmailError.classList.remove("text-danger");
        return true;
    }
}

function validarPassword() {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    if (inpPassword.value === "") {
        cajaPasswordError.innerHTML = "Introduce tu contraseña!";
        cajaPasswordError.classList.remove("text-success");
        cajaPasswordError.classList.add("text-danger");
        return false;
    }   else if (!regex.test(inpPassword.value)) { 
        cajaPasswordError.innerHTML = "La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas, números y símbolos.";
        cajaPasswordError.classList.remove("text-success");
        cajaPasswordError.classList.add("text-danger");
        return false;
    }   else {  
        cajaPasswordError.innerHTML = "Contraseña válida ✔";
        cajaPasswordError.classList.add("text-success");
        cajaPasswordError.classList.remove("text-danger");
        return true;
    }

}