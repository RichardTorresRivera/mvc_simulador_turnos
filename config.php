<?php
// config.php
define('DB_HOST', 'sql10.freesqldatabase.com');
define('DB_NAME', 'sql10785579');
define('DB_USER', 'sql10785579');
define('DB_PASS', 'XrMRhQE3KZ');
define('DB_PORT', 3306);

function conectarDB() {
    try {
        $dsn = "mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=utf8";
        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        return new PDO($dsn, DB_USER, DB_PASS, $opciones);
    } catch (PDOException $e) {
        die("Error al conectar con la base de datos: " . $e->getMessage());
    }
}
?>