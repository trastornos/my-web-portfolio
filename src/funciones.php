<?php
require 'database.php';

function agregarElemento($fecha_reclutamiento, $nombre_completo, $curp, $rfc, $nss) {
    $conn = conectarDB();
    $stmt = $conn->prepare("INSERT INTO elementos (fecha_reclutamiento, Nombre_Completo, curp, rfc, nss) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt) {
        if ($stmt->execute([$fecha_reclutamiento, $nombre_completo, $curp, $rfc, $nss])) {
            echo "Elemento agregado correctamente.";
        } else {
            echo "Error al agregar elemento.";
        }
    } else {
        echo "Error al preparar la consulta.";
    }

    $conn = null; // Cerrar la conexión
}

function obtenerElementos() {
    $conn = conectarDB();
    $sql = "SELECT * FROM elementos";
    $elementos = [];

    try {
        $stmt = $conn->query($sql);
        $elementos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener elementos: " . $e->getMessage();
    }

    $conn = null; // Cerrar la conexión
    return $elementos;
}

function eliminarElemento($id) {
    $conn = conectarDB();
    $stmt = $conn->prepare("DELETE FROM elementos WHERE id = ?");
    
    if ($stmt) {
        $stmt->execute([$id]);
        echo "Elemento eliminado correctamente.";
    } else {
        echo "Error al preparar la consulta para eliminar.";
    }

    $conn = null; // Cerrar la conexión
}
?>
