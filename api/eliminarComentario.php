<?php
error_reporting(E_ALL);
require_once 'conexion.php';

// Obtener los datos enviados (JSON)
$obj = json_decode(file_get_contents("php://input")); 

// Verificar que el parámetro 'id' esté presente
if (isset($obj->id)) {
    // Preparar la consulta SQL para eliminar el comentario
    $stmt = $db->prepare("DELETE FROM comentarios WHERE id = ?");

    // Vincular el parámetro (id)
    $stmt->bind_param('i', $obj->id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Si la consulta fue exitosa, devolver una respuesta positiva
        echo json_encode(array('success' => true, 'message' => 'Comentario eliminado correctamente.'));
    } else {
        // Si hubo un error al ejecutar la consulta
        echo json_encode(array('success' => false, 'message' => 'Error al eliminar el comentario.'));
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    // Si no se envió el id
    echo json_encode(array('success' => false, 'message' => 'Faltan parámetros requeridos.'));
}
?>
