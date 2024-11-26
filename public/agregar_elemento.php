<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}

include '../src/database.php'; // Asegúrate de que la ruta sea correcta
$pdo = conectarDB(); // Conectar a la base de datos

// Redirigir después de la inserción
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoElemento = [
        'fecha_reclutamiento' => sprintf('%04d-%02d-%02d', intval($_POST['anio_reclutamiento']), intval($_POST['mes_reclutamiento']), intval($_POST['dia_reclutamiento'])),
   'Id' => $_POST['Id'],
    'nombre' => $_POST['nombre'],
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
    'telefono' => $_POST['telefono'],
    'sueldo' => $_POST['sueldo'],
    'mail' => $_POST['mail'],
    'beneficiario' => $_POST['beneficiario'],
    'fotografia' => $_POST['fotografia'],
    'nombrepadre' => $_POST['nombrepadre'],
    'ocupacionpadre' => $_POST['ocupacionpadre'],
    'telefonopadre' => $_POST['telefonopadre'],
    'nombremadre' => $_POST['nombremadre'],
    'ocupacionmadre' => $_POST['ocupacionmadre'],
    'telefonomadre' => $_POST['telefonomadre'],
    'hijoa' => $_POST['hijoa'],
    'hijob' => $_POST['hijob'],
    'nombreesposa' => $_POST['nombreesposa'],
    'dia_registro' => $_POST['dia_registro'],
    'mes_registro' => $_POST['mes_registro'],
    'primaria' => $_POST['primaria'],
    'entidad_federativa' => $_POST['entidad federativa'],
    'años_cursados' => $_POST['años cursados'],
    'documento_recibido' => $_POST['documento recibido'],
    'secundaria' => $_POST['secundaria'],
    'entidad_federativa1' => $_POST['entidad federativa1'],
    'años_cursados1' => $_POST['años cursados1'],
    'documento_recibido1' => $_POST['documento recibido1'],
    'bachillerato' => $_POST['bachillerato'],
    'entidad_federativa2' => $_POST['entidad federativa2'],
    'años_cursados2' => $_POST['años cursados2'],
    'documento_recibido2' => $_POST['documento recibido2'],
    'deportes' => $_POST['deportes'],
    'cual1' => $_POST['cual1'],
    'lo_practica1' => $_POST['lo practica1'],
    'manuales' => $_POST['manuales'],
    'cual2' => $_POST['cual2'],
    'lo_practica2' => $_POST['lo practica2'],
    'fisicas' => $_POST['fisicas'],
    'cual3' => $_POST['cual3'],
    'lo_practica3' => $_POST['lo practica3'],
    'culturales' => $_POST['culturales'],
    'cual4' => $_POST['cual4'],
    'lo_practica4' => $_POST['lo practica4'],
    'otros' => $_POST['otros'],
    'cual5' => $_POST['cual5'],
    'lo_practica5' => $_POST['lo practica5'],
    'cuales_son' => $_POST['cuales son'],
    'cual6' => $_POST['cual6'],
    'lo_practica6' => $_POST['lo practica6'],
    'urbana' => $_POST['urbana'],
    'media' => $_POST['media'],
    'popular' => $_POST['popular'],
    'periferica' => $_POST['periferica'],
    'barriada' => $_POST['barriada'],
    'suburbio' => $_POST['suburbio'],
    'campestre' => $_POST['campestre'],
    'ejidal' => $_POST['ejidal'],
    'centrica' => $_POST['centrica'],
    'lujo' => $_POST['lujo'],
    'casa_sola' => $_POST['casa sola'],
    'casa_en_condominio' => $_POST['casa en condominio'],
    'departamento' => $_POST['departamento'],
    'unidad_habitacional' => $_POST['unidad habitacional'],
    'vivienda_popular' => $_POST['vivienda popular'],
    'interes_social' => $_POST['interes social'],
    'interes_medio' => $_POST['interes medio'],
    'residencial' => $_POST['residencial'],
    'vecindad' => $_POST['vecindad'],
    'choza_o_jacal' => $_POST['choza o jacal'],
    'propia' => $_POST['propia'],
    'pagandola' => $_POST['pagandola'],
    'de_familiares' => $_POST['de familiares'],
    'de_amigos' => $_POST['de amigos'],
    'alquiler' => $_POST['alquiler'],
    'en_comodato' => $_POST['en comodato'],
    'con_credito' => $_POST['con credito'],
    'hipotecario' => $_POST['hipotecario'],
    'infonavit' => $_POST['infonavit'],
    'fovissste' => $_POST['fovissste'],
    'una_recamara' => $_POST['una recamara'],
    'dos_recamaras' => $_POST['dos recamaras'],
    'tres_recamaras' => $_POST['tres recamaras'],
    'mas_de_tres_recamaras' => $_POST['mas de tres recamaras'],
    'sala' => $_POST['sala'],
    'comedor' => $_POST['comedor'],
    'cocina' => $_POST['cocina'],
    'un_baño' => $_POST['un baño'],
    'un_y_medio_baño' => $_POST['un y medio baño'],
    'dos_baños' => $_POST['dos baños'],
    'mas_de_dos_baños' => $_POST['mas de dos baños'],
    'jardin' => $_POST['jardin'],
    'estancia_o_cuarto_de_tv' => $_POST['estancia o cuarto de tv'],
    'biblioteca' => $_POST['biblioteca'],
    'sala_o_salon_de_juegos' => $_POST['sala o salon de juegos'],
    'estudio' => $_POST['estudio'],
    'garage' => $_POST['garage'],
    'cuarto_de_servicio' => $_POST['cuarto de servicio'],
    'un_piso' => $_POST['un piso'],
    'dos_pisos' => $_POST['dos pisos'],
    'mas_de_dos_pisos' => $_POST['mas de dos pisos'],
    'patio' => $_POST['patio'],
    'credito_hipotecario' => $_POST['credito hipotecario'],
    'credito_personal' => $_POST['credito personal'],
    'credito_refaccionario' => $_POST['credito refaccionario'],
    'credito_de_avio' => $_POST['credito de avio'],
    'credito_automotiz' => $_POST['credito automotiz'],
    'credito_comercial' => $_POST['credito comercial'],
    'credito_mercantil' => $_POST['credito mercantil'],
    'credito_departamental' => $_POST['credito departamental'],
    'credito_bancario' => $_POST['credito bancario'],
    'tarjetas_de_credito' => $_POST['tarjetas de credito'],
    'otros_creditos' => $_POST['otros creditos'],
    'adeudo_infonavit' => $_POST['adeudo infonavit'],
    'adeudo_fonacot' => $_POST['adeudo fonacot'],
    'adeudo_fovissste' => $_POST['adeudo fovissste'],
    'adeudos_bancarios' => $_POST['adeudos bancarios'],
    'adeudos_hipotecarios' => $_POST['adeudos hipotecarios'],
    'adeudos_automotrises' => $_POST['adeudos automotrises'],
    'adeudos_mercantiles' => $_POST['adeudos mercantiles'],
    'adeudos_departamentales' => $_POST['adeudos departamentales'],
    'adeudos_comerciales' => $_POST['adeudos comerciales'],
    'pago_hipotecario' => $_POST['pago hipotecario'],
    'pago_de_infonavit' => $_POST['pago de infonavit'],
    'pago_de_fovissste' => $_POST['pago de fovissste'],
    'pago_de_renta' => $_POST['pago de renta'],
    'pago_de_luz' => $_POST['pago de luz'],
    'pago_de_agua' => $_POST['pago de agua'],
    'pago_de_predial' => $_POST['pago de predial'],
    'pago_de_gas' => $_POST['pago de gas'],
    'pago_de_telefono' => $_POST['pago de telefono'],
    'pago_de_transporte' => $_POST['pago de transporte'],
    'pago_de_alimentos' => $_POST['pago de alimentos'],
    'pagos_medicos' => $_POST['pagos medicos'],
    'mantenimiento_de_vivienda' => $_POST['mantenimiento de vivienda'],
    'servicio_de_tv' => $_POST['servicio de tv'],
    'gastos_vacacionales' => $_POST['gastos vacacionales'],
    'haorro' => $_POST['haorro'],
    'educacion' => $_POST['educacion'],
    'utiles_escolares' => $_POST['utiles escolares'],
    'uniformes_escolares' => $_POST['uniformes escolares'],
    'transporte_escolar' => $_POST['transporte escolar'],
    'cuotas_escolares' => $_POST['cuotas escolares'],
    'servicio_medico' => $_POST['servicio medico'],
    'calzado_vestido' => $_POST['calzado vestido'],
    'articulos_de_consumo' => $_POST['articulos de consumo'],
    'articulos_de_aseo' => $_POST['articulos de aseo'],
    'articulos_de_uso_personal' => $_POST['articulos de uso personal'],
    'mantenimiento_de_vehiculos' => $_POST['mantenimiento de vehiculos'],
    'servicio_domestico' => $_POST['servicio domestico'],
    'cuotas_de_clubes' => $_POST['cuotas de clubes'],
    'radio' => $_POST['radio'],
    'televisor' => $_POST['televisor'],
    'equipo_de_sonido' => $_POST['equipo de sonido'],
    'home_teather' => $_POST['home teather'],
    'dvd' => $_POST['dvd'],
    'video_cassetera_vhs' => $_POST['video cassetera vhs'],
    'equipo_de_videojuegos' => $_POST['equipo de videojuegos'],
    'computadora' => $_POST['computadora'],
    'impresora' => $_POST['impresora'],
    'equipo_de_fax' => $_POST['equipo de fax'],
    'estufa' => $_POST['estufa'],
    'refrigerador' => $_POST['refrigerador'],
    'lavadora' => $_POST['lavadora'],
    'secadora' => $_POST['secadora'],
    'licuadora' => $_POST['licuadora'],
    'horno_de_microondas' => $_POST['horno de microondas'],
    'lavavajillas' => $_POST['lavavajillas'],
    'freidora' => $_POST['freidora'],
    'tostador_waflera_sandwichera' => $_POST['tostador, waflera, sandwichera'],
    'extractor_de_jugos' => $_POST['extractoe de jugos'],
    'agua_potable' => $_POST['agua potable'],
    'agua_de_poso' => $_POST['agua de poso'],
    'suministro_po_pipa' => $_POST['suministro po pipa'],
    'agua_de_lluvia' => $_POST['agua de lluvia'],
    'agua_de_garrafon' => $_POST['agua de garrafon'],
    'drenaje_publico' => $_POST['drenaje publico'],
    'fosa_septica' => $_POST['fosa septica'],
    'alumbrado_publico' => $_POST['alumbrado publico'],
    'banquetas' => $_POST['banquetas'],
    'asfalto' => $_POST['asfalto'],
    'pavimento' => $_POST['pavimento'],
    'terraceria' => $_POST['terraceria'],
    'parque' => $_POST['parque'],
    'mercados_publicos' => $_POST['mercados publicos'],
    'sistema_de_vigilancia' => $_POST['sistema de vigilancia'],
    'servicio_postal' => $_POST['servicio postal'],
    'hospitales' => $_POST['hospitales'],
    'centros_medicos' => $_POST['centros medicos'],
    'centros_culturales' => $_POST['centros culturales'],
    'panaderias' => $_POST['panaderias'],
    'energia_electrica' => $_POST['energia electrica'],
    'servicio_telefonico' => $_POST['servicio telefonico'],
    'television_por_cable' => $_POST['television por cable'],
    'recoleccion_de_basura' => $_POST['recoleccion de basura'],
    'seguridad_privada' => $_POST['seguridad privada'],
    'seguridad_publica' => $_POST['seguridad publica'],
    'acceso_controlado' => $_POST['acceso controlado'],
    'transporte_publico' => $_POST['transporte publico'],
    'telefono_publico' => $_POST['telefono publico'],
    'centros_comerciales' => $_POST['centros comerciales'],
    'escuelas_publicas' => $_POST['escuelas publicas'],
    'instalaciones_deportivas' => $_POST['instalaciones deportivas'],
    'jardines' => $_POST['jardines'],
    'vigilancia_nocturna' => $_POST['vigilancia nocturna'],
    'lecherias_publicas' => $_POST['lecherias publicas'],
    'tiendas_rurales' => $_POST['tiendas rurales'],
    'iglesias' => $_POST['iglesias'],
    'bancos' => $_POST['bancos'],
    'suministros_de_gas' => $_POST['suministros de gas'],
    'otros_creditos' => $_POST['otros_creditos']
];

    // Insertar el nuevo elemento en la base de datos
