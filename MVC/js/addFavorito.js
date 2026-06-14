// js/addFavorito.js

document.addEventListener('DOMContentLoaded', () => {
    
    // Usamos delegación de eventos para capturar el clic en cualquier botón de favoritos
    document.addEventListener('click', function(e) {
        const botonFavorito = e.target.closest('.btn-favorito');
        
        if (botonFavorito) {
            e.preventDefault();
            
            const idLibro = botonFavorito.getAttribute('data-id');
            if (!idLibro) return;

            const icono = botonFavorito.querySelector('i');
            const estabaLleno = icono ? icono.classList.contains('bi-heart-fill') : false;
            
            // 1. Efecto Visual Inmediato
            if (icono) {
                icono.classList.toggle('bi-heart');
                icono.classList.toggle('bi-heart-fill');
            }
            actualizarEstiloBoton(botonFavorito, !estabaLleno);

            if (!estabaLleno) {
                crearCorazonFlotante(e);
            }

            botonFavorito.classList.add('animacion-pulso');
            setTimeout(() => botonFavorito.classList.remove('animacion-pulso'), 300);

            // 2. Petición al Servidor (Controller)
            const url = `/favoritos/toggle?id=${idLibro}`;

            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Error en la respuesta del servidor');
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        if (icono) {
                            if (data.esFavorito) {
                                icono.classList.remove('bi-heart');
                                icono.classList.add('bi-heart-fill');
                            } else {
                                icono.classList.remove('bi-heart-fill');
                                icono.classList.add('bi-heart');
                            }
                        }
                        actualizarEstiloBoton(botonFavorito, data.esFavorito);

                        // ✨ NUEVO: Si ha sido eliminado de favoritos y estamos en la vista de favoritos
                        if (!data.esFavorito) {
                            // Buscamos el contenedor de la columna en la cuadrícula (el ID que pusimos en el HTML)
                            const columnaTarjeta = document.getElementById(`item-favorito-${idLibro}`);
                            
                            if (columnaTarjeta) {
                                // Le aplicamos transiciones CSS en tiempo real para un desvanecimiento suave
                                columnaTarjeta.style.transition = 'all 0.4s ease';
                                columnaTarjeta.style.opacity = '0';
                                columnaTarjeta.style.transform = 'scale(0.8)';
                                
                                // Esperamos a que termine la animación (400ms) para quitarla del DOM de verdad
                                setTimeout(() => {
                                    columnaTarjeta.remove();
                                    
                                    // Opcional: Si se borraron todos, recargamos para mostrar el diseño de "Lista vacía"
                                    const restantes = document.querySelectorAll('[id^="item-favorito-"]');
                                    if (restantes.length === 0) {
                                        location.reload(); 
                                    }
                                }, 400);
                            }
                        }

                        // 3. Actualizar contador global en el menú
                        const badgeFavoritos = document.querySelector('.badge-favoritos-total');
                        if (badgeFavoritos) {
                            if (data.totalFavoritos > 0) {
                                badgeFavoritos.textContent = data.totalFavoritos;
                                badgeFavoritos.classList.remove('d-none');
                            } else {
                                badgeFavoritos.classList.add('d-none');
                            }
                        }
                    } else {
                        revertirEstadoIcono(icono, estabaLleno, botonFavorito);
                    }
                })
                .catch(error => {
                    console.error('Error al procesar el favorito:', error);
                    revertirEstadoIcono(icono, estabaLleno, botonFavorito);
                });
        }
    });
});

/**
 * Genera una ráfaga de múltiples corazones flotantes dispersos
 */
function crearCorazonFlotante(evento) {
    const numeroDeCorazones = 6;

    for (let i = 0; i < numeroDeCorazones; i++) {
        const corazon = document.createElement('i');
        corazon.className = 'bi bi-heart-fill corazon-flotante';

        const desviacionX = (Math.random() - 0.5) * 70; 
        const desviacionY = (Math.random() - 0.5) * 30;
        const tamañoAleatorio = 1 + Math.random() * 1.5;
        const retrasoNacimiento = Math.random() * 0.15;
        const duracionAnimacion = 0.6 + Math.random() * 0.4;

        corazon.style.left = `${evento.pageX + desviacionX}px`;
        corazon.style.top = `${evento.pageY + desviacionY}px`;
        corazon.style.fontSize = `${tamañoAleatorio}rem`;
        corazon.style.animationDelay = `${retrasoNacimiento}s`;
        corazon.style.animationDuration = `${duracionAnimacion}s`;

        document.body.appendChild(corazon);

        const tiempoTotal = (retrasoNacimiento + duracionAnimacion) * 1000;
        setTimeout(() => {
            corazon.remove();
        }, tiempoTotal);
    }
}

/**
 * Gestiona el intercambio de clases de Bootstrap dependiendo de si es favorito o no
 */
function actualizarEstiloBoton(boton, esFavorito) {
    if (!boton) return;

    const esBotonPrincipal = boton.classList.contains('btn-outline-danger') || boton.classList.contains('btn-danger');

    if (esBotonPrincipal) {
        if (esFavorito) {
            boton.classList.remove('btn-outline-danger');
            boton.classList.add('btn-danger', 'text-white');
        } else {
            boton.classList.remove('btn-danger', 'text-white');
            boton.classList.add('btn-outline-danger');
        }
    } else {
        if (esFavorito) {
            boton.classList.remove('text-muted');
            boton.classList.add('text-danger');
        } else {
            boton.classList.remove('text-danger');
            boton.classList.add('text-muted');
        }
    }
}

/**
 * Función auxiliar para deshacer los cambios visuales si la petición falla
 */
function revertirEstadoIcono(icono, estabaLleno, boton) {
    if (icono) {
        if (estabaLleno) {
            icono.classList.remove('bi-heart');
            icono.classList.add('bi-heart-fill');
        } else {
            icono.classList.remove('bi-heart-fill');
            icono.classList.add('bi-heart');
        }
    }
    actualizarEstiloBoton(boton, estabaLleno);
}