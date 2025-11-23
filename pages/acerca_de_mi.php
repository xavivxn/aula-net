<?php
/**
 * Página "Acerca de mí" - Individual
 * IMPORTANTE: Cambiar 'alumno_nfernandez' por 'alumno_[tu_inicial][tu_apellido]'
 * Ejemplo: Si tu nombre es Juan Pérez → alumno_jperez
 */
require_once '../includes/auth.php';
require_once '../includes/config.php';

$sesion = verificarSesion();
$pdo = getDBConnection();
$datosAlumno = null;
$error = '';

// Consultar datos del alumno desde la tabla
// CAMBIAR: 'alumno_nfernandez' por el nombre de tu tabla
$tablaAlumno = 'alumno_nfernandez'; // ⚠️ CAMBIAR ESTO POR TU TABLA

if ($pdo !== false) {
    try {
        $stmt = $pdo->prepare("SELECT nombres, numero_cedula, correo_electronico, fecha_registro FROM $tablaAlumno LIMIT 1");
        $stmt->execute();
        $datosAlumno = $stmt->fetch();
        
        if (!$datosAlumno) {
            $error = "No se encontraron datos en la tabla. Por favor, carga tus datos en la base de datos.";
        }
    } catch (PDOException $e) {
        $error = "Error al consultar los datos: " . $e->getMessage();
        error_log("Error en acerca_de_mi.php: " . $e->getMessage());
    }
} else {
    $error = "Error de conexión a la base de datos.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de Mí - Naser Fernandez - Aula.Net</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .about-me-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .about-me-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 15px;
            color: white;
        }
        
        .about-me-header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .about-me-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .profile-image-section {
            text-align: center;
        }
        
        .profile-image {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--primary-dark);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        
        .profile-info {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .info-item {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: bold;
            color: var(--primary-dark);
            margin-bottom: 5px;
            display: block;
        }
        
        .info-value {
            color: var(--text-color);
            font-size: 1.1em;
        }
        
        .code-section {
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 25px;
            border-radius: 10px;
            margin-top: 30px;
            overflow-x: auto;
        }
        
        .code-section h3 {
            color: #4ec9b0;
            margin-bottom: 15px;
        }
        
        .code-section pre {
            margin: 0;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            line-height: 1.6;
        }
        
        .code-comment {
            color: #6a9955;
        }
        
        .code-keyword {
            color: #569cd6;
        }
        
        .code-string {
            color: #ce9178;
        }
        
        .error-box {
            background: #fee;
            border: 2px solid var(--error-color);
            color: var(--error-color);
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        
        @media (max-width: 768px) {
            .about-me-content {
                grid-template-columns: 1fr;
            }
            
            .profile-image {
                width: 200px;
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <img src="../images/logo.png" alt="Aula.Net Logo" class="logo-image">
                <h1>Aula.Net</h1>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="inicio.php">Inicio</a></li>
                    <li><a href="contacto.php">Contáctenos</a></li>
                    <li><a href="acerca_de_mi.php" class="active">Acerca de Mí</a></li>
                    <li><a href="crud.php">Gestionar Clases</a></li>
                    <li><a href="consulta.php">Consultas</a></li>
                    <li><a href="../wordpress/" target="_blank">Biblioteca de Recursos</a></li>
                    <li class="user-menu">
                        <span>Bienvenido, <?php echo ucwords(htmlspecialchars($sesion['usuario'])); ?></span>
                        <a href="../includes/logout.php" class="logout-btn">Cerrar Sesión</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="about-me-container">
            <div class="about-me-header">
                <h1>Acerca de Mí</h1>
                <p>Conoce más sobre el desarrollador de este proyecto</p>
            </div>

            <?php if ($error): ?>
                <div class="error-box">
                    <strong>⚠️ Error:</strong> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if ($datosAlumno): ?>
                <div class="about-me-content">
                    <div class="profile-image-section">
                        <img src="../images/default-avatar.svg" alt="Foto de perfil" class="profile-image" 
                             onerror="this.src='../images/default-avatar.svg'">
                        <h2 style="color: var(--primary-dark); margin-top: 15px;">
                            <?php echo htmlspecialchars($datosAlumno['nombres']); ?>
                        </h2>
                    </div>
                    
                    <div class="profile-info">
                        <div class="info-item">
                            <span class="info-label">📝 Nombres Completos:</span>
                            <span class="info-value"><?php echo htmlspecialchars($datosAlumno['nombres']); ?></span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">🆔 Número de Cédula:</span>
                            <span class="info-value"><?php echo htmlspecialchars($datosAlumno['numero_cedula']); ?></span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">📧 Correo Electrónico:</span>
                            <span class="info-value">
                                <a href="mailto:<?php echo htmlspecialchars($datosAlumno['correo_electronico']); ?>" 
                                   style="color: var(--primary-dark); text-decoration: none;">
                                    <?php echo htmlspecialchars($datosAlumno['correo_electronico']); ?>
                                </a>
                            </span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">📅 Fecha de Registro:</span>
                            <span class="info-value">
                                <?php 
                                $fecha = new DateTime($datosAlumno['fecha_registro']);
                                echo $fecha->format('d/m/Y H:i:s');
                                ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Sección de código fuente -->
                <div class="code-section">
                    <h3>💻 Código Fuente - Consulta a Base de Datos</h3>
                    <pre>
<span class="code-comment">// Consulta a la tabla alumno_jperez para obtener los datos del alumno</span>
<span class="code-keyword">$tablaAlumno</span> = <span class="code-string">'alumno_nfernandez'</span>; <span class="code-comment">// Nombre de la tabla personalizada</span>

<span class="code-keyword">$stmt</span> = <span class="code-keyword">$pdo</span>-><span class="code-keyword">prepare</span>(<span class="code-string">"SELECT nombres, numero_cedula, correo_electronico, fecha_registro 
FROM $tablaAlumno LIMIT 1"</span>);
<span class="code-keyword">$stmt</span>-><span class="code-keyword">execute</span>();
<span class="code-keyword">$datosAlumno</span> = <span class="code-keyword">$stmt</span>-><span class="code-keyword">fetch</span>();

<span class="code-comment">// Los datos se muestran en la página usando:</span>
<span class="code-keyword">echo</span> <span class="code-keyword">htmlspecialchars</span>(<span class="code-keyword">$datosAlumno</span>[<span class="code-string">'nombres'</span>]);
<span class="code-keyword">echo</span> <span class="code-keyword">htmlspecialchars</span>(<span class="code-keyword">$datosAlumno</span>[<span class="code-string">'numero_cedula'</span>]);
<span class="code-keyword">echo</span> <span class="code-keyword">htmlspecialchars</span>(<span class="code-keyword">$datosAlumno</span>[<span class="code-string">'correo_electronico'</span>]);
                    </pre>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2025 Aula.Net. Grupo 7 - Plataforma de Clases Particulares.</p>
            <p>Desarrollado por: Naser Fernandez, Ivan Ortiz y Saul Iglesias</p>
        </div>
    </footer>
</body>
</html>

