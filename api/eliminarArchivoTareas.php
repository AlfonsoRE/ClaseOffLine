<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("DELETE FROM archivos_tarea where id=?");
$stmt->bind_param('s',$obj->id);
$stmt->execute();
$stmt->close();
echo "Registro eliminado";
?>