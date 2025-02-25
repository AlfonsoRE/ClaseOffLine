<?php
$dbConnect = array(
    'server' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'dbname' => 'esf'
);

$db = new mysqli(
    $dbConnect['server'],
    $dbConnect['user'],
    $dbConnect['pass'],
    $dbConnect['dbname']
);
if ($db->connect_errno>0) {
    echo "Database connection error" . $db->connect_error;
    exit;
}

$acentos = $db->query("SET NAMES 'utf8'");
?>