<?php
session_start();

// Si ya hay un usuario logueado, no debemos mostarle esto
if (isset($_SESSION['usuario'])) {
    header('location:index.php', true, 302);
    exit();
}

require 'lib/gestionUsuarios.php';

if ($_POST) {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $clave = isset($_POST['clave']) ? $_POST['clave'] : '';

    $esOk = loginUsuario($usuario, $clave);
    if ($esOk) {
        $_SESSION['usuario'] = $usuario;
        header('location: index.php');
        exit();
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
    <header class="border-bottom">
        <div class="container py-3">
            <a href="./index.php" class="d-flex align-items-center text-decoration-none">
                <i class="bi bi-arrow-left-short fs-4"></i>Volver a la página de inicio
            </a>
        </div>
    </header>
    <!-- /Menu -->

    <!-- Main -->
    <main class="container d-flex flex-column align-items-center justify-content-center" style="height: 80vh;">
        <h1 class="mb-4">Inicia sesión</h1>
        <?php 
        if($_POST) {
            echo "<div class='alert alert-danger' role='alert'><i class='bi bi-exclamation-triangle'></i> El usuario y/o contrseña no son válidos</div>";
        }
        ?>
        <form action="login.php" method="post" style="width:350px">
            <p class="mb-3">
                <label class="form-label" for="usuario">Nombre de usuario</label><br>
                <input class="form-control" type="text" name="usuario" id="usuario" 
                value="<?php echo $_POST && isset($_POST['usuario']) ? $_POST['usuario'] : ''; ?>">
            </p>
            <p class="mb-3">
                <label class="form-label" for="clave">Contraseña</label><br>
                <input class="form-control" type="password" name="clave" id="clave">
            </p>
            <p>
                <input class="btn btn-primary w-100" type="submit" value="Inicia sesión">
            </p>
        </form>
    </main>
    <!-- /Main -->
</body>
</html>
