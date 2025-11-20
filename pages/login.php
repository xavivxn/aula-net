<?php
session_start();
// Si ya está logueado, redirigir al inicio
if (isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

// Datos de ejemplo
$usuarios_validos = [
    'alumno' => '1234'
];

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (isset($usuarios_validos[$usuario]) && $usuarios_validos[$usuario] === $password) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo'] = $usuario;
        header("Location: inicio.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aula.Net</title>
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
</body>
</html>