$sql = "INSERT INTO elementos (
    Id, nombre, primerA, segundoA, Nombre_Completo, nss, curp, ine, rfc, sexo, escolaridad, 
    lugarnacimiento, fechanacimiento, edad, estadocivil, domicilio, colonia, municipio, cp, estado, 
    telefono, sueldo, mail, beneficiario, fotografia, nombrepadre, ocupacionpadre, telefonopadre, 
    nombremadre, ocupacionmadre, telefonomadre, hijoa, hijob, nombreesposa, dia_registro, mes_registro, 
    primaria, entidad_federativa, años_cursados, documento_recibido, secundaria, entidad_federativa1, 
    años_cursados1, documento_recibido1, bachillerato, entidad_federativa2, años_cursados2, 
    documento_recibido2, deportes, cual1, lo_practica1, manuales, cual2, lo_practica2, fisicas, 
    cual3, lo_practica3, culturales, cual4, lo_practica4, otros, cual5, lo_practica5, cuales_son, 
    cual6, lo_practica6, urbana, media, popular, periferica, barriada, suburbio, campestre, ejidal, 
    centrica, lujo, casa_sola, casa_en_condominio, departamento, unidad_habitacional, vivienda_popular, 
    interes_social, interes_medio, residencial, vecindad, choza_o_jacal, propia, pagandola, 
    de_familiares, de_amigos, alquiler, en_comodato, con_credito, hipotecario, infonavit, fovissste, 
    una_recamara, dos_recamaras, tres_recamaras, mas_de_tres_recamaras, sala, comedor, cocina, 
    un_baño, un_y_medio_baño, dos_baños, mas_de_dos_baños, jardin, estancia_o_cuarto_de_tv, 
    biblioteca, sala_o_salon_de_juegos, estudio, garage, cuarto_de_servicio, un_piso, dos_pisos, 
    mas_de_dos_pisos, patio, credito_hipotecario, credito_personal, credito_refaccionario, 
    credito_de_avio, credito_automotiz, credito_comercial, credito_mercantil, credito_departamental, 
    credito_bancario, tarjetas_de_credito, otros_creditos, adeudo_infonavit, adeudo_fonacot, 
    adeudo_fovissste, adeudos_bancarios, adeudos_hipotecarios, adeudos_automotrises, 
    adeudos_mercantiles, adeudos_departamentales, adeudos_comerciales, pago_hipotecario, 
    pago_de_infonavit, pago_de_fovissste, pago_de_renta, pago_de_luz, pago_de_agua, 
    pago_de_predial, pago_de_gas, pago_de_telefono, pago_de_transporte, pago_de_alimentos, 
    pagos_medicos, mantenimiento_de_vivienda, servicio_de_tv, gastos_vacacionales, haorro, 
    educacion, utiles_escolares, uniformes_escolares, transporte_escolar, cuotas_escolares, 
    servicio_medico, calzado_vestido, articulos_de_consumo, articulos_de_aseo, 
    articulos_de_uso_personal, mantenimiento_de_vehiculos, servicio_domestico, cuotas_de_clubes, 
    radio, televisor, equipo_de_sonido, home_teather, dvd, video_cassetera_vhs, equipo_de_videojuegos, 
    computadora, impresora, equipo_de_fax, estufa, refrigerador, lavadora, secadora, licuadora, 
    horno_de_microondas, lavavajillas, freidora, tostador_waflera_sandwichera, extractor_de_jugos, 
    agua_potable, agua_de_poso, suministro_po_pipa, agua_de_lluvia, agua_de_garrafon, 
    drenaje_publico, fosa_septica, alumbrado_publico, banquetas, asfalto, pavimento, 
    terraceria, parque, mercados_publicos, sistema_de_vigilancia, servicio_postal, hospitales, 
    centros_medicos, centros_culturales, panaderias, energia_electrica, servicio_telefonico, 
    television_por_cable, recoleccion_de_basura, seguridad_privada, seguridad_publica, 
    acceso_controlado, transporte_publico, telefono_publico, centros_comerciales, 
    escuelas_publicas, instalaciones_deportivas, jardines, vigilancia_nocturna, lecherias_publicas, 
    tiendas_rurales, iglesias, bancos, suministros_de_gas, otros_creditos
) VALUES (
    :Id, :nombre, :primerA, :segundoA, :Nombre_Completo, :nss, :curp, :ine, :rfc, :sexo, 
    :escolaridad, :lugarnacimiento, :fechanacimiento, :edad, :estadocivil, :domicilio, :colonia, 
    :municipio, :cp, :estado, :telefono, :sueldo, :mail, :beneficiario, :fotografia, :nombrepadre, 
    :ocupacionpadre, :telefonopadre, :nombremadre, :ocupacionmadre, :telefonomadre, :hijoa, 
    :hijob, :nombreesposa, :dia_registro, :mes_registro, :primaria, :entidad_federativa, 
    :años_cursados, :documento_recibido, :secundaria, :entidad_federativa1, :años_cursados1, 
    :documento_recibido1, :bachillerato, :entidad_federativa2, :años_cursados2, :documento_recibido2, 
    :deportes, :cual1, :lo_practica1, :manuales, :cual2, :lo_practica2, :fisicas, :cual3, 
    :lo_practica3, :culturales, :cual4, :lo_practica4, :otros, :cual5, :lo_practica5, :cuales_son, 
    :cual6, :lo_practica6, :urbana, :media, :popular, :periferica, :barriada, :suburbio, 
    :campestre, :ejidal, :centrica, :lujo, :casa_sola, :casa_en_condominio, :departamento, 
    :unidad_habitacional, :vivienda_popular, :interes_social, :interes_medio, :residencial, 
    :vecindad, :choza_o_jacal, :propia, :pagandola, :de_familiares, :de_amigos, :alquiler, 
    :en_comodato, :con_credito, :hipotecario, :infonavit, :fovissste, :una_recamara, 
    :dos_recamaras, :tres_recamaras, :mas_de_tres_recamaras, :sala, :comedor, :cocina, 
    :un_baño, :un_y_medio_baño, :dos_baños, :mas_de_dos_baños, :jardin, :estancia_o_cuarto_de_tv, 
    :biblioteca, :sala_o_salon_de_juegos, :estudio, :garage, :cuarto_de_servicio, 
    :un_piso, :dos_pisos, :mas_de_dos_pisos, :patio, :credito_hipotecario, :credito_personal, 
    :credito_refaccionario, :credito_de_avio, :credito_automotiz, :credito_comercial, 
    :credito_mercantil, :credito_departamental, :credito_bancario, :tarjetas_de_credito, 
    :otros_creditos, :adeudo_infonavit, :adeudo_fonacot, :adeudo_fovissste, :adeudos_bancarios, 
    :adeudos_hipotecarios, :adeudos_automotrises, :adeudos_mercantiles, :adeudos_departamentales, 
    :adeudos_comerciales, :pago_hipotecario, :pago_de_infonavit, :pago_de_fovissste, 
    :pago_de_renta, :pago_de_luz, :pago_de_agua, :pago_de_predial, :pago_de_gas, 
    :pago_de_telefono, :pago_de_transporte, :pago_de_alimentos, :pagos_medicos, 
    :mantenimiento_de_vivienda, :servicio_de_tv, :gastos_vacacionales, :haorro, :educacion, 
    :utiles_escolares, :uniformes_escolares, :transporte_escolar, :cuotas_escolares, 
    :servicio_medico, :calzado_vestido, :articulos_de_consumo, :articulos_de_aseo, 
    :articulos_de_uso_personal, :mantenimiento_de_vehiculos, :servicio_domestico, 
    :cuotas_de_clubes, :radio, :televisor, :equipo_de_sonido, :home_teather, :dvd, 
    :video_cassetera_vhs, :equipo_de_videojuegos, :computadora, :impresora, :equipo_de_fax, 
    :estufa, :refrigerador, :lavadora, :secadora, :licuadora, :horno_de_microondas, 
    :lavavajillas, :freidora, :tostador_waflera_sandwichera, :extractor_de_jugos, :agua_potable, 
    :agua_de_poso, :suministro_po_pipa, :agua_de_lluvia, :agua_de_garrafon, :drenaje_publico, 
    :fosa_septica, :alumbrado_publico, :banquetas, :asfalto, :pavimento, :terraceria, 
    :parque, :mercados_publicos, :sistema_de_vigilancia, :servicio_postal, :hospitales, 
    :centros_medicos, :centros_culturales, :panaderias, :energia_electrica, :servicio_telefonico, 
    :television_por_cable, :recoleccion_de_basura, :seguridad_privada, :seguridad_publica, 
    :acceso_controlado, :transporte_publico, :telefono_publico, :centros_comerciales, 
    :escuelas_publicas, :instalaciones_deportivas, :jardines, :vigilancia_nocturna, 
    :lecherias_publicas, :tiendas_rurales, :iglesias, :bancos, :suministros_de_gas, 
    :otros_creditos
)";

    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute($nuevoElemento);
        $_SESSION['mensaje'] = "¡Éxito! Elemento agregado correctamente.";
        header('Location: modulo_elementos.php'); // Redirigir a modulo_elementos.php
        exit();
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error al agregar el elemento: " . $e->getMessage();
    }
}

