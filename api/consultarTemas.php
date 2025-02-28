<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("SELECT id, titulo, id_clase FROM temas");
$stmt->bind_result($id, $titulo, $id_clase);
$stmt->execute();
$arr = array();
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
