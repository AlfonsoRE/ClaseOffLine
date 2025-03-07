<?php
error_reporting(E_ALL);
require_once 'conexion.php';

// Prepara la consulta SQL
$stmt = $db->prepare("SELECT id, id_anuncios, enlace, fecha FROM enlaces_anuncios");

if (!$stmt) {
    echo json_encode(["error" => "Error en la preparación de la consulta"]);
    exit();
}

// Ejecuta la consulta
$stmt->execute();

// Vincula los resultados
$stmt->bind_result($id, $id_anuncios, $enlace, $fecha);

$arr = array();

// Obtiene los resultados
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_anuncios' => $id_anuncios,
        'enlace' => $enlace,
        'fecha' => $fecha
    );
}

// Cierra la consulta
$stmt->close();

// Retorna los resultados en formato JSON
echo json_encode($arr);
?>
