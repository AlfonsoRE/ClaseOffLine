<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("UPDATE clase_estudiantes SET status=? WHERE id=?");
$stmt->bind_param('si', $obj->status, $obj->id);
$stmt->execute();
$stmt->close();
echo "Registro modificado";
?>