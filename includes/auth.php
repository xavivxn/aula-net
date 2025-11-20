<?php
function verificarSesion() {
    // Iniciar sesión solo si no está ya iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    }
    
    return $_SESSION;
}
?>