<?php
error_reporting(E_ALL);
require_once 'conexion.php';

header('Content-Type: application/json');

$pass = md5($_POST['pass']);
$stmt = $db->prepare("SELECT id, rol, nombre, email 
                      FROM usuarios 
                      WHERE email=? AND password=? AND status = 'activo'");
$stmt->bind_param('ss', $_POST['email'], $pass);
$stmt->bind_result($id, $rol, $nombre, $email);
$stmt->execute();

if ($stmt->fetch()) {
    echo json_encode([
        "success" => true,
        "id" => $id,
        "rol" => $rol,
        "nombre" => $nombre,
        "email" => $email
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Credenciales incorrectas o usuario inactivo"
    ]);
}

$stmt->close();
?>
