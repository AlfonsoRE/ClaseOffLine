<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
$id_clase = $obj->id_clase ?? null;

if (!$id_clase) {
  echo json_encode(['error' => 'Falta id_clase']);
  exit;
}

// 1. Obtener temas
$sqlTemas = "SELECT * FROM temas WHERE id_clase = ? order by id desc";
$stmtTemas = $db->prepare($sqlTemas);
$stmtTemas->bind_param("i", $id_clase);
$stmtTemas->execute();
$resultTemas = $stmtTemas->get_result();

$temas = [];

while ($tema = $resultTemas->fetch_assoc()) {
  $tema_id = $tema['id'];

  // 2. Tareas del tema
  $stmtTareas = $db->prepare("SELECT * FROM tareas WHERE id_tema = ?");
  $stmtTareas->bind_param("i", $tema_id);
  $stmtTareas->execute();
  $tareas = $stmtTareas->get_result()->fetch_all(MYSQLI_ASSOC);

  // 3. Material del tema
  $stmtMaterial = $db->prepare("SELECT * FROM material WHERE id_tema = ?");
  $stmtMaterial->bind_param("i", $tema_id);
  $stmtMaterial->execute();
  $materiales = $stmtMaterial->get_result()->fetch_all(MYSQLI_ASSOC);

  // 4. Cuestionarios del tema
  $stmtCuest = $db->prepare("SELECT * FROM cuestionarios WHERE id_tema = ?");
  $stmtCuest->bind_param("i", $tema_id);
  $stmtCuest->execute();
  $cuestionarios = $stmtCuest->get_result()->fetch_all(MYSQLI_ASSOC);

  $temas[] = [
    'id' => $tema['id'],
    'titulo' => $tema['titulo'],
    'id_clase' => $tema['id_clase'],
    'tareas' => $tareas,
    'material' => $materiales,
    'cuestionarios' => $cuestionarios
  ];
}

echo json_encode($temas);