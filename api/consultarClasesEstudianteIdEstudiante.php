<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt = $db->prepare("SELECT c.id, c.nombre, c.materia, c.descripcion, c.codigo, c.id_usuario, 
(select nombre from usuarios where id = c.id_usuario) as maestro 
FROM clases c JOIN clase_estudiantes e WHERE c.id = e.id_clase and e.id_estudiante = ?");
$stmt->bind_param('i',  $obj->id_usuario);
$stmt->bind_result($id, $nombre, $materia, $descripcion, $codigo, $id_usuario,$maestro);
$stmt->execute();
$arr = array();
while($stmt->fetch()){
$arr[] = array(
'id' => $id, 
'nombre' => $nombre,
'materia' => $materia,
'descripcion' => $descripcion,
'codigo' => $codigo,
'id_usuario' => $id_usuario,
'maestro' => $maestro
    );
}
$stmt->close();
echo json_encode($arr);
?>