<?php
error_reporting(E_ALL);
require_once 'conexion.php';

define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 3MB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['json']) && isset($_FILES['archivo'])) {
        $json = json_decode($_POST['json']);

        $stmt = $db->prepare("SELECT id,id_tareas,nombre,fecha FROM historial_tareas WHERE id_tareas = ? AND id_usuario = ?");
        $stmt->bind_param('ii', $json->id_tareas, $json->id_usuario);
        $stmt->bind_result($id, $id_tareas, $nombre, $fecha);
        $stmt->execute();
        if ($stmt->fetch()) {
            $stmt->close();
            $nombre = $_FILES['archivo']['name'];
            $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
            $tipo = $_FILES['archivo']['type'];

            // Prepara la consulta SQL para actualizar
            $stmt = $db->prepare("UPDATE historial_tareas SET nombre = ?, archivo = ?, ruta = ? WHERE id_tareas = ? AND id_usuario = ?");
            $stmt->bind_param('sssii', $nombre, $archivo, $tipo, $json->id_tareas, $json->id_usuario);
            $stmt->execute();
            echo json_encode(["status" => "success", "message" => "Archivo guardado correctamente"]);
        } else {
            $stmt = null;
            if ($json && isset($json->id_tareas) && isset($json->id_usuario) && isset($_FILES['archivo'])) {
                if ($_FILES['archivo']['size'] > MAX_FILE_SIZE) {
                    echo json_encode(["status" => "error", "message" => "El archivo excede el límite de 10MB"]);
                    exit;
                }

                $id_tareas = intval($json->id_tareas);
                $id_usuario = intval($json->id_usuario);
                $nombre = $_FILES['archivo']['name'];
                $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
                $tipo = $_FILES['archivo']['type'];

                $stmt = $db->prepare("INSERT INTO historial_tareas (id_tareas, id_usuario, nombre, archivo, ruta,calificacion) VALUES (?, ?, ?, ?, ?,0)");
                $stmt->bind_param('iisss', $id_tareas, $id_usuario, $nombre, $archivo, $tipo);

                if ($stmt->execute()) {
                    echo json_encode(["status" => "success", "message" => "Archivo guardado correctamente"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Error al guardar el archivo"]);
                }

                $stmt->close();
            } else {
                echo json_encode(["status" => "error", "message" => "Datos inválidos"]);
            }
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Faltan parámetros"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}
