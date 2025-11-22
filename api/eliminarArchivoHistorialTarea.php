<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

if (isset($obj->id_tareas) && isset($obj->id_usuario)) {
    $stmt = $db->prepare("UPDATE historial_tareas 
                          SET archivo = NULL, nombre = NULL, ruta = NULL 
                          WHERE id_tareas = ? AND id_usuario = ?");
    $stmt->bind_param('ii', $obj->id_tareas, $obj->id_usuario);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Archivo eliminado correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al eliminar el archivo"]);
    }
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
}
