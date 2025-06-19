<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("UPDATE cuestionarios_contenido SET pregunta=?, opcion1=?, opcion2=?, opcion3=?, opcion4=?, respuesta=? WHERE id=?");
$stmt->bind_param('sssssss', $obj->pregunta, $obj->opcion1, $obj->opcion2, $obj->opcion3, $obj->opcion4, $obj->respuesta, $obj->id);
$stmt->execute();
$stmt->close();
echo "Registro modificado";
?>