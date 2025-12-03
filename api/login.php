<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$pass = md5($_POST['pass']);
$stmt = $db->prepare("SELECT id,rol, nombre, email FROM usuarios where email=? and password=? and status = 'activo'");
$stmt->bind_param('ss', $_POST['email'], $pass);
$stmt->bind_result($id,$rol, $nombre,$email);
$stmt->execute();

if($stmt->fetch()){
    session_start();
    $_SESSION['usuario'] = $nombre;
    $_SESSION['id'] = $id;
    if($rol=="usuario"){
    $_SESSION['rol']=$rol;
    header("Location: ../app/dashboard.php");
    }
    if($rol=="administador"){
    $_SESSION['rol']=$rol;    
    header("Location: ../app/dashboardAdmin.php");
    }     
}
else{
header("Location: ../app/index.php");
}

$stmt->close();
?>