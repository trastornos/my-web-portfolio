<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['archivo'])) {
    $archivo = basename($_GET['archivo']);
    $rutaArchivo = __DIR__ . '/uploads/' . $archivo;

    if (file_exists($rutaArchivo)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $archivo . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($rutaArchivo));
        readfile($rutaArchivo);
        exit;
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "No se ha especificado un archivo.";
}
?>

