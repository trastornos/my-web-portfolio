<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo Archivos</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #121212;
            font-family: 'Arial', sans-serif;
            position: relative;
        }
        .background {
            position: absolute;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                45deg,
                rgba(0, 0, 0, 0.8),
                rgba(0, 0, 0, 0.8) 25%,
                rgba(255, 0, 0, 0.1) 25%,
                rgba(255, 0, 0, 0.1) 50%
            );
            z-index: 1;
        }
        .container {
            position: relative;
            background-color: rgba(30, 30, 30, 0.9);
            padding: 1.5em;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            width: 300px; /* Ancho fijo */
            height: 300px; /* Altura fija para hacer el cuadro cuadrado */
            margin: auto;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        h1 {
            color: white; /* Cambiado a blanco */
            margin: 1em 0;
            font-size: 1.5em; 
            text-align: center;
        }
        .container-image {
            margin-bottom: 1em;
        }
        .container-image img {
            max-width: 80px; 
            height: auto;
        }
        .nav-option {
            display: flex;
            align-items: center; /* Centrar verticalmente */
            background-color: #f70909;
            color: black; /* Texto negro */
            padding: 0.5em 1em; 
            border-radius: 5px;
            margin: 0.5em;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        .nav-option i {
            margin-left: 0.5em; /* Espacio entre texto e ícono */
        }
        .nav-option:hover {
            background-color: #c70000;
        }
        nav {
            margin-top: auto; 
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <div class="container-image">
            <img src="ruta/a/tu-imagen.png" alt="Descripción de la imagen">
        </div>
        <h1>Módulo Archivos</h1>
        <nav>
            <a href="subir_archivo.php" class="nav-option">Subir Archivos de Empleado <i class="fas fa-upload"></i></a>
            <a href="modulo_elementos.php" class="nav-option">Regresar al Módulo Elementos</a>
            <a href="logout.php" class="nav-option">Cerrar Sesión</a>
        </nav>
    </div>
</body>
</html>
