<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
// Preparamos la consulta para obtener todos los temas de una clase específica
$stmt = $db->prepare("SELECT id, mensaje, id_clase FROM anuncios WHERE id_clase = ?");
$stmt->bind_param('i', $obj->id_clase);  // Vinculamos el parámetro id_clase (entero)
$stmt->bind_result($id, $mensaje, $id_clase);  // Vinculamos los resultados a las variables
$stmt->execute();
$arr = array();
// Obtenemos todos los resultados y los agregamos al arreglo
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'mensaje' => $mensaje,
        'id_clase' => $id_clase,
    );
}

$stmt->close();
echo json_encode($arr);
?>
