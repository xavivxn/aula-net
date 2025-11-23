<?php
session_start();
require_once '../includes/config.php';

// Si ya está logueado, redirigir al inicio
if (isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($usuario) || empty($password)) {
        $error = "Por favor, complete todos los campos";
    } else {
        $pdo = getDBConnection();
        
        if ($pdo === false) {
            $error = "Error de conexión a la base de datos. Por favor, contacte al administrador.";
        } else {
            try {
                $stmt = $pdo->prepare("SELECT id, usuario, password, tipo, nombre_completo, email FROM usuarios WHERE usuario = ? AND activo = 1");
                $stmt->execute([$usuario]);
                $user = $stmt->fetch();
                
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['usuario'] = $user['usuario'];
                    $_SESSION['usuario_id'] = $user['id'];
                    $_SESSION['tipo'] = $user['tipo'];
                    $_SESSION['nombre_completo'] = $user['nombre_completo'];
                    $_SESSION['email'] = $user['email'];
                    header("Location: inicio.php");
                    exit();
                } else {
                    $error = "Usuario o contraseña incorrectos";
                }
            } catch (PDOException $e) {
                error_log("Error en login: " . $e->getMessage());
                $error = "Error al procesar la solicitud. Por favor, intente nuevamente.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Naser Fernandez - Aula.Net</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="login-body">
    <div class="login-main-container">
        <div class="login-container">
            <div class="login-header">
                <div class="login-logo-section">
                    <img src="../images/logo.png" alt="Aula.Net Logo" class="login-logo-image">
                    <h1>Aula.Net</h1>
                </div>
                <ul>
                    <li>· Conecta con profesores y alumnos en linea</li>
                    <li>· Empieza a aprender hoy mismo</li>
                    <li>· Más de 1000 cursos disponibles</li>
                </ul>
            </div>
            
            <form method="POST" class="login-form">
                <?php if ($error): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="login-btn">Iniciar Sesión</button>
            </form>
        </div>
        
        <div class="login-image-container">
            <img src="../images/login-image.jpg" alt="Estudiantes aprendiendo" class="login-image">
        </div>
    </div>
    
    <footer class="main-footer" style="position: fixed; bottom: 0; width: 100%; background: var(--dark-color); color: white; padding: 15px 0; text-align: center;">
        <div class="container">
            <p style="margin: 5px 0;">&copy; 2025 Aula.Net. Grupo 7 - Plataforma de Clases Particulares.</p>
            <p style="margin: 5px 0;">Desarrollado por: Naser Fernandez, Ivan Ortiz y Saul Iglesias</p>
        </div>
    </footer>
</body>
</html>