<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

// Verifica que se reciba el id_clase
if (!isset($obj->id_clase)) {
    echo json_encode(["error" => "Falta el id_clase"]);
    exit();
}

// Prepara la consulta SQL
$stmt = $db->prepare("SELECT id, id_tema, titulo, descripcion, valor, fecha, fecha_entrega, id_clase FROM tareas WHERE id_clase = ?");

if (!$stmt) {
    echo json_encode(["error" => "Error en la preparación de la consulta"]);
    exit();
}

// Asigna el parámetro
$stmt->bind_param('i', $obj->id_clase);

// Ejecuta la consulta
$stmt->execute();

// Vincula los resultados
$stmt->bind_result($id, $id_tema, $titulo, $descripcion, $valor, $fecha, $fecha_entrega, $id_clase);

$arr = array();

// Obtiene todas las tareas de la clase
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tema' => $id_tema,
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'valor' => $valor,
        'fecha' => $fecha,
        'fecha_entrega' => $fecha_entrega,
        'id_clase' => $id_clase
    );
}

// Cierra la consulta
$stmt->close();

// Retorna los resultados en formato JSON
echo json_encode($arr);
?>
