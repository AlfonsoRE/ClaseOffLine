<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt=$db->prepare("INSERT INTO usuarios(nombre,email,password,rol,fecha_inicio) 
 VALUES(?,?,?,'usuario',NOW())");
$pass = md5($obj->password);
$stmt->bind_param('sss',$obj->nombre,$obj->email,$pass);
$stmt->execute();
$stmt->close();
echo "Registro exitoso";
?>