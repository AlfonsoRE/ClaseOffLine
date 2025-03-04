<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("SELECT id, id_cuestionario, pregunta, opcion1, opcion2, opcion3,  opcion4, respuesta FROM cuestionarios_contenido");
$stmt->bind_result($id, $id_cuestionario, $pregunta, $opcion1, $opcion2, $opcion3, $opcion4, $respuesta);
$stmt->execute();
$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_cuestionario' => $id_cuestionario,
        'pregunta' => $pregunta,
        'opcion1' => $opcion1,
        'opcion2' => $opcion2,
        'opcion3' => $opcion3,
        'opcion4' => $opcion4,
        'respuesta' => $respuesta
    );
}
$stmt->close();
echo json_encode($arr);
?>
