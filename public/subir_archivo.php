<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}

// Conexión a la base de datos
$host = 'localhost';
$usuario = 'root'; // Cambia esto si es necesario
$contraseña = ''; // Cambia esto a tu contraseña real, si la tienes
$nombreBD = 'fromateria_vape'; // Nombre de la base de datos

$conn = new mysqli($host, $usuario, $contraseña, $nombreBD);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener elemento_id desde GET
$elemento_id = isset($_GET['elemento_id']) ? intval($_GET['elemento_id']) : null;

if ($elemento_id === null) {
    die("Error: elemento_id no está definido.");
}

// Verificar si el elemento_id existe en la base de datos
$result = $conn->query("SELECT * FROM elementos WHERE id = $elemento_id");
if ($result->num_rows === 0) {
    die("Error: elemento_id no existe en la tabla elementos.");
}

// Manejo de la carga de archivos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $archivo = $_FILES['archivo'];

        // Verificar si el archivo es un PDF
        if ($archivo['type'] === 'application/pdf') {
            // Definir la ruta de destino
            $rutaDestino = '/opt/lampp/htdocs/mi_proyecto/public/uploads/' . basename($archivo['name']);

            // Intentar mover el archivo subido
            if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                // Dividir el PDF en páginas
                dividirPDF($rutaDestino, $conn, $elemento_id);
                
                $_SESSION['mensaje'] = 'Archivo subido y dividido correctamente.';
            } else {
                $_SESSION['mensaje'] = 'Error al subir el archivo.';
            }
        } else {
            $_SESSION['mensaje'] = 'El archivo no es un PDF.';
        }
    } else {
        $_SESSION['mensaje'] = 'No se ha subido ningún archivo o ha ocurrido un error.';
    }

    // Redirigir a modulo_elementos.php
    header('Location: modulo_elementos.php');
    exit();
}

function dividirPDF($rutaPDF, $conn, $elemento_id) {
    // Verifica si pdftk está instalado
    if (!shell_exec('which pdftk')) {
        die("pdftk no está instalado en el servidor.");
    }

    $nombreArchivo = pathinfo($rutaPDF, PATHINFO_FILENAME);
    $comando = "pdftk '$rutaPDF' burst output '/opt/lampp/htdocs/mi_proyecto/public/uploads/{$nombreArchivo}_pagina_%d.pdf'";

    // Ejecutar el comando y verificar errores
    exec($comando . " 2>&1", $output, $return_var);
    if ($return_var !== 0) {
        echo "Error al dividir el PDF. Código de retorno: " . $return_var . "<br>";
        echo "Salida: " . implode("\n", $output);
        return;
    }

    // Insertar en la base de datos
    $pagina = 1;
    while (file_exists("/opt/lampp/htdocs/mi_proyecto/public/uploads/{$nombreArchivo}_pagina_{$pagina}.pdf")) {
        $rutaPagina = "/opt/lampp/htdocs/mi_proyecto/public/uploads/{$nombreArchivo}_pagina_{$pagina}.pdf";

        // Definir el nombre de archivo con el formato deseado
        $nombrePagina = "";
        switch ($pagina) {
            case 1: $nombrePagina = "curp"; break;
            case 2: $nombrePagina = "acta"; break;
            case 3: $nombrePagina = "nss"; break;
            case 4: $nombrePagina = "sat"; break;
            case 5: $nombrePagina = "etc"; break;
            default: $nombrePagina = "pagina{$pagina}"; break;
        }

        // Renombrar el archivo
        rename($rutaPagina, "/opt/lampp/htdocs/mi_proyecto/public/uploads/{$nombreArchivo}_{$nombrePagina}.pdf");

        // Crear variables para el nombre y la ruta
        $nombreArchivoGuardado = "{$nombreArchivo}_{$nombrePagina}.pdf";
        $rutaArchivo = "uploads/{$nombreArchivoGuardado}";

        // Insertar en la base de datos
        $stmt = $conn->prepare("INSERT INTO documentos (nombre_archivo, ruta, pagina, elemento_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $nombreArchivoGuardado, $rutaArchivo, $pagina, $elemento_id);

        if (!$stmt->execute()) {
            echo "Error al guardar en la base de datos: " . $stmt->error . "<br>";
        }
        $stmt->close();

        $pagina++;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Documento PDF</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #121212;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: rgba(30, 30, 30, 0.9);
            padding: 1em;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 600px;
            z-index: 2;
        }
        h1 {
            color: #f5f5f5;
            text-align: center;
            margin-bottom: 1em;
        }
        label {
            color: #f5f5f5;
            display: block;
            margin-bottom: 0.5em;
        }
        input[type="file"] {
            width: 100%;
            margin-bottom: 1em;
            padding: 0.75em;
            border-radius: 5px;
            border: 2px solid #ccc;
            background-color: rgba(255, 255, 255, 0.1);
            color: #f5f5f5;
        }
        button {
            display: block;
            width: 100%;
            padding: 0.75em;
            background-color: red;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: white;
        }
        .mensaje {
            color: #f5f5f5;
            text-align: center;
            margin-top: 1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Subir Documento PDF</h1>
        
        <form method="POST" enctype="multipart/form-data">
            <label for="archivo">Selecciona un archivo PDF:</label>
            <input type="file" id="archivo" name="archivo" required accept=".pdf">
            <button type="submit">Subir Documento</button>
            <?php if (!empty($_SESSION['mensaje'])): ?>
                <div class="mensaje"><?php echo htmlspecialchars($_SESSION['mensaje']); unset($_SESSION['mensaje']); ?></div>
            <?php endif; ?>
        </form>

        <div class="button-group" style="margin-top: 1em;">
            <a href="modulo_archivos.php" style="color: #f5f5f5;">Regresar al Módulo Archivos</a>
        </div>
    </div>
</body>
</html>

