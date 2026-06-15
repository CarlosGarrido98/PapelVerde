<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papel Verde</title>
    <meta name="description" content="Papel Verde - Tienda online de libros, mangas y cómics. Descubre las mejores colecciones y novedades al mejor precio.">
    <link rel="icon" type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<?php include 'views/header.php'; ?>
<main>
<h1>Lista de productos</h1>

<?php foreach ($productos as $producto): ?>
    <div style="margin-bottom:20px;">
        <h3><?= htmlspecialchars($producto['nombre']) ?></h3>

        <p>Precio: <?= $producto['precio'] ?> €</p>

        <img
            src="uploads/<?= htmlspecialchars($producto['imagen']) ?>"
            width="200"
            alt="<?= htmlspecialchars($producto['nombre']) ?>"
        >
    </div>
<?php endforeach; ?>
</main>

<?php include 'views/footer.php'; ?>
</body>
</html>