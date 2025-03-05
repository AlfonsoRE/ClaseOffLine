<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
// Preparamos la consulta para obtener todos los temas de una clase específica
$stmt = $db->prepare("SELECT id, id_tema, titulo, descripcion, id_clase FROM cuestionarios WHERE id_tema = ?");
$stmt->bind_param('i', $obj->id_tema);  // Vinculamos el parámetro id_tema (entero)
$stmt->bind_result($id, $id_tema, $titulo, $descripcion, $id_clase);  // Vinculamos los resultados a las variables
$stmt->execute();
$arr = array();
// Obtenemos todos los resultados y los agregamos al arreglo
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tema' => $id_tema,
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'id_clase' => $id_clase
    );
}

$stmt->close();
echo json_encode($arr);
?>
