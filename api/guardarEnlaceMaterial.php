<?php
error_reporting(E_ALL);
require_once 'conexion.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

define('MAX_FILE_SIZE', 3 * 1024 * 1024); // 3MB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se recibieron los parámetros necesarios
    if (isset($_POST['json']) && isset($_FILES['archivo'])) {
        $json = json_decode($_POST['json']);

        // Verifica si el JSON y los parámetros son válidos
        if ($json && isset($json->id_material) && isset($_FILES['archivo'])) {
            
            // Verifica el tamaño del archivo
            if ($_FILES['archivo']['size'] > MAX_FILE_SIZE) {
                echo json_encode(["status" => "error", "message" => "El archivo excede el límite de 3MB"]);
                exit;
            }

            // Extrae los datos del JSON
            $id_material = intval($json->id_material);
            $nombre = $_FILES['archivo']['name'];
            
            // Verifica que el archivo sea un archivo de texto (txt)
            $ext = pathinfo($nombre, PATHINFO_EXTENSION);
            if ($ext !== 'txt') {
                echo json_encode(["status" => "error", "message" => "El archivo debe ser un archivo de texto (.txt)"]);
                exit;
            }

            // Lee el contenido del archivo, que será la URL
            $enlace = file_get_contents($_FILES['archivo']['tmp_name']);
            
            // Si el archivo está vacío, lo trataremos como un enlace vacío
            if ($enlace === false) {
                $enlace = ''; // Enlace vacío
            }

            // Prepara la consulta SQL para insertar el enlace en la base de datos
            $stmt = $db->prepare("INSERT INTO enlace_material (id_material, enlace, fecha) VALUES (?, ?, NOW())");

            if (!$stmt) {
                echo json_encode(["status" => "error", "message" => "Error en la preparación de la consulta"]);
                exit();
            }

            // Asigna los valores a la consulta
            $stmt->bind_param('is', $id_material, $enlace);

            // Ejecuta la consulta
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Enlace guardado correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al guardar el enlace"]);
            }

            // Cierra la consulta
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
