<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("UPDATE material SET titulo=?, descripcion=?, id_tema=? WHERE id=?");
$stmt->bind_param('ssii', $obj->titulo,$obj->descripcion,$obj->id_tema, $obj->id);
$stmt->execute();
$stmt->close();
echo "Registro modificado";
?>