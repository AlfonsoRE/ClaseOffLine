<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

// Verifica que se reciban los datos necesarios
if (!isset($obj->id_tareas) || !isset($obj->enlace)) {
    echo json_encode(["error" => "Faltan datos requeridos"]);
    exit();
}

// Prepara la consulta SQL
$stmt = $db->prepare("INSERT INTO enlace_tarea (id_tareas, enlace, fecha) VALUES (?, ?, NOW())");

if (!$stmt) {
    echo json_encode(["error" => "Error en la preparación de la consulta"]);
    exit();
}

// Asigna los valores
$stmt->bind_param('is', $obj->id_tareas, $obj->enlace);

// Ejecuta la consulta
if ($stmt->execute()) {
    echo json_encode(["mensaje" => "Registro exitoso"]);
} else {
    echo json_encode(["error" => "Error al ejecutar la consulta"]);
}

// Cierra la consulta
$stmt->close();
?>