// Obtener elementos de la base de datos
$sql = "SELECT * FROM elementos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$elementos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Elemento</title>
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
        .element-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .element-table th, .element-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .element-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Formulario de Datos</h1>
        <form method="POST" action="/mi_proyecto/src/procesar_datos.php" enctype="multipart/form-data">
            <!-- Campos del formulario -->
       
        <!-- Información de Registro -->
        
        <div class="form-section">
        <h2>Información de Registro</h2>
        <div class="form-group">
        <label for="dia_registro">Día de Registro</label>
        <input type="number" id="dia_registro" name="dia_registro" min="1" max="31" required>
        </div>
        <div class="form-group">
        <label for="mes_registro">Mes de Registro</label>
        <input type="number" id="mes_registro" name="mes_registro" min="1" max="12" required>
        </div>
        </div>
        
        <!-- Información Personal -->
        <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
        <label for="primerA">Primer Apellido</label>
        <input type="text" id="primerA" name="primerA" required>
        </div>
        <div class="form-group">
        <label for="segundoA">Segundo Apellido</label>
        <input type="text" id="segundoA" name="segundoA" required>
        </div>
        <div class="form-group">
        <label for="segundoA">Nombre Completo</label>
        <input type="text" id="segundoA" name="segundoA" required>
        </div>
        <div class="form-group">
        <label for="nss">NSS</label>
        <input type="text" id="nss" name="nss" required>
        </div>
        <div class="form-group">
        <label for="curp">CURP</label>
        <input type="text" id="curp" name="curp" required>
        </div>
        <div class="form-group">
        <label for="ine">INE</label>
        <input type="text" id="ine" name="ine" required>
        </div>
        <div class="form-group">
        <label for="rfc">RFC</label>
        <input type="text" id="rfc" name="rfc" required>
        </div>
        <div class="form-group">
        <label for="sexo">Sexo</label>
        <select id="sexo" name="sexo" required>
        <option value="" disabled selected>Seleccione...</option>
        <option value="masculino">Masculino</option>
        <option value="femenino">Femenino</option>
        <option value="otro">Otro</option>
        </select>
        </div>
        <div class="form-group">
        <label for="escolaridad">Escolaridad</label>
        <select id="escolaridad" name="escolaridad" required>
        <option value="" disabled selected>Seleccione...</option>
        <option value="ninguna">Ninguna</option>
        <option value="primaria">Primaria</option>
        <option value="secundaria">Secundaria</option>
        <option value="bachillerato">Bachillerato</option>
        <option value="licenciatura">Licenciatura</option>
        <option value="maestria">Maestría</option>
        <option value="doctorado">Doctorado</option>
        </select>
        </div>
        </div>
          <!-- Datos de Nacimiento -->
          <div class="form-section">
            <h2>Datos de Nacimiento</h2>
            <div class="form-group">
                <label for="lugarnacimiento">Lugar de Nacimiento</label>
                <input type="text" id="lugarnacimiento" name="lugarnacimiento" required>
            </div>
            <div class="form-group">
                <label for="fechanacimiento">Fecha de Nacimiento</label>
                <input type="date" id="fechanacimiento" name="fechanacimiento" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad</label>
                <input type="number" id="edad" name="edad" required>
            </div>
            <div class="form-group">
                <label for="estadocivil">Estado Civil</label>
                <select id="estadocivil" name="estadocivil" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="soltero">Soltero</option>
                    <option value="casado">Casado</option>
                    <option value="divorciado">Divorciado</option>
                    <option value="union_libre">Unión Libre</option>
                    <option value="viudo">Viudo</option>
                </select>
            </div>
        </div>
        
        <!-- Domicilio -->
        <div class="form-section">
            <h2>Domicilio</h2>
            <div class="form-group">
                <label for="domicilio">Domicilio</label>
                <input type="text" id="domicilio" name="domicilio" required>
            </div>
            <div class="form-group">
                <label for="colonia">Colonia</label>
                <input type="text" id="colonia" name="colonia" required>
            </div>
            <div class="form-group">
                <label for="municipio">Municipio</label>
                <input type="text" id="municipio" name="municipio" required>
            </div>
            <div class="form-group">
                <label for="cp">Código Postal</label>
                <input type="text" id="cp" name="cp" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="sueldo">Sueldo</label>
                <input type="number" id="sueldo" name="sueldo" required>
            </div>
            <div class="form-group">
                <label for="mail">Correo Electrónico</label>
                <input type="email" id="mail" name="mail" required>
            </div>
            <div class="form-group">
                <label for="beneficiario">Beneficiario</label>
                <input type="text" id="beneficiario" name="beneficiario" required>
            </div>
            <div class="form-group">
                <label for="fotografia">Fotografía (URL)</label>
                <input type="text" id="fotografia" name="fotografia" required>
            </div>
        </div>
        
