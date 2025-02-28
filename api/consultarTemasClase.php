<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
// Preparamos la consulta para obtener todos los temas de una clase específica
$stmt = $db->prepare("SELECT id, titulo, id_clase FROM temas WHERE id_clase = ?");
$stmt->bind_param('i', $obj->id_clase);  // Vinculamos el parámetro id_clase (entero)
$stmt->bind_result($id, $titulo, $id_clase);  // Vinculamos los resultados a las variables
$stmt->execute();
$arr = array();
// Obtenemos todos los resultados y los agregamos al arreglo
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'titulo' => $titulo,
        'id_clase' => $id_clase
    );
}

$stmt->close();
echo json_encode($arr);
?>
