<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

// Verifica que se reciba el id_anuncios
if (!isset($obj->id_anuncios)) {
    echo json_encode(["error" => "Falta el id_anuncios"]);
    exit();
}

// Prepara la consulta SQL
$stmt = $db->prepare("SELECT id, id_anuncios, enlace, fecha FROM enlaces_anuncios WHERE id_anuncios = ?");

if (!$stmt) {
    echo json_encode(["error" => "Error en la preparación de la consulta"]);
    exit();
}

// Asigna el parámetro
$stmt->bind_param('i', $obj->id_anuncios);

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
