const inpNombre = document.getElementById("nombre");
const cajaNombreError = document.getElementById("nameError");

inpNombre.addEventListener("change", validarNombre);



function validarNombre(){
    let nombre = inpNombre.value;
    let numPalabras= nombre.trim().split(" ").length;
    alert(nombre);

    if(nombre.isEmpty){
        cajaNombreError.innerHTML = "Introduce alguna palabra X";
        cajaNombreError.classList.remove("text-success");
        cajaNombreError.classList.add("text-danger");
    }else if(numPalabras>2){
        cajaNombreError.innerHTML = "No puedes poner más de dos palabras X";
        cajaNombreError.classList.remove("text-success");
        cajaNombreError.classList.add("text-danger");
    }else{
        cajaNombreError.innerHTML = "Nombre válido ✔";
        cajaNombreError.classList.add("text-success");
        cajaNombreError.classList.remove("text-danger");
    }
}