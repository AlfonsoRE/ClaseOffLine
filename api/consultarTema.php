<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

$stmt = $db->prepare("SELECT id, titulo, id_clase FROM temas WHERE id = ?");
$stmt->bind_param('i', $obj->id);
$stmt->bind_result($id, $titulo, $id_clase);
$stmt->execute();
$arr = array();
if ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'titulo' => $titulo,
        'id_clase' => $id_clase
    );
}
$stmt->close();
echo json_encode($arr);
?>
