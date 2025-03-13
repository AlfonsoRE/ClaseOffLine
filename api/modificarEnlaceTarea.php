<?php
error_reporting(E_ALL);
require_once 'conexion.php';

// Obtener los datos JSON enviados
$obj = json_decode(file_get_contents("php://input"));

// Verificar que se reciban todos los datos necesarios
if (!isset($obj->id) || !isset($obj->id_tareas) || !isset($obj->enlace)) {
    echo json_encode(["error" => "Faltan parámetros"]);
    exit();
}

// Preparar la consulta SQL para actualizar el registro en enlace_tarea
$stmt = $db->prepare("UPDATE enlace_tarea SET id_tareas = ?, enlace = ? WHERE id = ?");
$stmt->bind_param('isi', $obj->id_tareas, $obj->enlace, $obj->id);

// Ejecutar la consulta
$stmt->execute();

// Cerrar la sentencia
$stmt->close();

// Devolver un mensaje de éxito
echo "Enlace de tarea modificado exitosamente";
?>
