<?php
error_reporting(E_ALL);
require_once 'conexion.php';

// Obtener el JSON enviado
$obj = json_decode(file_get_contents("php://input")); 

// Verificar que los parámetros estén presentes
if (isset($obj->id) && isset($obj->comentario)) {
    // Preparar la consulta SQL para actualizar el comentario
    $stmt = $db->prepare("UPDATE comentarios 
                          SET comentario = ?, fecha_comentario = NOW() 
                          WHERE id = ?");
    
    // Vincular los parámetros (comentario y id)
    $stmt->bind_param('si', $obj->comentario, $obj->id);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Si la consulta se ejecuta correctamente, enviar una respuesta de éxito
        echo json_encode(array('success' => 'Comentario actualizado correctamente.'));
    } else {
        // Si hubo un error en la ejecución de la consulta
        echo json_encode(array('error' => 'Error al actualizar el comentario.'));
    }
    
    // Cerrar la declaración
    $stmt->close();
} else {
    // Si no se proporcionaron los parámetros necesarios
    echo json_encode(array('error' => 'Faltan parámetros: id o comentario.'));
}
?>
