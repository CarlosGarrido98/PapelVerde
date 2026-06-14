// js/carrito.js

const cajTotalProd = document.getElementById("total-prod"); 
const cajPrecioTotal = document.getElementById("precio-total-carrito");
const carritoWrapper = document.querySelector('.productos-carrito-wrapper');

const htmlCarritoVacio = `
    <div class="text-center my-5 text-muted carrito-vacio-estado">
        <i class="bi bi-cart-x fs-1"></i>
        <p class="mt-2">El carrito está vacío.</p>
    </div>
`;

// --- 1. FUNCIÓN DE ANIMACIÓN DE VUELO ---
function animarVuelo(elementoClickeado, destinoCarrito) {
    const clon = elementoClickeado.cloneNode(true);
    clon.style.position = 'fixed';
    clon.style.top = elementoClickeado.getBoundingClientRect().top + 'px';
    clon.style.left = elementoClickeado.getBoundingClientRect().left + 'px';
    clon.style.width = '50px';
    clon.style.zIndex = '9999';
    clon.style.transition = 'all 0.6s ease-in-out';
    document.body.appendChild(clon);

    // Mover al carrito
    setTimeout(() => {
        clon.style.top = destinoCarrito.getBoundingClientRect().top + 'px';
        clon.style.left = destinoCarrito.getBoundingClientRect().left + 'px';
        clon.style.opacity = '0';
    }, 10);

    setTimeout(() => clon.remove(), 600);
}

if (carritoWrapper) {
    carritoWrapper.addEventListener('click', function(e) {
        const botonEliminar = e.target.closest('.btn-eliminar-producto');
        
        if (botonEliminar) {
            e.preventDefault();
            const idLibro = botonEliminar.getAttribute('data-id');
            console.log("Eliminando producto con ID:", idLibro);
            borrarProducto(idLibro);
        }
    });
}

function borrarProducto(id) {
    const url = `carrito/borrarProducto?id=${id}`;
    
    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Error al eliminar producto');
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                const tarjeta = carritoWrapper.querySelector(`.producto-item[data-id="${id}"]`);
                
                if (tarjeta) {
                    if (data.cantidadRestante > 0) {
                        const campoCantidad = tarjeta.querySelector('.producto-cantidad');
                        const campoPrecioTotal = tarjeta.querySelector('.producto-precio-total');
                        
                        if (campoCantidad) campoCantidad.textContent = data.cantidadRestante;
                        if (campoPrecioTotal) campoPrecioTotal.textContent = parseFloat(data.precioTotalItem).toFixed(2);
                    } else {
                        tarjeta.remove();
                    }
                }
                
                if (cajTotalProd) {
                    cajTotalProd.textContent = "Total de productos: " + data.totalProductos;
                }
                
                let badge = document.querySelector('.badge.bg-danger');
                if (badge) {
                    if (data.totalProductos > 0) {
                        badge.textContent = data.totalProductos;
                    } else {
                        badge.remove();
                    }
                }
                
                if (data.totalProductos === 0) {
                    carritoWrapper.innerHTML = htmlCarritoVacio;
                    
                    const btnCheckout = document.querySelector('a[href="carrito/checkout"]');
                    if (btnCheckout) btnCheckout.classList.add('disabled');

                    const borrarCarritoBtn = document.getElementById("borrar-carrito");
                    if (borrarCarritoBtn) borrarCarritoBtn.classList.add('d-none');
                }
            }
            calcularTotalCarrito()
        })
        .catch(error => console.error('Error en el Fetch de eliminación:', error));
}

// --- 3. VACIAR CARRITO COMPLETO ---
function borrarCarrito() {
    const url = `carrito/borrarCarrito`;
    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Error en el servidor');
            return response.json(); 
        })
        .then(data => {
            if (carritoWrapper) carritoWrapper.innerHTML = htmlCarritoVacio;
            if (cajTotalProd) cajTotalProd.textContent = 'Total de productos: 0'; 
            
            const badge = document.querySelector('.badge.bg-danger');
            if (badge) badge.remove();

            const btnCheckout = document.querySelector('a[href="carrito/checkout"]');
            if (btnCheckout) btnCheckout.classList.add('disabled');

            const borrarCarritoBtn = document.getElementById("borrar-carrito");
            if (borrarCarritoBtn) borrarCarritoBtn.classList.add('d-none');
            calcularTotalCarrito();
        })
        .catch(error => console.error('Error:', error));
}

