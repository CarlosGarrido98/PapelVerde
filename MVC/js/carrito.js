const cajTotalProd = document.getElementById("total-prod"); 
const carritoWrapper = document.querySelector('.productos-carrito-wrapper');

const htmlCarritoVacio = `
    <div class="text-center my-5 text-muted carrito-vacio-estado">
        <i class="bi bi-cart-x fs-1"></i>
        <p class="mt-2">El carrito está vacío.</p>
    </div>
`;



if (carritoWrapper) {
    carritoWrapper.addEventListener('click', function(e) {
        
        // Buscamos si el clic ocurrió en tu clase o dentro de ella
        const botonEliminar = e.target.closest('.btn-eliminar-producto');
        
        if (botonEliminar) {
            e.preventDefault();
            
            // Extraemos el ID del atributo data-id del botón
            const idLibro = botonEliminar.getAttribute('data-id');
            
            console.log("Eliminando masivamente con clase el ID:", idLibro);
            
            // Llamamos a la función que borra en el servidor y pantalla
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
                
                // Buscamos la tarjeta física de este libro en el DOM
                const tarjeta = carritoWrapper.querySelector(`.producto-item[data-id="${id}"]`);
                
                // Dentro de eliminarProductoDelCarrito(id), busca este bloque:
                if (tarjeta) {
                    if (data.cantidadRestante > 0) {
                        // SI QUEDAN MÁS: Modificamos quirúrgicamente su cantidad y precio en pantalla
                        const campoCantidad = tarjeta.querySelector('.producto-cantidad');
                        const campoPrecioTotal = tarjeta.querySelector('.producto-precio-total'); // <-- Línea corregida limpia
                        
                        if (campoCantidad) campoCantidad.textContent = data.cantidadRestante;
                        if (campoPrecioTotal) campoPrecioTotal.textContent = parseFloat(data.precioTotalItem).toFixed(2);
                    } else {
                        // SI LLEGÓ A 0: Hacemos desaparecer la tarjeta por completo
                        tarjeta.remove();
                    }
                }
                
                // 2. Actualizamos el contador total del footer (SPAN)
                if (cajTotalProd) {
                    cajTotalProd.textContent = "Total de productos: " + data.totalProductos;
                }
                
                // 3. Actualizamos o removemos el Badge rojo superior
                let badge = document.querySelector('.badge.bg-danger');
                if (badge) {
                    if (data.totalProductos > 0) {
                        badge.textContent = data.totalProductos;
                    } else {
                        badge.remove();
                    }
                }
                
                // 4. Si el carrito se vació por completo de forma global, bloqueamos la botonera
                if (data.totalProductos === 0) {
                    carritoWrapper.innerHTML = htmlCarritoVacio;
                    
                    const btnCheckout = document.querySelector('a[href="carrito/checkout"]');
                    if (btnCheckout) btnCheckout.classList.add('disabled');

                    const borrarCarritoBtn = document.getElementById("borrar-carrito");
                    if (borrarCarritoBtn) borrarCarritoBtn.classList.add('d-none');
                }
            }
        })
        .catch(error => console.error('Error en el Fetch de eliminación:', error));
}

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
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', () => {
    const borrarCarritoBtn = document.getElementById("borrar-carrito");
    if (borrarCarritoBtn) {
        borrarCarritoBtn.addEventListener('click', (e) => {
            e.preventDefault();
            borrarCarrito();
        });
    }

    const botonesAñadir = document.querySelectorAll('.btn-añadir');
    botonesAñadir.forEach(boton => {
        boton.addEventListener('click', function() {
            const idLibro = this.getAttribute('data-id');
            let url = `carrito/agregar?id=${idLibro}`;
            
            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Error en la respuesta del servidor');
                    return response.json(); 
                })
                .then(data => {
                    if (data.status === 'success' && data.producto) {
                        
                        // 1. Quitar el aviso de carrito vacío si existía
                        if (carritoWrapper) {
                            const estadoVacio = carritoWrapper.querySelector('.carrito-vacio-estado');
                            if (estadoVacio) carritoWrapper.textContent = ''; 
                        }

                        // 2. Activar botones de acción del footer
                        const btnCheckout = document.querySelector('a[href="carrito/checkout"]');
                        if (btnCheckout) btnCheckout.classList.remove('disabled');
                        if (borrarCarritoBtn) borrarCarritoBtn.classList.remove('d-none');

                        // 3. Sincronizar el Badge rojo superior de la cabecera
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

                        // 4. Sincronizar el texto del total de productos en el footer
                        if (cajTotalProd) {
                            cajTotalProd.textContent = "Total de productos: " + data.totalProductos; 
                        }

                        // ========================================================
                        // 5. MANEJO DE TARJETAS DINÁMICAS (AGRUPACIÓN POR ID)
                        // ========================================================
                        const tarjetaExistente = carritoWrapper.querySelector(`.producto-item[data-id="${idLibro}"]`);

                        // Mapeo de variables basado en tu objeto Producto
                        const nombre = data.producto.nombre || data.producto.titulo || 'Producto';
                        const precioUnitario = parseFloat(data.producto.precio || 0);
                        const imagen = data.producto.imagen || data.producto.imagen_url || 'img/imgPapelVerde/Logotipo1.png';
                        
                        // Leemos la cantidad que viene directamente calculada por tu PHP
                        const cantidadReal = data.producto.cantidad; 
                        const precioTotalCalculado = precioUnitario * cantidadReal;

                        if (tarjetaExistente) {
                            // SI YA EXISTE EN PANTALLA: Solo actualizamos los textos internos
                            const campoCantidad = tarjetaExistente.querySelector('.producto-cantidad');
                            const campoPrecioTotal = tarjetaExistente.querySelector('.producto-precio-total');

                            if (campoCantidad) campoCantidad.textContent = cantidadReal;
                            if (campoPrecioTotal) campoPrecioTotal.textContent = precioTotalCalculado.toFixed(2);
                        } else {
                            // SI NO EXISTE EN PANTALLA: Inyectamos el bloque HTML por primera vez
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
                                </div>
                            `;
                            carritoWrapper.insertAdjacentHTML('beforeend', nuevaTarjetaHTML);
                        }
                    }
                })
                .catch(error => console.error('Error en la petición Fetch:', error));
        });
    });
});