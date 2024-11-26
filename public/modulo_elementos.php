<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}

// Incluir archivo de conexión a la base de datos
include '../src/database.php';
$pdo = conectarDB();

// Manejo de la búsqueda
$busqueda = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['busqueda'])) {
        $busqueda = $_POST['busqueda'];
    }
}

// Obtener elementos de la base de datos
$sql = "SELECT * FROM elementos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$elementos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Filtrar elementos según la búsqueda
if ($busqueda) {
    $elementos = array_filter($elementos, function ($elemento) use ($busqueda) {
        return stripos($elemento['Nombre_Completo'], $busqueda) !== false;
    });
}

// Manejo de eliminación
if (isset($_GET['eliminar_id'])) {
    $idEliminar = intval($_GET['eliminar_id']);
    // Eliminar en la base de datos
    $sql = "DELETE FROM elementos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $idEliminar]);
    header('Location: modulo_elementos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Elementos</title>
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
            overflow: hidden;
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
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            width: 90%;
            margin: auto;
            z-index: 2;
            display: flex;
            flex-direction: column;
            height: calc(100% - 20px);
            overflow: auto;
        }
        h1 {
            margin-bottom: 1em;
            color: #f5f5f5;
            font-size: 2em;
            text-align: center;
        }
        p {
            color: white;
            text-align: center;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1em;
        }
        table {
            width: 100%;
            margin-top: 1em;
            color: #f5f5f5;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 0.75em;
            text-align: left;
        }
        th {
            background-color: rgba(255, 0, 0, 0.3);
        }
        tr:nth-child(even) {
            background-color: rgba(255, 0, 0, 0.1);
        }
        .input-group {
            margin-bottom: 1em;
        }
        label {
            display: block;
            margin-bottom: 0.5em;
            color: #f5f5f5;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 0.75em;
            border: 2px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #f70909;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus {
            border-color: red;
            outline: none;
        }
        td a {
            color: #f5f5f5;
            margin-right: 10px;
        }
        td a:hover {
            color: red;
        }
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: rgba(30, 30, 30, 0.9);
            color: white;
            margin: 15% auto; 
            padding: 20px;
            border-radius: 10px;
            width: 80%; 
            max-width: 600px; 
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: white;
            text-decoration: none;
            cursor: pointer;
        }
        .button-group-modal {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
    <script>
        function confirmarEliminar() {
            return confirm("¿Estás seguro de que deseas eliminar este elemento?");
        }

        function openModal(elementId) {
            const modal = document.getElementById("modal_" + elementId);
            modal.style.display = "block";
        }

        function closeModal(elementId) {
            const modal = document.getElementById("modal_" + elementId);
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <h1>Módulo Elementos</h1>
        <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></p>

        <div class="button-group">
            <a class="btn" href="logout.php">Cerrar Sesión</a>
            <a class="btn" href="agregar_elemento.php">Agregar</a>
        </div>

        <form method="POST">
            <div class="input-group">
                <label for="busqueda">Buscar Elemento:</label>
                <input type="text" id="busqueda" name="busqueda" value="<?php echo htmlspecialchars($busqueda); ?>" placeholder="Nombre del elemento...">
            </div>
            <button type="submit" class="btn">Buscar</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha de Reclutamiento</th>
                    <th>Nombre Completo</th>
                    <th>CURP</th>
                    <th>RFC</th>
                    <th>NSS</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($elementos)): ?>
                    <tr>
                        <td colspan="7">No se encontraron elementos.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($elementos as $elemento): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($elemento['id']); ?></td>
                            <td><?php echo htmlspecialchars($elemento['fecha_reclutamiento']); ?></td>
                            <td><?php echo htmlspecialchars($elemento['Nombre_Completo']); ?></td>
                            <td><?php echo htmlspecialchars($elemento['curp']); ?></td>
                            <td><?php echo htmlspecialchars($elemento['rfc']); ?></td>
                            <td><?php echo htmlspecialchars($elemento['nss']); ?></td>
                            <td>
                                <a href="javascript:void(0);" onclick="openModal(<?php echo htmlspecialchars($elemento['id']); ?>)" title="Documentos"><i class="fas fa-file-alt"></i></a>
                                <a href="editar_elemento.php?id=<?php echo htmlspecialchars($elemento['id']); ?>" title="Editar"><i class="fas fa-edit"></i></a>
                                <a href="modulo_elementos.php?eliminar_id=<?php echo htmlspecialchars($elemento['id']); ?>" onclick="return confirmarEliminar();" title="Borrar"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>

                        <!-- Modal para documentos -->
                        <div id="modal_<?php echo htmlspecialchars($elemento['id']); ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal(<?php echo htmlspecialchars($elemento['id']); ?>)">&times;</span>
                                <h2>Documentos de <?php echo htmlspecialchars($elemento['Nombre_Completo']); ?></h2>
                                <ul>
                                    <?php
                                    // Obtener documentos relacionados con el elemento
                                    $sqlDocs = "SELECT * FROM documentos WHERE elemento_id = :elemento_id";
                                    $stmtDocs = $pdo->prepare($sqlDocs);
                                    $stmtDocs->execute(['elemento_id' => $elemento['id']]);
                                    $documentos = $stmtDocs->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    if (empty($documentos)): ?>
                                        <li>No hay documentos guardados. <a href="subir_archivo.php?elemento_id=<?php echo htmlspecialchars($elemento['id']); ?>">Haz clic aquí para subir documentos.</a></li>
                                    <?php else: ?>
                                        <?php foreach ($documentos as $doc): ?>
                                            <li>
                                                <a href="download.php?file=<?php echo urlencode($doc['nombre_archivo']); ?>" style="color: #f5f5f5;">
                                                    <?php echo htmlspecialchars($doc['nombre_archivo']); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                                <div class="button-group-modal">
                                    <a href="subir_archivo.php?elemento_id=<?php echo htmlspecialchars($elemento['id']); ?>" class="btn">Subir más documentos</a>
                                    <!-- Se ha eliminado la opción de "Descargar todos los documentos" -->
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

