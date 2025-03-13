<?php
error_reporting(E_ALL);
require_once 'conexion.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

// Prepara la consulta SQL para obtener los datos de enlace_material
$stmt = $db->prepare("SELECT id, id_material, enlace, fecha FROM enlace_material");
$stmt->bind_result($id, $id_material, $enlace, $fecha);
$stmt->execute();

// Arreglo para almacenar los resultados
$arr = array();

// Itera sobre los resultados y los agrega al arreglo
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_material' => $id_material,
        'enlace' => $enlace,
        'fecha' => $fecha,
        'url' => $enlace // Asume que el enlace ya es una URL o texto
    );
}

// Cierra la consulta
$stmt->close();

// Devuelve los resultados en formato JSON
echo json_encode($arr);
?>
