<?php
/**
 * Configuración de conexión a la base de datos
 * Aula.Net - Sistema de Clases Particulares
 */

// Configuración de la base de datos
// Para Docker, usar 'db' como host, para XAMPP usar 'localhost'
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'aula_net');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_CHARSET', 'utf8mb4');

/**
 * Función para obtener conexión a la base de datos
 * @return PDO|false Retorna objeto PDO o false en caso de error
 */
function getDBConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            return false;
        }
    }
    
    return $pdo;
}

/**
 * Función para verificar conexión a la base de datos
 * @return bool
 */
function testDBConnection() {
    $pdo = getDBConnection();
    return $pdo !== false;
}

