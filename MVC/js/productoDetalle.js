const btnFavorito = document.getElementById("btn-fav");

if (btnFavorito) {
    btnFavorito.addEventListener("click", function() {
        let idLibro = this.getAttribute("data-id");
        
        // 1. Hacemos la petición asíncrona a tu ruta de PHP / Laravel
        fetch(`/favoritos/toggle?id=${idLibro}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la comunicación con el servidor");
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    // 2. Buscamos el icono de corazón dentro de este botón
                    const icono = this.querySelector('i');
                    
                    if (icono) {
                        // 3. Si el servidor dice que ahora ES favorito, rellenamos el corazón
                        if (data.esFavorito) {
                            icono.classList.remove('bi-heart');
                            icono.classList.add('bi-heart-fill', 'text-danger');
                        } else {
                            // Si lo quitó de favoritos, lo volvemos a dejar vacío
                            icono.classList.remove('bi-heart-fill', 'text-danger');
                            icono.classList.add('bi-heart');
                        }
                    }
                }
            })
            .catch(error => {
                console.error("Hubo un problema al procesar la solicitud:", error);
            });
    });
}