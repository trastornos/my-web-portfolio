<?php
function conectarDB() {
    // Configuración de la base de datos
    $config = [
        'host' => 'localhost',
        'db' => 'fromateria_vape',
        'user' => 'root',
        'pass' => '',
    ];

    try {
        $pdo = new PDO("mysql:host={$config['host']};dbname={$config['db']};charset=utf8", $config['user'], $config['pass']);
        // Configurar el modo de error de PDO para lanzar excepciones
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Log de error en un archivo (opcional)
        error_log("Error de conexión: " . $e->getMessage(), 3, 'error_log.txt');
        echo "Error de conexión a la base de datos.";
        exit();
    }
}
?>

