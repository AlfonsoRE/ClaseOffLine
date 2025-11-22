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

  // === TAREAS ===
  $stmtTareas = $db->prepare("SELECT * FROM tareas WHERE id_tema = ?");
  $stmtTareas->bind_param("i", $tema_id);
  $stmtTareas->execute();
  $tareas = [];
  $resultTareas = $stmtTareas->get_result();
  while ($tarea = $resultTareas->fetch_assoc()) {
    $tarea_id = $tarea['id'];

    // Archivos de tarea
    $archivosTarea = $db->query("SELECT id, nombre FROM archivos_tarea WHERE id_tareas = $tarea_id")->fetch_all(MYSQLI_ASSOC);

    // Enlaces de tarea
    $enlacesTarea = $db->query("SELECT enlace FROM enlace_tarea WHERE id_tareas = $tarea_id")->fetch_all(MYSQLI_ASSOC);

    $tarea['archivos'] = $archivosTarea;
    $tarea['enlaces'] = $enlacesTarea;
    $tareas[] = $tarea;
  }

  // === MATERIALES ===
  $stmtMaterial = $db->prepare("SELECT * FROM material WHERE id_tema = ?");
  $stmtMaterial->bind_param("i", $tema_id);
  $stmtMaterial->execute();
  $materiales = [];
  $resultMateriales = $stmtMaterial->get_result();
  while ($material = $resultMateriales->fetch_assoc()) {
    $material_id = $material['id'];

    // Archivos de material
    $archivosMaterial = $db->query("SELECT id, nombre FROM archivos_material WHERE id_material = $material_id")->fetch_all(MYSQLI_ASSOC);

    // Enlaces de material
    $enlacesMaterial = $db->query("SELECT enlace FROM enlace_material WHERE id_material = $material_id")->fetch_all(MYSQLI_ASSOC);

    $material['archivos'] = $archivosMaterial;
    $material['enlaces'] = $enlacesMaterial;
    $materiales[] = $material;
  }

  // === CUESTIONARIOS ===
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
