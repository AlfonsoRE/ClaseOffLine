<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt = $db->prepare("
    INSERT INTO clase_estudiantes (id_clase, id_estudiante) 
    SELECT id, ? FROM clases WHERE codigo = ?");
$stmt->bind_param('is', $obj->id_estudiante, $obj->codigo);
$stmt->execute();
$stmt->close();
echo "Registro exitoso";
?>
