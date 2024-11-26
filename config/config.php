<?php
$servername = "localhost";
$username = "tu_usuario"; // Cambia esto según tu configuración
$password = "tu_contraseña"; // Cambia esto según tu configuración
$dbname = "mi_proyecto_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
