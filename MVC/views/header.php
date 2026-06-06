<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papel Verde</title>
    <!-- Links a Bootstrap y css -->
    <link rel="icon"type="image/png" href="img/imgPapelVerde/Logoico.ico">
    <!-- Links a Bootstrap y css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>


<body>

    <!-- Header  -->
    <header class="bg-light">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-xl-3 col-4 d-xl-block d-none">
                    <a href="https://www.facebook.com"> <button class="btn bi bi-facebook fs-5"></button></a>   
                    <a href="https://www.instagram.com"> <button class="btn bi bi-instagram fs-5"></button></a>
                    <a href="https://www.twitter.com"> <button class="btn bi bi-twitter-x fs-5"></button></a>
                </div>

                <div class="col-xl-3 col-4 d-xl-none d-flex justify-content-around">
                    <a href="https://www.facebook.com" class="bi bi-facebook w-25 text-dark"></a>   
                    <a href="https://www.instagram.com" class="bi bi-instagram w-25 text-dark"></a>
                    <a href="https://www.twitter.com" class="bi bi-twitter-x w-25 text-dark"></a>
                </div>
                
                <div class="col-xl-6 col-4 d-flex justify-content-center">
                    <a href="home"><img src="img/imgPapelVerde/Logotipo1.png" class="img-fluid" style="max-width: 150px;" alt="Logo de Papel Verde"></a>
                </div>

                <div class="col-xl-3 col-4 d-flex justify-content-end">
                    <a href="login"><button class="btn bi bi-person fs-5"></button></a>
                    <button class="btn bi bi-cart fs-5"></button>
                </div>
                
            </div>
        </div>
    </header>

    <nav class="nav  border border-1" style='background-image: url("img/bg-footer.jpeg")'>

    <div class="nav-box d-flex justify-content-center m-3">
        <ul class="list-nav">
            <li class="nav-item">
                <a class="link-n" href="home">Home</a>
            </li>
            <li class="nav-item">
                <a class="link-n" href="galeria">Galería</a>
            </li>
            <li class="nav-item">
                <a class="link-n" href="about">About</a>
            </li>
            <li class="nav-item">
                <a class="link-n" href="gestion">Gestión</a>
            </li>
        </ul>

        <form action="/buscar" method="GET" class="d-flex nav-search ">
            <input class = "input-buscador" type="search" name="q" placeholder="Buscar..." required>
            <button class="bi bi-search mx-2 btn-buscar" type="submit"></button>
        </form>
    </div>
        
    
    </nav>

    </body>
</html>