function calcularTotalCarrito(){
    let precioProductos = document.querySelectorAll(".producto-precio-total");
    let total = 0;
    
    precioProductos.forEach(precio =>{
        // Suma solo números puros (parseFloat)
        total += parseFloat(precio.textContent);
    });
    
    // Aplica el formato de 2 decimales solo al total final
    cajPrecioTotal.textContent = total.toFixed(2) + " €";
}

// --- 4. INICIALIZACIÓN Y DELEGACIÓN GLOBAL (DOM READY) ---
document.addEventListener('DOMContentLoaded', () => {
    calcularTotalCarrito();

    const borrarCarritoBtn = document.getElementById("borrar-carrito");
    if (borrarCarritoBtn) {
        borrarCarritoBtn.addEventListener('click', (e) => {
            e.preventDefault();
            borrarCarrito();
            calcularTotalCarrito();
        });
    }

    // Usamos delegación en el documento para escuchar los botones de añadir
    document.addEventListener('click', function(e) {
        const botonAñadir = e.target.closest('.btn-añadir');
        
        if (botonAñadir) {
            e.preventDefault();
            const idLibro = botonAñadir.getAttribute('data-id');

            // --- PETICIÓN AL SERVIDOR ---
            let url = `carrito/agregar?id=${idLibro}`;
            
            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Error en la respuesta del servidor');
                    return response.json(); 
                })
                .then(data => {
                    // Gestión de falta de Stock
                    if (data.status === 'no_stock') {
                        let modalStock = document.getElementById('modalNoStock');
                        if (!modalStock) {
                            const modalHTML = `
                                <div class="modal fade" id="modalNoStock" tabindex="-1" aria-labelledby="modalStockLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header text-white border-0" style='background-color: #235437'>
                                                <h5 class="modal-title fw-bold" id="modalStockLabel">
                                                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Stock Límite Alcanzado
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-4 text-center">
                                                <p class="fs-5 mb-1 text-dark text-stock-mensaje"></p>
                                                <small class="text-muted text-stock-disponible"></small>
                                            </div>
                                            <div class="modal-footer border-0 justify-content-center">
                                                <button type="button" class="btn btn-secondary px-4 rounded-pill" style='background-color: #235437' data-bs-dismiss="modal">Entendido</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            document.body.insertAdjacentHTML('beforeend', modalHTML);
                            modalStock = document.getElementById('modalNoStock');
                        }

                        modalStock.querySelector('.text-stock-mensaje').textContent = data.message;
                        modalStock.querySelector('.text-stock-disponible').textContent = `Unidades máximas in inventario: ${data.stockDisponible}`;

                        const bsModal = new bootstrap.Modal(modalStock);
                        bsModal.show();
                        return;
                    }

                    // Gestión de adición exitosa
                    if (data.status === 'success' && data.producto) {
                        if (carritoWrapper) {
                            const estadoVacio = carritoWrapper.querySelector('.carrito-vacio-estado');
                            if (estadoVacio) estadoVacio.remove();
                        }

                        const btnCheckout = document.querySelector('a[href="carrito/checkout"]');
                        if (btnCheckout) btnCheckout.classList.remove('disabled'); 
                        if (borrarCarritoBtn) borrarCarritoBtn.classList.remove('d-none');

                        let badge = document.querySelector('.badge.bg-danger');
                        if (badge) {
                            badge.textContent = data.totalProductos;
                        } else {
                            const botonCarrito = document.querySelector('button[data-bs-target="#carritoLateral"]');
                            if (botonCarrito) {
                                botonCarrito.insertAdjacentHTML('beforeend', `
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                        ${data.totalProductos}
                                    </span>`);
                            }
                        }

                        if (cajTotalProd) {
                            cajTotalProd.textContent = "Total de productos: " + data.totalProductos; 
                        }

                        const tarjetaExistente = carritoWrapper.querySelector(`.producto-item[data-id="${idLibro}"]`);
                        const nombre = data.producto.nombre || data.producto.titulo || 'Producto';
                        const precioUnitario = parseFloat(data.producto.precio || 0);
                        const imagen = data.producto.imagen || data.producto.imagen_url || 'img/imgPapelVerde/Logotipo1.png';
                        const cantidadReal = data.producto.cantidad; 
                        const precioTotalCalculado = precioUnitario * cantidadReal;

                        if (tarjetaExistente) {
                            const campoCantidad = tarjetaExistente.querySelector('.producto-cantidad');
                            const campoPrecioTotal = tarjetaExistente.querySelector('.producto-precio-total');

                            if (campoCantidad) campoCantidad.textContent = cantidadReal;
                            if (campoPrecioTotal) campoPrecioTotal.textContent = precioTotalCalculado.toFixed(2);
                        } else {
                            const nuevaTarjetaHTML = `
                                <div class="card mb-3 border-0 border-bottom pb-2 producto-item" data-id="${idLibro}">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-3">
                                            <img src="${imagen}" class="img-fluid rounded" alt="${nombre}">
                                        </div>
                                        <div class="col-7 ps-2">
                                            <h6 class="card-title mb-0" style="font-size: 0.9rem;">${nombre}</h6>
                                            <p class="card-text text-muted mb-0" style="font-size: 0.8rem;">
                                                Cantidad: <span class="producto-cantidad">${cantidadReal}</span>
                                            </p>
                                            <small class="text-success fw-bold">
                                                $<span class="producto-precio-total">${precioTotalCalculado.toFixed(2)}</span>
                                            </small>
                                        </div>
                                        <div class="col-2 text-end">
                                            <button class="btn text-danger bi bi-trash3 p-1 btn-eliminar-producto" data-id="${idLibro}"></button>
                                        </div>
                                    </div>
                                </div>`;
                            carritoWrapper.insertAdjacentHTML('beforeend', nuevaTarjetaHTML);
                        }
                    }
           
                const contenedorPrincipal = botonAñadir.closest('.card, .book-card');
                const imgProducto = contenedorPrincipal ? contenedorPrincipal.querySelector('.contenedor-foto') : null;
                const btnCarrito = document.querySelector('button[data-bs-target="#carritoLateral"]');

                if (imgProducto && btnCarrito) {
                    const clon = imgProducto.cloneNode(true);
                    
                    // Posiciones exactas respecto a la pantalla visible (viewport)
                    const rectFoto = imgProducto.getBoundingClientRect();
                    const rectCarrito = btnCarrito.getBoundingClientRect();

                    // Configuración del clon usando FIXED (así no genera barra de scroll abajo)
                    clon.classList.add('parabola-voladora');
                    clon.style.position = 'fixed'; 
                    clon.style.top = `${rectFoto.top}px`;
                    clon.style.left = `${rectFoto.left}px`;
                    clon.style.width = `${rectFoto.width}px`;
                    clon.style.height = `${rectFoto.height}px`; 
                    clon.style.zIndex = '99999'; // Super alto para que vuele por encima de todo
                    clon.style.margin = '0';     // Reseteamos márgenes heredados que puedan desviarlo

                    document.body.appendChild(clon);

                    // Iniciamos el vuelo de forma milimétrica
                    setTimeout(() => {
                        // Apuntamos al centro matemático exacto del botón del carrito en la pantalla actual
                        const destinoTop = rectCarrito.top + (rectCarrito.height / 2);
                        const destinoLeft = rectCarrito.left + (rectCarrito.width / 2);

                        clon.style.top = `${destinoTop}px`;
                        clon.style.left = `${destinoLeft}px`;
                        
                        // Se encoge y rota elegantemente
                        clon.style.transform = 'translate(-50%, -50%) scale(0.1) rotate(45deg)';
                        clon.style.opacity = '0.1';
                    }, 50);

                    // Eliminar clon al terminar
                    setTimeout(() => {
                        clon.remove();
                        btnCarrito.classList.add('onda-carrito-suave');
                        setTimeout(() => btnCarrito.classList.remove('onda-carrito-suave'), 800);
                    }, 1200);
                }

                    calcularTotalCarrito();
                })
                .catch(error => console.error('Error en la petición Fetch:', error));
        }
    });
});