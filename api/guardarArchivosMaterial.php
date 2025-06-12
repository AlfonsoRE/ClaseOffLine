<?php
error_reporting(E_ALL);
require_once 'conexion.php';

define('MAX_FILE_SIZE', 3 * 1024 * 1024); // 3MB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['json']) && isset($_FILES['archivo'])) {
        $json = json_decode($_POST['json']);
        
        if ($json && isset($json->id_material) && isset($_FILES['archivo'])) {
            if ($_FILES['archivo']['size'] > MAX_FILE_SIZE) {
                echo json_encode(["status" => "error", "message" => "El archivo excede el límite de 3MB"]);
                exit;
            }

            $id_material = intval($json->id_material);
            $nombre = $_FILES['archivo']['name'];
            $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
            $tipo = $_FILES['archivo']['type']; 

            echo "Datos: ".$id_material. $nombre.$tipo;

            $stmt = $db->prepare("INSERT INTO archivos_material (id_material, nombre, archivo,ruta) VALUES (?, ?, ?,?)");
            $stmt->bind_param('isss', $id_material, $nombre, $archivo,$tipo);
            
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Archivo guardado correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al guardar el archivo"]);
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