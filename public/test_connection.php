<?php
require '../src/database.php'; // Ajusta la ruta según tu estructura

try {
    $conn = conectarDB();
    echo "Conexión exitosa a la base de datos.";
} catch (Exception $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
