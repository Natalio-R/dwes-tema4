<?php
session_start();

require '../modelo.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>NatShop - Tienda Online</title>
    <meta name="description" content="Tienda online realizada con PHP"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>
<body>
    <!-- Menu -->
    <header class="mb-4 border-bottom">
        <div class="container d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
            <h1 class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none fs-2">
                NatShop
            </h1>
            <ul class="nav nav-pills col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item"><a href="../index.php" class="nav-link px-2">Inicio</a></li>
                <li class="nav-item"><a href="./tienda.php" class="nav-link px-2">Tienda</a></li>
                <li class="nav-item"><a href=".pagina_privada.php" class="nav-link active px-2">Página Privada</a></li>
                <li class="nav-item"><a href="../pagina_publica.php" class="nav-link px-2">Página Pública</a></li>
            </ul>
            <div class="dropdown text-end">
                <div class="d-flex align-items-center justify-content-end">
                    <a class="me-4 btn btn-light" href="./carrito.php">
                        <i class="bi bi-cart fs-5"></i> Hay <?= totalProductos() ?> item(s)
                    </a>
                    <div class="d-block link-dark text-decoration-none dropdown-toggle fs-5" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> Perfil
                    </div>
                    <ul class="dropdown-menu text-small px-2" style="">
                        <?php 
                        if(isset($_SESSION['usuario'])) {
                            echo "<li><a class='btn btn-light w-100' href='#'><i class='bi bi-gear'></i> Ajustes</a></li>";
                            echo "<li><hr class='dropdown-divider'></li>";
                            echo "<a href='./privado/logout.php' class='btn btn-outline-danger w-100'><i class='bi bi-box-arrow-right'></i> Cerrar Sesión</a>";
                        } else {
                            echo "<a href='./login.php' class='btn btn-secondary w-100'><i class='bi bi bi-box-arrow-in-right'></i> Iniciar Sesión</a>";
                            echo "<li><hr class='dropdown-divider'></li>";
                            echo "<a href='./registro.php' class='btn btn-info w-100'><i class='bi bi-plus-circle'></i> Registrarse</a>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- /Menu -->

    <!-- Main -->
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Página Privada</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Esta es la página privada donde todos los usuarios no pueden acceder, salvo que estén logueados.</p>
        </div>
    </div>
    <!-- /Main -->

    <!-- Footer --> 
    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-muted">Inicio</a></li>
                <li class="nav-item"><a href="./tienda.php" class="nav-link px-2 text-muted">Tienda</a></li>
                <li class="nav-item"><a href="./pagina_privada.php" class="nav-link px-2 text-muted">Página Privada</a></li>
                <li class="nav-item"><a href="../pagina_publica.php" class="nav-link px-2 text-muted">Página Pública</a></li>
            </ul>
            <p class="text-center text-muted">&copy; 2022 NatShop, Inc</p>
        </footer>
    </div>
    <!-- /Footer -->

    <!--  Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
