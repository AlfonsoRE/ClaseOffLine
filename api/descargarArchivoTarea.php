<?php
require_once 'conexion.php';

if (!isset($_GET['id'])) {
    die("ID de archivo no proporcionado.");
}

$id = intval($_GET['id']);

$stmt = $db->prepare("SELECT nombre, archivo FROM archivos_tarea WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nombre, $archivo);
$stmt->fetch();
$stmt->close();

if ($archivo) {
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . $nombre);
    echo $archivo;
} else {
    echo "Archivo no encontrado.";
}
?>
