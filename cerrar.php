<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de la compra</title>
</head>
<body>
    <header>
        <h1>SuperCarrito Shop</h1>
    </header>

    <main>
        <section>
            <p>Sesión cerrada correctamente</p>
        </section>
    </main>

    <nav>
        <p>
            <a href="index.php">Volver</a>
        </p>
    </nav>

    <footer>
        <small><em>&copy; El SuperCarrito de la compra</em></small>
    </footer>
</body>
</html>