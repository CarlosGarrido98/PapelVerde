
const inputEmail = document.getElementById('email');
const cajaEmailError = document.getElementById("emailError");

const inpPassword = document.getElementById('password');

inputEmail.addEventListener("blur",validarEmail);



const form = document.getElementById("LoginForm");

form.addEventListener('submit', function (e) {

    let emailValido = validarEmail();


    if (!emailValido) {
        e.preventDefault(); // Evita el envío del formulario
    } else {
        // Si todo es válido, muestra el modal de inicio de sesión exitoso
        let miModal = new bootstrap.Modal(document.getElementById('loginModal'));
        miModal.show();
         // Evita el envío del formulario para mostrar el modal
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

// Validación del campo Email
function validarEmail() {
    let email = inputEmail.value.trim();
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

const togglePassword = document.getElementById("togglePassword");

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

