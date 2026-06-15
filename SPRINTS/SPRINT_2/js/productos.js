
// productos.js
fetch('http://localhost/PapelVerde/SPRINT_2/api/productos.php')
    .then(res => res.json())
    .then(data => {
        // Mostrar los datos en la consola para verificar que se han recibido correctamente
        console.log(data);

        // Seleccionar el contenedor donde se mostrarán los productos
        const contenedor = document.getElementById('productos');

        // Recorrer los productos y crear el HTML para cada uno
        data.forEach(p => {
            contenedor.innerHTML += `
                <div class="producto">
                    <img src="${p.imagen_url}">
                    <h3>${p.nombre}</h3>
                    <p>${p.precio}€</p>
                    <button onclick="agregarCarrito(${p.id_producto})">
                        Añadir
                    </button>
                </div>
            `;
        });
    });