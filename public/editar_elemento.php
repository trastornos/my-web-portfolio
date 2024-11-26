<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}

include '../src/database.php'; // Asegúrate de que la ruta sea correcta
$pdo = conectarDB(); // Conectar a la base de datos

// Verificar si se pasó un ID
if (!isset($_GET['id'])) {
    echo "ID no especificado.";
    exit();
}

$id = $_GET['id'];
$mensaje = ''; // Variable para el mensaje

// Obtener el elemento de la base de datos
$sql = "SELECT * FROM elementos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$elemento = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró el elemento
if (!$elemento) {
    echo "Elemento no encontrado.";
    exit();
}

// Actualizar datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $elementoActualizado = [
        'id' => $id,
        'fecha_reclutamiento' => sprintf('%04d-%02d-%02d', intval($_POST['anio_reclutamiento']), intval($_POST['mes_reclutamiento']), intval($_POST['dia_reclutamiento'])),
        'primerA' => $_POST['primerA'],
        'segundoA' => $_POST['segundoA'],
        'Nombre_Completo' => $_POST['Nombre_Completo'],
        'nss' => $_POST['nss'],
        'curp' => $_POST['curp'],
        'ine' => $_POST['ine'],
        'rfc' => $_POST['rfc'],
        'sexo' => $_POST['sexo'],
        'escolaridad' => $_POST['escolaridad'],
        'lugarnacimiento' => $_POST['lugarnacimiento'],
        'fechanacimiento' => $_POST['fechanacimiento'],
        'edad' => $_POST['edad'],
        'estadocivil' => $_POST['estadocivil'],
        'domicilio' => $_POST['domicilio'],
        'colonia' => $_POST['colonia'],
        'municipio' => $_POST['municipio'],
        'cp' => $_POST['cp'],
        'estado' => $_POST['estado'],
    ];

    // Actualizar el elemento en la base de datos
    $sql = "UPDATE elementos SET 
            fecha_reclutamiento = :fecha_reclutamiento,
            primerA = :primerA,
            segundoA = :segundoA,
            Nombre_Completo = :Nombre_Completo,
            nss = :nss,
            curp = :curp,
            ine = :ine,
            rfc = :rfc,
            sexo = :sexo,
            escolaridad = :escolaridad,
            lugarnacimiento = :lugarnacimiento,
            fechanacimiento = :fechanacimiento,
            edad = :edad,
            estadocivil = :estadocivil,
            domicilio = :domicilio,
            colonia = :colonia,
            municipio = :municipio,
            cp = :cp,
            estado = :estado
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute($elementoActualizado);
        echo "<script>
                alert('¡Éxito! Elemento actualizado correctamente.');
                window.location.href = 'modulo_elementos.php';
              </script>";
        exit();
    } catch (PDOException $e) {
        $mensaje = "Error al actualizar el elemento: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Elemento</title>
    <link rel="stylesheet" href="style.css"> <!-- Enlaza tu CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #218838;
        }
        .alert {
            margin-top: 15px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Elemento</h1>
        <p>Por favor, complete el formulario a continuación.</p>
        <form method="POST">
            <div class="grid">
                <input type="number" name="dia_reclutamiento" required placeholder="Día" value="<?php echo htmlspecialchars(date('d', strtotime($elemento['fecha_reclutamiento']))); ?>" min="1" max="31">
                <input type="number" name="mes_reclutamiento" required placeholder="Mes" value="<?php echo htmlspecialchars(date('m', strtotime($elemento['fecha_reclutamiento']))); ?>" min="1" max="12">
                <input type="number" name="anio_reclutamiento" required placeholder="Año" value="<?php echo htmlspecialchars(date('Y', strtotime($elemento['fecha_reclutamiento']))); ?>">
                <input type="date" name="fechanacimiento" required value="<?php echo htmlspecialchars($elemento['fechanacimiento']); ?>">
                
                <input type="text" name="primerA" required placeholder="Primer Apellido" value="<?php echo htmlspecialchars($elemento['primerA']); ?>">
                <input type="text" name="segundoA" required placeholder="Segundo Apellido" value="<?php echo htmlspecialchars($elemento['segundoA']); ?>">
                <input type="text" name="Nombre_Completo" required placeholder="Nombre Completo" value="<?php echo htmlspecialchars($elemento['Nombre_Completo']); ?>">
                <input type="text" name="nss" required placeholder="NSS" value="<?php echo htmlspecialchars($elemento['nss']); ?>">
                
                <input type="text" name="curp" required placeholder="CURP" value="<?php echo htmlspecialchars($elemento['curp']); ?>">
                <input type="text" name="ine" required placeholder="INE" value="<?php echo htmlspecialchars($elemento['ine']); ?>">
                <input type="text" name="rfc" required placeholder="RFC" value="<?php echo htmlspecialchars($elemento['rfc']); ?>">
                <input type="text" name="sexo" required placeholder="Sexo" value="<?php echo htmlspecialchars($elemento['sexo']); ?>">
                
                <input type="text" name="escolaridad" required placeholder="Escolaridad" value="<?php echo htmlspecialchars($elemento['escolaridad']); ?>">
                <input type="text" name="lugarnacimiento" required placeholder="Lugar de Nacimiento" value="<?php echo htmlspecialchars($elemento['lugarnacimiento']); ?>">
                <input type="number" name="edad" required placeholder="Edad" value="<?php echo htmlspecialchars($elemento['edad']); ?>">
                <input type="text" name="estadocivil" required placeholder="Estado Civil" value="<?php echo htmlspecialchars($elemento['estadocivil']); ?>">
                
                <input type="text" name="domicilio" required placeholder="Domicilio" value="<?php echo htmlspecialchars($elemento['domicilio']); ?>">
                <input type="text" name="colonia" required placeholder="Colonia" value="<?php echo htmlspecialchars($elemento['colonia']); ?>">
                <input type="text" name="municipio" required placeholder="Municipio" value="<?php echo htmlspecialchars($elemento['municipio']); ?>">
                <input type="text" name="cp" required placeholder="Código Postal" value="<?php echo htmlspecialchars($elemento['cp']); ?>">
                
                <input type="text" name="estado" required placeholder="Estado" value="<?php echo htmlspecialchars($elemento['estado']); ?>">
            </div>
            <div>
                <button type="submit">Actualizar</button>
                <button type="reset">Limpiar</button>
            </div>
        </form>
        <?php if ($mensaje): ?>
            <div class="alert"><?php echo $mensaje; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>

