<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

// Verifica que se reciba el id_clase
if (!isset($obj->id_clase) || !is_numeric($obj->id_clase)) {
    echo json_encode(["error" => "Falta o es inválido el id_clase"]);
    exit();
}

// Prepara la consulta SQL
$stmt = $db->prepare("SELECT id, id_tema, titulo, descripcion, valor, fecha, fecha_entrega, id_clase FROM tareas WHERE id_clase = ?");

if (!$stmt) {
    echo json_encode(["error" => "Error en la preparación de la consulta: " . $db->error]);
    exit();
}

// Asigna el parámetro
$stmt->bind_param('i', $obj->id_clase);

// Ejecuta la consulta
if (!$stmt->execute()) {
    echo json_encode(["error" => "Error en la ejecución de la consulta: " . $stmt->error]);
    exit();
}

// Obtiene los resultados
$result = $stmt->get_result();

$arr = array();

// Obtiene todas las tareas de la clase
while ($row = $result->fetch_assoc()) {
    $arr[] = $row;
}

// Cierra la consulta
$stmt->close();

// Retorna los resultados en formato JSON
echo json_encode($arr);
?>