<!-- Educación -->
<div class="form-section">
    <h2>Educación</h2>
    <div class="form-group">
        <label for="primaria">Primaria</label>
        <input type="text" id="primaria" name="primaria" required>
    </div>
    <div class="form-group">
        <label for="entidad_federativa">Entidad Federativa (Primaria)</label>
        <input type="text" id="entidad_federativa" name="entidad_federativa" required>
    </div>
    <div class="form-group">
        <label for="anos_cursados">Años Cursados (Primaria)</label>
        <input type="number" id="anos_cursados" name="anos_cursados" required>
    </div>
    <div class="form-group">
        <label for="documento_recibido">Documento Recibido (Primaria)</label>
        <input type="text" id="documento_recibido" name="documento_recibido" required>
    </div>
    <div class="form-group">
        <label for="secundaria">Secundaria</label>
        <input type="text" id="secundaria" name="secundaria" required>
    </div>
    <div class="form-group">
        <label for="entidad_federativa1">Entidad Federativa (Secundaria)</label>
        <input type="text" id="entidad_federativa1" name="entidad_federativa1" required>
    </div>
    <div class="form-group">
        <label for="anos_cursados1">Años Cursados (Secundaria)</label>
        <input type="number" id="anos_cursados1" name="anos_cursados1" required>
    </div>
    <div class="form-group">
        <label for="documento_recibido1">Documento Recibido (Secundaria)</label>
        <input type="text" id="documento_recibido1" name="documento_recibido1" required>
    </div>
    <div class="form-group">
        <label for="bachillerato">Bachillerato</label>
        <input type="text" id="bachillerato" name="bachillerato" required>
    </div>
    <div class="form-group">
        <label for="entidad_federativa2">Entidad Federativa (Bachillerato)</label>
        <input type="text" id="entidad_federativa2" name="entidad_federativa2" required>
    </div>
    <div class="form-group">
        <label for="anos_cursados2">Años Cursados (Bachillerato)</label>
        <input type="number" id="anos_cursados2" name="anos_cursados2" required>
    </div>
    <div class="form-group">
        <label for="documento_recibido2">Documento Recibido (Bachillerato)</label>
        <input type="text" id="documento_recibido2" name="documento_recibido2" required>
    </div>
