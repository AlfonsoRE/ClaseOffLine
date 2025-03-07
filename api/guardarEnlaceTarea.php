<?php
error_reporting(E_ALL);
require_once 'conexion.php';

define('MAX_FILE_SIZE', 3 * 1024 * 1024); // 3MB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['json']) && isset($_FILES['archivo'])) {
        $json = json_decode($_POST['json']);

        if ($json && isset($json->id_tareas) && isset($_FILES['archivo'])) {
            if ($_FILES['archivo']['size'] > MAX_FILE_SIZE) {
                echo json_encode(["status" => "error", "message" => "El archivo excede el límite de 3MB"]);
                exit;
            }

            $id_tareas = intval($json->id_tareas);
            $nombre = $_FILES['archivo']['name'];
            $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
            $tipo = $_FILES['archivo']['type'];

            $stmt = $db->prepare("INSERT INTO enlace_tarea (id_tareas, enlace) VALUES (?, ?)");
            $stmt->bind_param('is', $id_tareas, $nombre);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Enlace guardado correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al guardar el enlace"]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Datos inválidos"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Faltan parámetros"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}
?>
