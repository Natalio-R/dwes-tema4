<?php
require 'modelo.php';
session_start();

$productoNuevo = [];

function productoValido($producto)
{
    global $productos;

    $resultado = array_filter($productos, fn($p) => $p['id'] == $producto);

    if (count($resultado) == 1) {
        return $productos[$producto];
    } else {
        return false;
    }
}

if ($_POST) {
    $datos = [
        'producto' => htmlspecialchars(trim($_POST['producto'])),
        'cantidad' => htmlspecialchars(trim($_POST['cantidad']))
    ];

    $argumentos = [
        'producto' => [
            'filter' => FILTER_CALLBACK,
            'options' => 'productoValido'
        ],
        'cantidad' => [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 1]
        ]
    ];

    $validaciones = filter_var_array($datos, $argumentos);

    if ($validaciones['producto'] !== false && $validaciones['cantidad'] !== false) {
        $producto = $datos['producto'];
        $cantidad = $datos['cantidad'];
        $_SESSION[$producto] = $cantidad;
        $productoNuevo[$producto] = $cantidad;
    }
}
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
                <li class="nav-item"><a href="index.php" class="nav-link px-2">Inicio</a></li>
                <li class="nav-item"><a href="./products.php" class="nav-link active px-2">Productos</a></li>
                <?php
                if(isset($_SESSION['usuario'])) {
                    echo "<li class='nav-item'><a href='./privado/offers.php' class='nav-link px-2'>Ofertas</a></li>";
                }
                ?>
            </ul>

            <div class="dropdown text-end">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="me-4">
                        <i class="bi bi-cart fs-5"></i>
                        Hay <?= totalProductos() ?> item(s)
                    </div>
                    <div class="d-block link-dark text-decoration-none dropdown-toggle fs-5" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> Perfil
                        <!-- echo "Bienvenido $_SESSION['usuario]"-->
                    </div>
                    <ul class="dropdown-menu text-small px-2" style="">
                        <?php 
                        if(isset($_SESSION['usuario'])) {
                            echo "<li><a class='dropdown-item' href='#'><i class='bi bi-gear'></i> Ajustes</a></li>";
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
    <main class="container">
        <h2 class="h2">Productos subidos</h2>
        <section>
            <?php
            if ($_SESSION && isset($productoNuevo)) {
                echo "<p style='color:green'>Se ha añadido un nuevo producto</p>"; 
                echo "<p>";
                echo "<ul>";
                echo "<li>" . array_key_first($productoNuevo) . ": " . $productoNuevo[array_key_first($productoNuevo)] . "</li>";
            } else {
                echo "<p>Debes iniciar sesion para poder ver los productos subidos<p>";
            }
            ?>

        </section>
        <hr>
        <div class="section d-flex flex-column align-items-center">
            <h2 class="h2">Añadir un producto nuevo</h2>
            <form action="products.php" method="post" style="width:350px">
                <div class="mb-3">
                    <label for="productInput" class="form-label">Elige un producto</label>
                    <select name="producto" id="producto" class="form-select">
                        <?php 
                        foreach ($productos as $producto) {
                            echo "<option value='{$producto['id']}'>{$producto['valor']}</option>";
                            if (isset($validaciones) && $validaciones['producto'] === false) {
                                echo "<p>$producto no es una opción válida</p>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantityProduct" class="form-label">Elige la cantidad</label>
                    <input type="number" id="cantidad" class="form-control" placeholder="1" name="cantidad">
                    <?php
                    if (isset($validaciones) && $validaciones['cantidad'] === false) {
                        echo "<p style='color:red'>Elige una cantidad mayor que 0</p>";
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Añadir al carrito" class="btn btn-secondary w-100">
                </div>
            </form>
        </div>
    </main>
    <!-- /Main -->


    <!-- Footer -->
    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="./index.php" class="nav-link px-2 text-muted">Inicio</a></li>
                <li class="nav-item"><a href="./products.php" class="nav-link px-2 text-muted">Productos</a></li>
                <?php
                if(isset($_SESSION['usuario'])) {
                    echo "<li class='nav-item'><a href='./privado/offers.php' class='nav-link px-2'>Ofertas</a></li>";
                }
                ?>
            </ul>
            <p class="text-center text-muted">&copy; 2022 NatShop, Inc</p>
        </footer>
    </div>
    <!-- /Footer -->

    <!--  Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>