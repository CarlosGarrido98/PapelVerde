<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar "<?= htmlspecialchars($busqueda) ?>" | Papel Verde</title>
    
    <link rel="icon" type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .producto-card { border: none; border-radius: 16px; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); background: #ffffff; overflow: hidden; }
        .producto-card:hover { transform: translateY(-6px); box-shadow: 0 12px 25px rgba(37, 75, 54, 0.12) !important; }
        .img-wrap { background-color: #f8f9fa; height: 240px; display: flex; align-items: center; justify-content: center; padding: 20px; position: relative; border-radius: 12px; }
        .img-wrap img { max-height: 100%; object-fit: contain; transition: transform 0.3s ease; }
        .producto-card:hover .img-wrap img { transform: scale(1.03); }
        .btn-fav-flotante { position: absolute; top: 12px; right: 12px; background: #ffffff; border: none; border-radius: 50%; width: 36px; height: 36px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); display: flex; align-items: center; justify-content: center; z-index: 3; transition: all 0.2s ease; }
        .btn-fav-flotante:hover { transform: scale(1.1); }
        .sidebar-filtros { background: #ffffff; border-radius: 16px; padding: 24px; border: 1px solid #eef0ef; }
        .text-papel { color: #254B36; }
        .btn-papel { background-color: #254B36; color: white; border-radius: 10px; font-weight: 500; }
        .btn-papel:hover { background-color: #1a3425; color: white; }
    </style>
</head>
<body class="bg-light">

<?php include 'views/header.php'; ?>

<div class="container py-5">
    
    <div class="mb-5">
        <p class="text-muted mb-1 fs-6">Resultados encontrados para:</p>
        <h2 class="fw-bold text-papel">"<?= htmlspecialchars($busqueda) ?>" 
            <span class="fs-5 text-muted fw-normal ms-2">(<?= $totalResultados ?> artículos)</span>
        </h2>
    </div>

    <div class="row g-4">
        
        <aside class="col-lg-3">
            <div class="sidebar-filtros shadow-sm">
                <h5 class="fw-bold text-papel mb-4"><i class="bi bi-sliders2-vertical me-2"></i>Filtrar por</h5>
                
                <form action="buscar" method="GET">
                    <input type="hidden" name="q" value="<?= htmlspecialchars($busqueda) ?>">

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Categoría</label>
                        <select class="form-select" name="tipo">
                            <option value="todos" <?= $filtroTipo === 'todos' ? 'selected' : '' ?>>Todos los productos</option>
                            <option value="libro" <?= $filtroTipo === 'libro' ? 'selected' : '' ?>>Libros</option>
                            <option value="manga" <?= $filtroTipo === 'manga' ? 'selected' : '' ?>>Mangas</option>
                            <option value="comic" <?= $filtroTipo === 'comic' ? 'selected' : '' ?>>Cómics</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Precio Máximo (€)</label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="number" step="0.01" class="form-control" name="precio_min" placeholder="Mín" value="<?= $precioMin !== null ? $precioMin : '' ?>">
                            <span class="text-muted">a</span>
                            <input type="number" step="0.01" class="form-control" name="precio_max" placeholder="Máx" value="<?= $precioMax !== null ? $precioMax : '' ?>">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Ordenar por</label>
                        <select class="form-select" name="orden">
                            <option value="relevancia" <?= $orden === 'relevancia' ? 'selected' : '' ?>>Últimos añadidos</option>
                            <option value="precio_asc" <?= $orden === 'precio_asc' ? 'selected' : '' ?>>Precio: Más baratos primero</option>
                            <option value="precio_desc" <?= $orden === 'precio_desc' ? 'selected' : '' ?>>Precio: Más caros primero</option>
                            <option value="nombre_asc" <?= $orden === 'nombre_asc' ? 'selected' : '' ?>>Título: A-Z</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-papel w-100 py-2.5 mb-2 shadow-sm">
                        <i class="bi bi-funnel-fill me-2"></i>Refinar Búsqueda
                    </button>
                    
                    <a href="buscar?q=<?= urlencode($busqueda) ?>" class="btn btn-light btn-sm text-muted w-100 py-2">
                        Reiniciar filtros
                    </a>
                </form>
            </div>
        </aside>

        <main class="col-lg-9">
            <?php if (empty($productosEncontrados)): ?>
                <div class="text-center p-5 bg-white rounded-4 shadow-sm border">
                    <i class="bi bi-search-heart text-muted mb-3 d-block" style="font-size: 4rem; opacity: 0.3;"></i>
                    <h4 class="fw-bold text-papel">No hay resultados exactos</h4>
                    <p class="text-muted max-w-md mx-auto">No se encontraron artículos que coincidan con tus criterios o filtros aplicados actuales. Prueba a limpiar los filtros laterales.</p>
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <?php foreach ($productosEncontrados as $prod): ?>
                        <div class="col">
                            <div class="card h-100 producto-card shadow-sm p-3">
                                
                                <button class="btn-fav-flotante btn-favorito" data-id="<?= $prod['id_producto'] ?>">
                                    <i class="bi bi-heart text-danger"></i>
                                </button>

                                <div class="img-wrap mb-3">
                                    <a href="producto?id=<?= $prod['id_producto'] ?>">
                                        <img src="<?= $prod['imagen_url'] ?>" class="img-fluid" alt="<?= htmlspecialchars($prod['nombre']) ?>">
                                    </a>
                                </div>

                                <div class="card-body mt-5 d-flex flex-column justify-content-between">
                                    <div>
                                        <span class="badge mb-2 bg-success-subtle text-success text-uppercase" style="font-size: 0.7rem;">
                                            <?= $prod['tipo'] ?>
                                        </span>
                                        <h5 class="fw-bold mb-1 text-papel" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.8rem; font-size: 1.05rem;">
                                            <a href="producto?id=<?= $prod['id_producto'] ?>" class="text-decoration-none text-reset">
                                                <?= htmlspecialchars($prod['nombre']) ?>
                                            </a>
                                        </h5>
                                        <p class="text-muted small mb-3">
                                            <i class="bi bi-feather me-1"></i><?= htmlspecialchars($prod['autor'] ?? 'Autor no registrado') ?>
                                        </p>
                                    </div>

                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="fw-bold fs-4 text-papel"><?= number_format($prod['precio'], 2, ',', '.') ?> €</span>
                                        </div>
                                        
                                        <button class="btn btn-papel btn-añadir w-100 py-2" data-id="<?= $prod['id_producto'] ?>">
                                            <i class="bi bi-cart-plus me-2"></i>Añadir al carrito
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>

    </div>
</div>

<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/addFavorito.js"></script>
</body>
</html>