<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Crear Producto | Papel Verde  </title>
    <!-- Links a Bootstrap y css -->
    <link rel="icon"type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <!-- Links a Bootstrap y css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<?php include 'views/header.php'; ?>

<main>


<form action="/guardarProducto" method="POST">
s

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header text-white"
             style='background-image:url("img/imgPapelVerde/bg-footer.webp")'>

            <h3 class="mb-0">
                
                Añadir Producto
            </h3>

        </div>

        <div class="card-body">

            <form action="/guardarProducto" method="POST">

                <!-- DATOS GENERALES -->

                <div class="mb-3">
                    <label class="form-label">
                        Nombre
                    </label>

                    <input type="text"
                           name="nombre"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Precio
                    </label>

                    <input type="number"
                           step="0.01"
                           name="precio"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Stock
                    </label>

                    <input type="number"
                           name="stock"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Imagen de Portada
                    </label>

                    <input
                            type="file"
                            id="foto"
                            name="foto"
                            class="form-control"
                            ccept="image/*">

                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Sinopsis
                    </label>

                    <textarea
                        name="sinopsis"
                        rows="4"
                        class="form-control"></textarea>
                </div>

                <!-- TIPO -->

                <div class="mb-4">

                    <label class="form-label">
                        Tipo de producto
                    </label>

                    <select id="tipoProducto"
                            name="tipo"
                            class="form-select">

                        <option value="">
                            Selecciona...
                        </option>

                        <option value="libro">
                            Libro
                        </option>

                        <option value="comic">
                            Comic
                        </option>

                        <option value="manga">
                            Manga
                        </option>

                    </select>

                </div>

                <!-- LIBRO -->

                <div id="camposLibro"
                     style="display:none;">

                    <h5 class="mb-3">
                        Datos del Libro
                    </h5>

                    <input type="text"
                           name="autor_libro"
                           class="form-control mb-2"
                           placeholder="Autor">

                    <input type="text"
                           name="editorial_libro"
                           class="form-control mb-2"
                           placeholder="Editorial">

                    <input type="text"
                           name="isbn_libro"
                           class="form-control mb-2"
                           placeholder="ISBN">

                    <input type="number"
                           name="num_paginas"
                           class="form-control mb-4"
                           placeholder="Número de páginas">

                </div>

                <!-- COMIC -->

                <div id="camposComic"
                     style="display:none;">

                    <h5 class="mb-3">
                        Datos del Comic
                    </h5>

                    <input type="text"
                           name="autor_comic"
                           class="form-control mb-2"
                           placeholder="Autor">

                    <input type="text"
                           name="ilustrador"
                           class="form-control mb-2"
                           placeholder="Ilustrador">

                    <input type="text"
                           name="editorial_comic"
                           class="form-control mb-2"
                           placeholder="Editorial">

                    <input type="number"
                           name="numero"
                           class="form-control mb-2"
                           placeholder="Número">

                    <input type="text"
                           name="isbn_comic"
                           class="form-control mb-4"
                           placeholder="ISBN">

                </div>

                <!-- MANGA -->

                <div id="camposManga"
                     style="display:none;">

                    <h5 class="mb-3">
                        Datos del Manga
                    </h5>

                    <input type="text"
                           name="autor_manga"
                           class="form-control mb-2"
                           placeholder="Autor">

                    <input type="text"
                           name="editorial_manga"
                           class="form-control mb-2"
                           placeholder="Editorial">

                    <input type="number"
                           name="volumen"
                           class="form-control mb-2"
                           placeholder="Volumen">

                    <input type="text"
                           name="coleccion"
                           class="form-control mb-2"
                           placeholder="Colección">

                    <input type="text"
                           name="isbn_manga"
                           class="form-control mb-4"
                           placeholder="ISBN">

                </div>

                <button type="submit"
                        class="btn btn-success">

                    <i class="bi bi-check-circle"></i>
                    Crear Producto

                </button>

            </form>

        </div>

    </div>

</div>


</form>



</main>
<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/crearProducto.js"></script>
</body>    

</html>
