document.addEventListener('DOMContentLoaded', () => {
    
    const botonesAñadir = document.querySelectorAll('.btn-añadir');

    botonesAñadir.forEach(boton => {
        boton.addEventListener('click', function() {

            const idLibro = this.getAttribute('data-id');


            const url = `/carrito/agregar?id=${idLibro}`;

        
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json(); 
                })
                .then(data => {
                    if (data.status === 'success') {
                        
                        let badge = document.querySelector('.badge.bg-danger');
                        
                        if (badge) {
                            badge.textContent = data.totalProductos;
                        } else {
                      
                            const botonCarrito = document.querySelector('button[data-bs-target="#carritoLateral"]');
                            if (botonCarrito) {
                                botonCarrito.insertAdjacentHTML('beforeend', `
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                        ${data.totalProductos}
                                    </span>
                                `);
                            }
                        }
                        
                        console.log(`Libro ${idLibro} añadido correctamente. Total: ${data.totalProductos}`);
                    }
                })
                .catch(error => {
                    console.error('Hubo un problema con la petición Fetch:', error);
                });
        });
    });
});