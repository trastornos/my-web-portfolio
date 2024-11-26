<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}

// Aquí deberías agregar la lógica para insertar el nuevo elemento en la base de datos

header('Location: modulo_elementos.php');
exit();
?>
