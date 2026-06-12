// js/favoritos.js

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar los listeners de los botones de favoritos
    initFavoritos();
});

function initFavoritos() {
    const botonesQuitar = document.querySelectorAll('.btn-quitar-favorito');
    
    botonesQuitar.forEach(boton => {
        // Clonamos y reemplazamos el nodo para evitar duplicados si se llama varias veces
        const nuevoBoton = boton.cloneNode(true);
        boton.parentNode.replaceChild(nuevoBoton, boton);

        nuevoBoton.addEventListener('click', function(e) {
            e.preventDefault();
            const idLibro = this.getAttribute('data-id');
            
            // Llamada asíncrona al controlador
            fetch(`/favoritos/toggle?id=${idLibro}`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        const tarjeta = document.getElementById(`fav-card-${idLibro}`);
                        if (tarjeta) {
                            // Animación de salida elegante
                            tarjeta.style.opacity = '0';
                            tarjeta.style.transform = 'scale(0.8)';
                            tarjeta.style.transition = 'all 0.3s ease';
                            
                            setTimeout(() => {
                                tarjeta.remove();
                                
                                // Si ya no quedan tarjetas de favoritos, recargamos para pintar el estado vacío
                                if (document.querySelectorAll('.fila-favorito').length === 0) {
                                    location.reload();
                                }
                            }, 300);
                        }
                    }
                })
                .catch(err => console.error("Error al procesar favoritos:", err));
        });
    });
}