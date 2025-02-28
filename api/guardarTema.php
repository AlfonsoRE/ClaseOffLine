<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("INSERT INTO temas(titulo, id_clase) VALUES(?, ?)");
$stmt->bind_param('si', $obj->titulo, $obj->id_clase);
$stmt->execute();
$stmt->close();
echo "Registro exitoso";
?>
