<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['usuario'] = $_POST['usuario'];
} else {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="background"></div> <!-- Fondo de mosaicos -->
<div class="container">
    <div class="container-image"></div> <!-- Para la imagen en el cuadro -->
    <h1>Bienvenido</h1>
    <p class="welcome-message"><?php echo htmlspecialchars($_SESSION['usuario']); ?></p>
    <nav>
        <ul>
            <li><a class="btn" href="modulo_elementos.php">Módulo Elementos</a></li>
            <li><a class="btn cancel" href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</div>

</body>
</html>

