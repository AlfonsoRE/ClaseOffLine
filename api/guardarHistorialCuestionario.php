<?php
error_reporting(E_ALL);
require_once 'conexion.php';

// Recibir datos del frontend (Angular)
$obj = json_decode(file_get_contents("php://input"));

// Validar que existan los datos necesarios
if (!isset($obj->id_cuestionario) || !isset($obj->id_usuario) || !isset($obj->calificacion)) {
    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    exit;
}

$id_cuestionario = $obj->id_cuestionario;
$id_usuario = $obj->id_usuario;
$calificacion = $obj->calificacion;

// Verificar si ya existe un registro para este usuario y cuestionario
$check = $db->prepare("SELECT id FROM historial_cuestionario WHERE id_cuestionario = ? AND id_usuario = ?");
$check->bind_param('ii', $id_cuestionario, $id_usuario);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    // Ya respondió este cuestionario
    echo json_encode(["success" => false, "message" => "Ya has contestado este cuestionario"]);
    $check->close();
    exit;
}
$check->close();

// Insertar nuevo registro
$stmt = $db->prepare("INSERT INTO historial_cuestionario (id_cuestionario, id_usuario, calificacion) VALUES (?, ?, ?)");
$stmt->bind_param('iid', $id_cuestionario, $id_usuario, $calificacion);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Registro exitoso"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al guardar"]);
}

$stmt->close();
$db->close();
