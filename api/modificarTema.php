<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("UPDATE temas SET titulo=?, id_clase=? WHERE id=?");
$stmt->bind_param('sii', $obj->titulo, $obj->id_clase, $obj->id);
$stmt->execute();
$stmt->close();
echo "Registro modificado";
?>
