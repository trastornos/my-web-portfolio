<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="background"></div> <!-- Fondo de mosaicos -->
    <div class="container">
        <div class="container-image"></div> <!-- Para la imagen en el cuadro -->
        <h1>Iniciar Sesión</h1>
        <form action="bienvenida.php" method="post">
            <div class="input-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="input-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <div class="button-group">
                <input type="submit" value="Iniciar Sesión" class="btn">
                <input type="button" value="Cancelar" class="btn cancel" onclick="window.location.href='index.html'">
            </div>
        </form>
    </div>
</body>
</html>
