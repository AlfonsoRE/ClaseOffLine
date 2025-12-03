<?php
// 1. Obtener las variables del entorno de Render
// Usamos getenv() para leer las variables configuradas en el panel de Render
$host    = getenv('DB_HOST');
$user    = getenv('DB_USER');
$pass    = getenv('DB_PASS');
$db_name = getenv('DB_NAME');
$port    = (int)getenv('DB_PORT'); // Puerto 4000
$ssl_ca  = getenv('DB_SSL_CA'); // Ruta al archivo ./ca.pem

// 2. Crear un nuevo objeto MySQLi
$db = new mysqli();

// --- CONFIGURACIÓN SSL OBLIGATORIA PARA TiDB CLOUD ---

// 3. Establecer las opciones de conexión SSL
// Se asegura que el certificado del servidor es verificado (Requisito de TiDB)
$db->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);

// 4. Cargar el archivo .pem para la conexión segura
// La ruta ($ssl_ca) debe ser la que definiste en la variable de entorno (ej: './ca.pem')
$db->ssl_set(
    NULL, // key
    NULL, // cert
    $ssl_ca, // <--- RUTA AL ARCHIVO .PEM
    NULL, // cipher
    NULL // tls_version
);

// 5. Intentar la conexión usando real_connect (necesario después de ssl_set)
// Se pasan todos los parámetros, incluyendo el puerto
$db->real_connect($host, $user, $pass, $db_name, $port);

// --- Manejo de Errores y UTF-8 (Igual que tu estilo) ---

// 6. Manejo de error de conexión
if ($db->connect_errno > 0) {
    echo "Database connection error: " . $db->connect_error;
    // En un entorno de producción, es mejor solo mostrar un error genérico
    exit;
}

// 7. Configuración de acentos (UTF-8)
$acentos = $db->query("SET NAMES 'utf8'");
?>