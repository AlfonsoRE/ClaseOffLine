<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input")); 

$stmt = $db->prepare("INSERT INTO comentarios (id_tarea, id_usuario, comentario, fecha_comentario) 
                      VALUES (?, ?, ?, NOW())");

$stmt->bind_param('iis', $obj->id_tarea, $obj->id_usuario, $obj->comentario);
$stmt->execute();
$stmt->close();

echo "Comentario guardado exitosamente";
?>
