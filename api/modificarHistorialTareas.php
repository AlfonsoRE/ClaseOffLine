<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

if (isset($obj->calificacion)) {
    $stmt = $db->prepare("UPDATE historial_tareas SET calificacion=? WHERE id=?");
    $stmt->bind_param('si', $obj->calificacion, $obj->id);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Registro modificado"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al modificar el registro"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Faltan parámetros"]);
}
?>
