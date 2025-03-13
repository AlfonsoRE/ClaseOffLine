<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("INSERT INTO historial_cuestionario(id_cuestionario, id_usuario, calificacion) VALUES(?, ?, ?)");
$stmt->bind_param('iis', $obj->id_cuestionario, $obj->id_usuario, $obj->calificacion);
$stmt->execute();
$stmt->close();
echo "Registro exitoso";
?>
