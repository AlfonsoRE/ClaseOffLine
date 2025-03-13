<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("SELECT id, id_cuestionario, id_usuario, calificacion, fecha FROM historial_cuestionario");
$stmt->execute();
$stmt->bind_result($id, $id_cuestionario, $id_usuario, $cailficacion, $fecha);

$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_cuestionario' => $id_cuestionario,
        'id_usuario' => $id_usuario,
        'calificacion' => $cailficacion,
        'fecha' => $fecha,
        'url' => '../api/descargarArchivoHistorial.php?id=' . $id // Ajusta el script de descarga según tu implementación
    );
}
$stmt->close();
echo json_encode($arr);
?>