</div>

        <!-- Información Familiar -->
        <div class="form-section">
            <h2>Información Familiar</h2>
            <div class="form-group">
                <label for="nombrepadre">Nombre del Padre</label>
                <input type="text" id="nombrepadre" name="nombrepadre" required>
            </div>
            <div class="form-group">
                <label for="ocupacionpadre">Ocupación del Padre</label>
                <input type="text" id="ocupacionpadre" name="ocupacionpadre" required>
            </div>
            <div class="form-group">
                <label for="telefonopadre">Teléfono del Padre</label>
                <input type="text" id="telefonopadre" name="telefonopadre" required>
            </div>
            <div class="form-group">
                <label for="nombremadre">Nombre de la Madre</label>
                <input type="text" id="nombremadre" name="nombremadre" required>
            </div>
            <div class="form-group">
                <label for="ocupacionmadre">Ocupación de la Madre</label>
                <input type="text" id="ocupacionmadre" name="ocupacionmadre" required>
            </div>
            <div class="form-group">
                <label for="telefonomadre">Teléfono de la Madre</label>
                <input type="text" id="telefonomadre" name="telefonomadre" required>
            </div>
        </div>
        
          <!-- Información de Hijos -->
          <div class="form-section">
            <h2>Información de Hijos</h2>
            <div class="form-group">
                <label for="nombrehijo1">Nombre del Hijo/Hija 1</label>
                <input type="text" id="nombrehijo1" name="nombrehijo1">
            </div>
            <div class="form-group">
                <label for="nombrehijo2">Nombre del Hijo/Hija 2</label>
                <input type="text" id="nombrehijo2" name="nombrehijo2">
            </div>
            <div class="form-group">
                <label for="nombrehijo3">Nombre del Hijo/Hija 3</label>
                <input type="text" id="nombrehijo3" name="nombrehijo3">
            </div>
            <div class="form-group">
                <label for="nombreesposa">Nombre de la Esposa</label>
                <input type="text" id="nombreesposa" name="nombreesposa">
            </div>
        </div>
        <!-- Vivienda -->
        <div class="form-section">
        <h2>Vivienda</h2>
        <div class="form-group">
        <label for="ubicacion_vivienda">Vivienda</label>
        <select id="ubicacion_vivienda" name="ubicacion_vivienda" required>
        <option value="" disabled selected>Seleccione...</option>
        <option value="casa_sola">Casa Sola</option>
        <option value="casa_condominio">Casa en Condominio</option>
        <option value="departamento">Departamento</option>
        <option value="unidad_habitacional">Unidad Habitacional</option>
        <option value="vivienda_popular">Vivienda Popular</option>
        <option value="interes_social">Interés Social</option>
        <option value="interes_medio">Interés Medio</option>
        <option value="residencial">Residencial</option>
        <option value="vecindad">Vecindad</option>
        <option value="choza_jacal">Choza o Jacal</option>
        </select>
        </div>
        <div class="form-group">
        <label for="zona_vivienda">Zona de la Vivienda</label>
        <select id="zona_vivienda" name="zona_vivienda" required>
        <option value="" disabled selected>Seleccione...</option>
        <option value="urbana">Urbana</option>
        <option value="media">Media</option>
        <option value="popular">Popular</option>
        <option value="periferica">Periférica</option>
        <option value="barriada">Barriada</option>
        <option value="suburbio">Suburbio</option>
        <option value="campestre">Campestre</option>
        <option value="ejidal">Ejidal</option>
        <option value="centrica">Céntrica</option>
        <option value="lujo">Lujo</option>
        </select>
        </div>
        <div class="form-group">
        <label for="tipo_vivienda">Tipo de Vivienda</label>
        <select id="tipo_vivienda" name="tipo_vivienda" required>
        <option value="" disabled selected>Seleccione...</option>
        <option value="propia">Propia</option>
        <option value="pagandola">Pagándola</option>
        <option value="familiares">De Familiares</option>
        <option value="amigos">De Amigos</option>
        <option value="alquiler">En Alquiler</option>
        <option value="comodato">En Comodato</option>
        <option value="credito_hipotecario">Con Crédito Hipotecario</option>
        <option value="credito_infonavit">Con Crédito Infonavit</option>
        <option value="credito_fovissste">Con Crédito Fovissste</option>
        </select>
        </div>
        <div class="form-group">
        <label for="numero_banos">Número de Baños</label>
        <select id="numero_banos" name="numero_banos" required>
        <option value="" disabled selected>Seleccione...</option>
        <option value="uno">Un Baño</option>
        <option value="uno_y_medio">Un y Medio Baño</option>
        <option value="dos">Dos Baños</option>
        <option value="mas_dos">Más de Dos Baños</option>
        </select>
        </div>
        <div class="form-group">
        <label for="pisos">Número de Pisos</label>
        <select id="pisos" name="pisos" required>
        <option value="" disabled selected>Seleccione...</option>
        <option value="uno">Un Piso</option>
        <option value="dos">Dos Pisos</option>
        <option value="mas_dos">Más de Dos Pisos</option>
        </select>
        </div>
        <div class="form-group">
        <label for="numero_recamaras">Número de recamaras</label>
        <select id="numero_recamaras" name="numero_recamaras" required>
        <option value="" disabled selected>Seleccione...</option>
        <option value="uno">Una recamara</option>
        <option value="uno_y_medio">Dos recamaras</option>
        <option value="dos">Tres recamaras</option>
        <option value="mas_dos">Más de tres recamaras</option>
        </select>
        </div>
        <!-- Vivienda -->
        <div class="form-section">
        <h2>Vivienda</h2>
        <div class="form-group">
        <label>Áreas de la Vivienda</label>
        <div class="checkbox-group">
        <label><input type="checkbox" name="areas_vivienda" value="sala"> Sala</label>
        <label><input type="checkbox" name="areas_vivienda" value="comedor"> Comedor</label>
        <label><input type="checkbox" name="areas_vivienda" value="cocina"> Cocina</label>
        <label><input type="checkbox" name="areas_vivienda" value="jardin"> Jardín</label>
        <label><input type="checkbox" name="areas_vivienda" value="estancia"> Estancia o Cuarto de TV</label>
        <label><input type="checkbox" name="areas_vivienda" value="biblioteca"> Biblioteca</label>
        <label><input type="checkbox" name="areas_vivienda" value="sala_juegos"> Sala o Salón de Juegos</label>
        <label><input type="checkbox" name="areas_vivienda" value="estudio"> Estudio</label>
        <label><input type="checkbox" name="areas_vivienda" value="garage"> Garaje</label>
        <label><input type="checkbox" name="areas_vivienda" value="cuarto_servicio"> Cuarto de Servicio</label>
        <label><input type="checkbox" name="areas_vivienda" value="patio"> Patio</label>
        <label><input type="checkbox" name="areas_vivienda" value="otras"> Otras</label>
        </div>
        </div>
        </div>
        
        <!-- Electrodomésticos y Equipos Electrónicos -->
        <div class="form-section">
        <h2>Electrodomésticos y Equipos Electrónicos</h2>
        <div class="form-group">
        <label>Seleccione los electrodomésticos y equipos electrónicos disponibles:</label>
        <div class="checkbox-group">
        <label><input type="checkbox" name="equipos_electronicos" value="radio"> Radio</label>
        <label><input type="checkbox" name="equipos_electronicos" value="televisor"> Televisor</label>
        <label><input type="checkbox" name="equipos_electronicos" value="equipo_sonido"> Equipo de Sonido</label>
        <label><input type="checkbox" name="equipos_electronicos" value="home_teather"> Home Teather</label>
        <label><input type="checkbox" name="equipos_electronicos" value="dvd"> DVD</label>
        <label><input type="checkbox" name="equipos_electronicos" value="video_cassetera_vhs"> Video Cassetera VHS</label>
        <label><input type="checkbox" name="equipos_electronicos" value="equipo_videojuegos"> Equipo de Videojuegos</label>
        <label><input type="checkbox" name="equipos_electronicos" value="computadora"> Computadora</label>
        <label><input type="checkbox" name="equipos_electronicos" value="impresora"> Impresora</label>
        <label><input type="checkbox" name="equipos_electronicos" value="equipo_fax"> Equipo de Fax</label>
        <label><input type="checkbox" name="electrodomesticos" value="estufa"> Estufa</label>
        <label><input type="checkbox" name="electrodomesticos" value="refrigerador"> Refrigerador</label>
        <label><input type="checkbox" name="electrodomesticos" value="lavadora"> Lavadora</label>
        <label><input type="checkbox" name="electrodomesticos" value="secadora"> Secadora</label>
        <label><input type="checkbox" name="electrodomesticos" value="licuadora"> Licuadora</label>
        <label><input type="checkbox" name="electrodomesticos" value="horno_microondas"> Horno de Microondas</label>
        <label><input type="checkbox" name="electrodomesticos" value="lavavajillas"> Lavavajillas</label>
        <label><input type="checkbox" name="electrodomesticos" value="freidora"> Freidora</label>
        <label><input type="checkbox" name="electrodomesticos" value="tostador"> Tostador</label>
        <label><input type="checkbox" name="electrodomesticos" value="waflera"> Waflera</label>
        <label><input type="checkbox" name="electrodomesticos" value="sandwichera"> Sandwichera</label>
        <label><input type="checkbox" name="electrodomesticos" value="extractor_jugos"> Extractor de Jugos</label>
        </div>
        </div>
        </div>
        
        <!-- Servicios Públicos -->
        <div class="form-section">
        <h2>Servicios Públicos</h2>
        <div class="form-group">
        <label>Seleccione los servicios públicos disponibles:</label>
        <div class="checkbox-group">
        <label><input type="checkbox" name="servicios_publicos" value="agua_potable"> Agua Potable</label>
        <label><input type="checkbox" name="servicios_publicos" value="agua_poso"> Agua de Pozo</label>
        <label><input type="checkbox" name="servicios_publicos" value="suministro_pipa"> Suministro por Pipa</label>
        <label><input type="checkbox" name="servicios_publicos" value="agua_lluvia"> Agua de Lluvia</label>
        <label><input type="checkbox" name="servicios_publicos" value="agua_garrafon"> Agua de Garrafón</label>
        <label><input type="checkbox" name="servicios_publicos" value="drenaje_publico"> Drenaje Público</label>
        <label><input type="checkbox" name="servicios_publicos" value="fosa_septica"> Fosa Séptica</label>
        <label><input type="checkbox" name="servicios_publicos" value="alumbrado_publico"> Alumbrado Público</label>
        <label><input type="checkbox" name="servicios_publicos" value="banquetas"> Banquetas</label>
        <label><input type="checkbox" name="servicios_publicos" value="asfalto"> Asfalto</label>
        <label><input type="checkbox" name="servicios_publicos" value="pavimento"> Pavimento</label>
        <label><input type="checkbox" name="servicios_publicos" value="terraceria"> Terracería</label>
        <label><input type="checkbox" name="servicios_publicos" value="parque"> Parque</label>
        <label><input type="checkbox" name="servicios_publicos" value="mercados_publicos"> Mercados Públicos</label>
        <label><input type="checkbox" name="servicios_publicos" value="sistema_vigilancia"> Sistema de Vigilancia</label>
        <label><input type="checkbox" name="servicios_publicos" value="servicio_postal"> Servicio Postal</label>
        <label><input type="checkbox" name="servicios_publicos" value="hospitales"> Hospitales</label>
        <label><input type="checkbox" name="servicios_publicos" value="centros_medicos"> Centros Médicos</label>
        <label><input type="checkbox" name="servicios_publicos" value="centros_culturales"> Centros Culturales</label>
        <label><input type="checkbox" name="servicios_publicos" value="panaderias"> Panaderías</label>
        <label><input type="checkbox" name="servicios_publicos" value="energia_electrica"> Energía Eléctrica</label>
        <label><input type="checkbox" name="servicios_publicos" value="servicio_telefonico"> Servicio Telefónico</label>
        <label><input type="checkbox" name="servicios_publicos" value="television_cable"> Televisión por Cable</label>
        <label><input type="checkbox" name="servicios_publicos" value="recoleccion_basura"> Recolección de Basura</label>
        <label><input type="checkbox" name="servicios_publicos" value="seguridad_privada"> Seguridad Privada</label>
        <label><input type="checkbox" name="servicios_publicos" value="seguridad_publica"> Seguridad Pública</label>
        <label><input type="checkbox" name="servicios_publicos" value="acceso_controlado"> Acceso Controlado</label>
        <label><input type="checkbox" name="servicios_publicos" value="transporte_publico"> Transporte Público</label>
        <label><input type="checkbox" name="servicios_publicos" value="telefono_publico"> Teléfono Público</label>
        <label><input type="checkbox" name="servicios_publicos" value="centros_comerciales"> Centros Comerciales</label>
        <label><input type="checkbox" name="servicios_publicos" value="escuelas_publicas"> Escuelas Públicas</label>
        <label><input type="checkbox" name="servicios_publicos" value="instalaciones_deportivas"> Instalaciones Deportivas</label>
        <label><input type="checkbox" name="servicios_publicos" value="jardines"> Jardines</label>
        <label><input type="checkbox" name="servicios_publicos" value="vigilancia_nocturna"> Vigilancia Nocturna</label>
        <label><input type="checkbox" name="servicios_publicos" value="lecherias_publicas"> Lecherías Públicas</label>
        <label><input type="checkbox" name="servicios_publicos" value="tiendas_rurales"> Tiendas Rurales</label>
        <label><input type="checkbox" name="servicios_publicos" value="iglesias"> Iglesias</label>
        <label><input type="checkbox" name="servicios_publicos" value="bancos"> Bancos</label>
        <label><input type="checkbox" name="servicios_publicos" value="suministros_gas"> Suministros de Gas</label>
        </div>
        </div>
        </div>
        
        <!-- Rasgos Económicos del Trabajador -->
        <div class="form-section">
        <h2>Rasgos Económicos del Trabajador</h2>
        <div class="form-group">
        <label>Seleccione los tipos de crédito y adeudos:</label>
        <div class="checkbox-group">
        <!-- Créditos -->
        <fieldset>
        <legend>Créditos</legend>
        <label><input type="checkbox" name="credito[]" value="credito_hipotecario"> Crédito Hipotecario</label>
        <label><input type="checkbox" name="credito[]" value="credito_personal"> Crédito Personal</label>
        <label><input type="checkbox" name="credito[]" value="credito_refaccionario"> Crédito Refaccionario</label>
        <label><input type="checkbox" name="credito[]" value="credito_avi"> Crédito de Avío</label>
        <label><input type="checkbox" name="credito[]" value="credito_automotriz"> Crédito Automotriz</label>
        <label><input type="checkbox" name="credito[]" value="credito_comercial"> Crédito Comercial</label>
        <label><input type="checkbox" name="credito[]" value="credito_mercantil"> Crédito Mercantil</label>
        <label><input type="checkbox" name="credito[]" value="credito_departamental"> Crédito Departamental</label>
        <label><input type="checkbox" name="credito[]" value="credito_bancario"> Crédito Bancario</label>
        <label><input type="checkbox" name="credito[]" value="tarjetas_credito"> Tarjetas de Crédito</label>
        <label><input type="checkbox" name="credito[]" value="otros_creditos"> Otros Créditos</label>
        </fieldset>
        <!-- Adeudos -->
        <fieldset>
        <legend>Adeudos</legend>
        <label><input type="checkbox" name="adeudo[]" value="adeudo_infonavit"> Adeudo Infonavit</label>
        <label><input type="checkbox" name="adeudo[]" value="adeudo_fonacot"> Adeudo Fonacot</label>
        <label><input type="checkbox" name="adeudo[]" value="adeudo_fovissste"> Adeudo Fovissste</label>
        <label><input type="checkbox" name="adeudo[]" value="adeudos_bancarios"> Adeudos Bancarios</label>
        <label><input type="checkbox" name="adeudo[]" value="adeudos_hipotecarios"> Adeudos Hipotecarios</label>
        <label><input type="checkbox" name="adeudo[]" value="adeudos_automotrices"> Adeudos Automotrices</label>
        <label><input type="checkbox" name="adeudo[]" value="adeudos_mercantiles"> Adeudos Mercantiles</label>
        <label><input type="checkbox" name="adeudo[]" value="adeudos_departamentales"> Adeudos Departamentales</label>
        <label><input type="checkbox" name="adeudo[]" value="adeudos_comerciales"> Adeudos Comerciales</label>
        </fieldset>
        </div>
        </div>
        </div>
        
        <style>
        /* Estilos generales del formulario */
        body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        }
        
        .form-section {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        padding: 20px;
        max-width: 900px;
        }
        
        h2 {
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 20px;
        color: #007bff;
        }
        
        .form-group {
        margin-bottom: 20px;
        }
        
        .checkbox-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Tres columnas */
        gap: 15px; /* Espacio entre los elementos */
        }
        
        .checkbox-group label {
        display: flex;
        align-items: center;
        font-size: 14px; /* Tamaño de fuente más adecuado */
        padding: 8px;
        background: #f9f9f9;
        border-radius: 5px;
        border: 1px solid #ddd;
        }
        
        .checkbox-group input[type="checkbox"] {
        margin-right: 10px; /* Espacio entre la caja de verificación y el texto */
        accent-color: #007bff; /* Cambia el color del círculo de la casilla de verificación */
        }
        
        fieldset {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
        background: #f9f9f9;
        }
        
        legend {
        font-weight: bold;
        color: #007bff;
        }
        
        label {
        margin-bottom: 10px;
        display: block;
        }
        </style>
        
        <!-- Distribución de los Adeudos y Gastos Mensuales -->
        <div class="form-section">
        <h2>Distribución de los Adeudos y Gastos Mensuales</h2>
        <div class="form-group">
        <div class="column">
        <label for="pago_hipotecario">Pago Hipotecario</label>
        <input type="number" id="pago_hipotecario" name="pago_hipotecario" step="0.01">
        
        <label for="pago_infonavit">Pago de Infonavit</label>
        <input type="number" id="pago_infonavit" name="pago_infonavit" step="0.01">
        
        <label for="pago_fovissste">Pago de Fovissste</label>
        <input type="number" id="pago_fovissste" name="pago_fovissste" step="0.01">
        
        <label for="pago_renta">Pago de Renta</label>
        <input type="number" id="pago_renta" name="pago_renta" step="0.01">
        
        <label for="pago_luz">Pago de Luz</label>
        <input type="number" id="pago_luz" name="pago_luz" step="0.01">
        
        <label for="pago_agua">Pago de Agua</label>
        <input type="number" id="pago_agua" name="pago_agua" step="0.01">
        
        <label for="pago_predial">Pago de Predial</label>
        <input type="number" id="pago_predial" name="pago_predial" step="0.01">
        
        <label for="pago_gas">Pago de Gas</label>
        <input type="number" id="pago_gas" name="pago_gas" step="0.01">
        
        <label for="pago_telefono">Pago de Teléfono</label>
        <input type="number" id="pago_telefono" name="pago_telefono" step="0.01">
        </div>
        <div class="column">
        <label for="pago_transporte">Pago de Transporte</label>
        <input type="number" id="pago_transporte" name="pago_transporte" step="0.01">
        
        <label for="pago_alimentos">Pago de Alimentos</label>
        <input type="number" id="pago_alimentos" name="pago_alimentos" step="0.01">
        
        <label for="pagos_medicos">Pagos Médicos</label>
        <input type="number" id="pagos_medicos" name="pagos_medicos" step="0.01">
        
        <label for="mantenimiento_vivienda">Mantenimiento de Vivienda</label>
        <input type="number" id="mantenimiento_vivienda" name="mantenimiento_vivienda" step="0.01">
        
        <label for="servicio_tv">Servicio de TV</label>
        <input type="number" id="servicio_tv" name="servicio_tv" step="0.01">
        
        <label for="gastos_vacacionales">Gastos Vacacionales</label>
        <input type="number" id="gastos_vacacionales" name="gastos_vacacionales" step="0.01">
        
        <label for="ahorro">Ahorro</label>
        <input type="number" id="ahorro" name="ahorro" step="0.01">
        
        <label for="educacion">Educación</label>
        <input type="number" id="educacion" name="educacion" step="0.01">
        </div>
        <div class="column">
        <label for="utiles_escolares">Útiles Escolares</label>
        <input type="number" id="utiles_escolares" name="utiles_escolares" step="0.01">
        
        <label for="uniformes_escolares">Uniformes Escolares</label>
        <input type="number" id="uniformes_escolares" name="uniformes_escolares" step="0.01">
        
        <label for="transporte_escolar">Transporte Escolar</label>
        <input type="number" id="transporte_escolar" name="transporte_escolar" step="0.01">
        
        <label for="cuotas_escolares">Cuotas Escolares</label>
        <input type="number" id="cuotas_escolares" name="cuotas_escolares" step="0.01">
        
        <label for="servicio_medico">Servicio Médico</label>
        <input type="number" id="servicio_medico" name="servicio_medico" step="0.01">
        
        <label for="calzado_vestido">Calzado y Vestido</label>
        <input type="number" id="calzado_vestido" name="calzado_vestido" step="0.01">
        
        <label for="articulos_consumo">Artículos de Consumo</label>
        <input type="number" id="articulos_consumo" name="articulos_consumo" step="0.01">
        
        <label for="articulos_aseo">Artículos de Aseo</label>
        <input type="number" id="articulos_aseo" name="articulos_aseo" step="0.01">
        
        <label for="articulos_uso_personal">Artículos de Uso Personal</label>
        <input type="number" id="articulos_uso_personal" name="articulos_uso_personal" step="0.01">
        
        <label for="mantenimiento_vehiculos">Mantenimiento de Vehículos</label>
        <input type="number" id="mantenimiento_vehiculos" name="mantenimiento_vehiculos" step="0.01">
        
        <label for="servicio_domestico">Servicio Doméstico</label>
        <input type="number" id="servicio_domestico" name="servicio_domestico" step="0.01">
        
        <label for="cuotas_clubes">Cuotas de Clubes</label>
        <input type="number" id="cuotas_clubes" name="cuotas_clubes" step="0.01">
        </div>
        </div>
        
        <!-- Total de Adeudos y Gastos Mensuales -->
        <div class="form-group">
        <label for="total_gastos">Total de Adeudos y Gastos Mensuales</label>
        <input type="number" id="total_gastos" name="total_gastos" step="0.01" readonly>
        </div>
        </div>
        
        <script>
        // Función para calcular el total de los gastos y adeudos
        document.querySelectorAll('.form-group input').forEach(input => {
        input.addEventListener('input', calculateTotal);
        });
        
        function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.form-group input').forEach(input => {
        if (input.id !== 'total_gastos') {
        total += parseFloat(input.value) || 0;
        }
        });
        document.getElementById('total_gastos').value = total.toFixed(2);
        }
        </script>
        
        <style>
        .form-section {
        margin-bottom: 20px;
        }
        
        .form-group {
        margin-bottom: 10px;
        }
        
        .column {
        float: left;
        width: 33.33%;
        box-sizing: border-box;
        padding: 0 10px;
        }
        
        .column label {
        display: block;
        margin-top: 10px;
        }
        
        .column input {
        width: 100%;
        margin-bottom: 10px;
        padding: 8px;
        box-sizing: border-box;
        }
        
        .form-group input {
        width: calc(100% - 20px);
        margin-left: 10px;
        }
        
        .form-section::after {
        content: "";
        display: table;
        clear: both;
        }
        </style>
        
        <!-- Habilidades / Actividades -->
        <div class="form-section">
        <h2>Habilidades / Actividades</h2>
        
        <div class="form-group">
        <label for="deportes">Deportes</label>
        <select id="deportes" name="deportes" onchange="toggleFields('deportes')">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        <div id="deportes-details" class="details hidden">
        <div class="form-group">
        <label for="cual1">¿Cuál?</label>
        <input type="text" id="cual1" name="cual1">
        </div>
        <div class="form-group">
        <label for="lo_practica1">¿Lo Practica?</label>
        <select id="lo_practica1" name="lo_practica1">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        </div>
        </div>
        </div>
        
        <div class="form-group">
        <label for="manuales">Manuales</label>
        <select id="manuales" name="manuales" onchange="toggleFields('manuales')">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        <div id="manuales-details" class="details hidden">
        <div class="form-group">
        <label for="cual2">¿Cuál?</label>
        <input type="text" id="cual2" name="cual2">
        </div>
        <div class="form-group">
        <label for="lo_practica2">¿Lo Practica?</label>
        <select id="lo_practica2" name="lo_practica2">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        </div>
        </div>
        </div>
        
        <div class="form-group">
        <label for="fisicas">Físicas</label>
        <select id="fisicas" name="fisicas" onchange="toggleFields('fisicas')">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        <div id="fisicas-details" class="details hidden">
        <div class="form-group">
        <label for="cual3">¿Cuál?</label>
        <input type="text" id="cual3" name="cual3">
        </div>
        <div class="form-group">
        <label for="lo_practica3">¿Lo Practica?</label>
        <select id="lo_practica3" name="lo_practica3">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        </div>
        </div>
        </div>
        
        <div class="form-group">
        <label for="culturales">Culturales</label>
        <select id="culturales" name="culturales" onchange="toggleFields('culturales')">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        <div id="culturales-details" class="details hidden">
        <div class="form-group">
        <label for="cual4">¿Cuál?</label>
        <input type="text" id="cual4" name="cual4">
        </div>
        <div class="form-group">
        <label for="lo_practica4">¿Lo Practica?</label>
        <select id="lo_practica4" name="lo_practica4">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        </div>
        </div>
        </div>
        
        <div class="form-group">
        <label for="otros">Otros</label>
        <select id="otros" name="otros" onchange="toggleFields('otros')">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        <div id="otros-details" class="details hidden">
        <div class="form-group">
        <label for="cual5">¿Cuál?</label>
        <input type="text" id="cual5" name="cual5">
        </div>
        <div class="form-group">
        <label for="lo_practica5">¿Lo Practica?</label>
        <select id="lo_practica5" name="lo_practica5">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        </div>
        </div>
        </div>
        
        <div class="form-group">
        <label for="cuales_son">¿Cuáles Son?</label>
        <select id="cuales_son" name="cuales_son" onchange="toggleFields('cuales_son')">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        <div id="cuales_son-details" class="details hidden">
        <div class="form-group">
        <label for="cual6">¿Cuál?</label>
        <input type="text" id="cual6" name="cual6">
        </div>
        <div class="form-group">
        <label for="lo_practica6">¿Lo Practica?</label>
        <select id="lo_practica6" name="lo_practica6">
        <option value="" disabled selected>Seleccione...</option>
        <option value="si">Sí</option>
        <option value="no">No</option>
        </select>
        </div>
        </div>
        </div>
        </div>
        
        <script>
        function toggleFields(sectionId) {
        const yesOption = document.querySelector(`#${sectionId} option[value='si']`).selected;
        const details = document.getElementById(`${sectionId}-details`);
        if (yesOption) {
        details.classList.remove('hidden');
        } else {
        details.classList.add('hidden');
        }
        }
        </script>
        
        <style>
        .details {
        margin-top: 10px;
        }
        .details.hidden {
        display: none;
        }
        </style>
        <script>
            function toggleFields(sectionId) {
                const yesOption = document.querySelector(`#${sectionId} option[value='si']`).selected;
                const details = document.getElementById(`${sectionId}-details`);
                if (yesOption) {
                    details.classList.remove('hidden');
                } else {
                    details.classList.add('hidden');
                }
            }
        </script>

        
                      <!-- Botón de Enviar -->
            <div class="form-group">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>

    <script>
        function toggleFields(fieldId) {
            const field = document.getElementById(fieldId);
            const details = document.getElementById(`${fieldId}-details`);
            details.classList.toggle('hidden', field.value !== 'si');
        }
    </script>
</body>
</html>
            <div>
                <button type="submit">Enviar</button>
                <button type="reset">Limpiar</button>
            </div>
        </form>
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert"><?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
        <?php endif; ?>
        
        <h2>Elementos Guardados</h2>
        <table class="element-table">
            <thead>
                <tr>
                    <th>Fecha de Reclutamiento</th>
                    <th>Nombre Completo</th>
                    <th>NSS</th>
                    <th>CURP</th>
                    <th>RFC</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($elementos as $elemento): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($elemento['fecha_reclutamiento']); ?></td>
                        <td><?php echo htmlspecialchars($elemento['Nombre_Completo']); ?></td>
                        <td><?php echo htmlspecialchars($elemento['nss']); ?></td>
                        <td><?php echo htmlspecialchars($elemento['curp']); ?></td>
                        <td><?php echo htmlspecialchars($elemento['rfc']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

