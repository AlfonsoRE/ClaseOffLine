<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("INSERT INTO cuestionarios_contenido(id_cuestionario, pregunta, opcion1, opcion2, opcion3, opcion4, respuesta) VALUES(?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('isssssi', $obj->id_cuestionario, $obj->pregunta, $obj->opcion1, $obj->opcion2, $obj->opcion3, $obj->opcion4, $obj->respuesta);
$stmt->execute();
$stmt->close();
echo "Registro exitoso";
?>
