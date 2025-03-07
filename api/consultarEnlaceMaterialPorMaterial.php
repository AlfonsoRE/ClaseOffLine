<?php
error_reporting(E_ALL);
require_once 'conexion.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

// Recibe la solicitud JSON
$obj = json_decode(file_get_contents("php://input"));

// Verifica si se recibió el parámetro 'id_material'
if (!isset($obj->id_material)) {
    echo json_encode(["status" => "error", "message" => "Falta el parámetro id_material"]);
    exit;
}

// Prepara la consulta SQL para obtener los enlaces por id_material
$stmt = $db->prepare("SELECT id, id_material, enlace, fecha FROM enlace_material WHERE id_material = ?");
$stmt->bind_param('i', $obj->id_material);
$stmt->bind_result($id, $id_material, $enlace, $fecha);
$stmt->execute();

$arr = array(); // Arreglo para almacenar los resultados

// Recoge todos los registros encontrados
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_material' => $id_material,
        'enlace' => $enlace,
        'fecha' => $fecha,
        'url' => $enlace // Se asume que el enlace es una URL válida
    );
}

// Cierra la consulta
$stmt->close();

// Devuelve los resultados como JSON
echo json_encode($arr);
?>
