<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));
if (isset($obj->id_historial)) {
    $stmt = $db->prepare("UPDATE historial_tareas SET calificacion=? WHERE id=?");
    $stmt->bind_param('si', $obj->calificacion, $obj->id_historial);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Registro modificado"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al modificar el registro"]);
    }
    $stmt->close();
} else {
    $stmt = $db->prepare("INSERT INTO historial_tareas (id_tareas, id_usuario,calificacion) VALUES (?, ?, ?)");
    $stmt->bind_param('iii', $obj->id_tareas, $obj->id_usuario, $obj->calificacion);
      if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Registro agregado"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al modificar el registro"]);
    }    
}
?>