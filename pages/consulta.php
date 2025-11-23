<?php
/**
 * Página de Consulta - Reportes y Listados
 * Muestra datos registrados en la base de datos
 */
require_once '../includes/auth.php';
require_once '../includes/config.php';

$sesion = verificarSesion();
$pdo = getDBConnection();

$tipoConsulta = $_GET['tipo'] ?? 'clases';
$resultados = [];
$totalRegistros = 0;

// Realizar consultas según el tipo
if ($pdo !== false) {
    try {
        switch ($tipoConsulta) {
            case 'clases':
                $stmt = $pdo->query("SELECT c.*, u.nombre_completo as profesor_nombre 
                                    FROM clases c 
                                    LEFT JOIN usuarios u ON c.profesor_id = u.id 
                                    ORDER BY c.fecha_creacion DESC");
                $resultados = $stmt->fetchAll();
                $totalRegistros = count($resultados);
                break;
                
            case 'inscripciones':
                $stmt = $pdo->query("SELECT i.*, u.nombre_completo as alumno_nombre, c.titulo as clase_titulo 
                                    FROM inscripciones i 
                                    LEFT JOIN usuarios u ON i.alumno_id = u.id 
                                    LEFT JOIN clases c ON i.clase_id = c.id 
                                    ORDER BY i.fecha_inscripcion DESC");
                $resultados = $stmt->fetchAll();
                $totalRegistros = count($resultados);
                break;
                
            case 'profesores':
                $stmt = $pdo->query("SELECT p.*, u.nombre_completo, u.email 
                                    FROM profesores p 
                                    LEFT JOIN usuarios u ON p.usuario_id = u.id 
                                    ORDER BY p.calificacion DESC");
                $resultados = $stmt->fetchAll();
                $totalRegistros = count($resultados);
                break;
                
            case 'usuarios':
                $stmt = $pdo->query("SELECT id, usuario, tipo, nombre_completo, email, fecha_registro, activo 
                                    FROM usuarios 
                                    ORDER BY fecha_registro DESC");
                $resultados = $stmt->fetchAll();
                $totalRegistros = count($resultados);
                break;
        }
    } catch (PDOException $e) {
        $error = "Error al realizar la consulta: " . $e->getMessage();
        error_log("Error en consulta.php: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas y Reportes - Naser Fernandez - Aula.Net</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .consulta-container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .consulta-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            padding: 30px;
            border-radius: 10px;
            color: white;
            margin-bottom: 30px;
        }
        
        .consulta-header h1 {
            margin: 0 0 10px 0;
        }
        
        .filtros {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .filtro-btn {
            padding: 10px 20px;
            background: white;
            color: var(--primary-dark);
            border: 2px solid var(--primary-dark);
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .filtro-btn:hover,
        .filtro-btn.active {
            background: var(--primary-dark);
            color: white;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-card h3 {
            margin: 0 0 10px 0;
            color: var(--text-light);
            font-size: 0.9em;
        }
        
        .stat-card .number {
            font-size: 2.5em;
            font-weight: bold;
            color: var(--primary-dark);
            margin: 0;
        }
        
        .resultados-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .resultados-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border-color);
        }
        
        .tabla-consulta {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .tabla-consulta th,
        .tabla-consulta td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        .tabla-consulta th {
            background: var(--primary-color);
            color: var(--text-color);
            font-weight: bold;
            position: sticky;
            top: 0;
        }
        
        .tabla-consulta tr:hover {
            background: #f8fafc;
        }
        
        .badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8em;
            font-weight: bold;
            display: inline-block;
        }
        
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .no-resultados {
            text-align: center;
            padding: 40px;
            color: var(--text-light);
        }
        
        .export-btn {
            padding: 10px 20px;
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .export-btn:hover {
            background: #d97706;
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
                    <li><a href="acerca_de_mi.php">Acerca de Mí</a></li>
                    <li><a href="crud.php">Gestionar Clases</a></li>
                    <li><a href="consulta.php" class="active">Consultas</a></li>
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
        <div class="consulta-container">
            <div class="consulta-header">
                <h1>Consultas y Reportes del Sistema</h1>
                <p>Visualiza y analiza los datos registrados en la base de datos</p>
            </div>

            <!-- Filtros de consulta -->
            <div class="filtros">
                <a href="?tipo=clases" class="filtro-btn <?php echo $tipoConsulta === 'clases' ? 'active' : ''; ?>">
                    📚 Clases
                </a>
                <a href="?tipo=inscripciones" class="filtro-btn <?php echo $tipoConsulta === 'inscripciones' ? 'active' : ''; ?>">
                    📝 Inscripciones
                </a>
                <a href="?tipo=profesores" class="filtro-btn <?php echo $tipoConsulta === 'profesores' ? 'active' : ''; ?>">
                    👨‍🏫 Profesores
                </a>
                <a href="?tipo=usuarios" class="filtro-btn <?php echo $tipoConsulta === 'usuarios' ? 'active' : ''; ?>">
                    👥 Usuarios
                </a>
            </div>

            <!-- Estadísticas -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total de Registros</h3>
                    <p class="number"><?php echo $totalRegistros; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Tipo de Consulta</h3>
                    <p class="number" style="font-size: 1.5em;"><?php echo ucfirst($tipoConsulta); ?></p>
                </div>
            </div>

            <!-- Resultados -->
            <div class="resultados-section">
                <div class="resultados-header">
                    <h2>Resultados: <?php echo ucfirst($tipoConsulta); ?></h2>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="text" id="busquedaInput" placeholder="🔍 Buscar en la tabla..." 
                               style="padding: 10px; border: 2px solid var(--border-color); border-radius: 5px; font-size: 1em;">
                        <button class="export-btn" onclick="window.print();">🖨️ Imprimir</button>
                    </div>
                </div>
                
                <div id="contadorResultados" style="margin: 15px 0; color: var(--text-light); font-weight: bold;">
                    Mostrando <?php echo $totalRegistros; ?> registro(s)
                </div>

                <?php if (empty($resultados)): ?>
                    <div class="no-resultados">
                        <p>No se encontraron registros para esta consulta.</p>
                    </div>
                <?php else: ?>
                    <div style="overflow-x: auto;">
                        <table class="tabla-consulta" id="tablaConsulta">
                            <thead>
                                <?php if ($tipoConsulta === 'clases'): ?>
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Categoría</th>
                                        <th>Profesor</th>
                                        <th>Precio</th>
                                        <th>Duración</th>
                                        <th>Estado</th>
                                        <th>Fecha Creación</th>
                                    </tr>
                                <?php elseif ($tipoConsulta === 'inscripciones'): ?>
                                    <tr>
                                        <th>ID</th>
                                        <th>Alumno</th>
                                        <th>Clase</th>
                                        <th>Estado</th>
                                        <th>Nota Final</th>
                                        <th>Fecha Inscripción</th>
                                    </tr>
                                <?php elseif ($tipoConsulta === 'profesores'): ?>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Especialidad</th>
                                        <th>Experiencia</th>
                                        <th>Calificación</th>
                                        <th>Email</th>
                                    </tr>
                                <?php elseif ($tipoConsulta === 'usuarios'): ?>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Tipo</th>
                                        <th>Nombre Completo</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Fecha Registro</th>
                                    </tr>
                                <?php endif; ?>
                            </thead>
                            <tbody>
                                <?php foreach ($resultados as $row): ?>
                                    <tr>
                                        <?php if ($tipoConsulta === 'clases'): ?>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><strong><?php echo htmlspecialchars($row['titulo']); ?></strong></td>
                                            <td><?php echo htmlspecialchars($row['categoria'] ?? 'N/A'); ?></td>
                                            <td><?php echo htmlspecialchars($row['profesor_nombre'] ?? 'N/A'); ?></td>
                                            <td>$<?php echo number_format($row['precio'] ?? 0, 2); ?></td>
                                            <td><?php echo $row['duracion_horas'] ?? 0; ?> hrs</td>
                                            <td>
                                                <span class="badge <?php echo ($row['activa'] ?? 0) ? 'badge-success' : 'badge-danger'; ?>">
                                                    <?php echo ($row['activa'] ?? 0) ? 'Activa' : 'Inactiva'; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y', strtotime($row['fecha_creacion'])); ?></td>
                                            
                                        <?php elseif ($tipoConsulta === 'inscripciones'): ?>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo htmlspecialchars($row['alumno_nombre'] ?? 'N/A'); ?></td>
                                            <td><?php echo htmlspecialchars($row['clase_titulo'] ?? 'N/A'); ?></td>
                                            <td>
                                                <span class="badge badge-info">
                                                    <?php echo ucfirst($row['estado'] ?? 'pendiente'); ?>
                                                </span>
                                            </td>
                                            <td><?php echo $row['nota_final'] ? number_format($row['nota_final'], 2) : 'N/A'; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($row['fecha_inscripcion'])); ?></td>
                                            
                                        <?php elseif ($tipoConsulta === 'profesores'): ?>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><strong><?php echo htmlspecialchars($row['nombre_completo'] ?? 'N/A'); ?></strong></td>
                                            <td><?php echo htmlspecialchars($row['especialidad'] ?? 'N/A'); ?></td>
                                            <td><?php echo $row['experiencia_anos'] ?? 0; ?> años</td>
                                            <td>
                                                <span class="badge badge-success">
                                                    ⭐ <?php echo number_format($row['calificacion'] ?? 0, 2); ?>
                                                </span>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['email'] ?? 'N/A'); ?></td>
                                            
                                        <?php elseif ($tipoConsulta === 'usuarios'): ?>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><strong><?php echo htmlspecialchars($row['usuario']); ?></strong></td>
                                            <td>
                                                <span class="badge badge-info">
                                                    <?php echo ucfirst($row['tipo']); ?>
                                                </span>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['nombre_completo'] ?? 'N/A'); ?></td>
                                            <td><?php echo htmlspecialchars($row['email'] ?? 'N/A'); ?></td>
                                            <td>
                                                <span class="badge <?php echo ($row['activo'] ?? 0) ? 'badge-success' : 'badge-danger'; ?>">
                                                    <?php echo ($row['activo'] ?? 0) ? 'Activo' : 'Inactivo'; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y', strtotime($row['fecha_registro'])); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2025 Aula.Net. Grupo 7 - Plataforma de Clases Particulares.</p>
            <p>Desarrollado por: Naser Fernandez, Ivan Ortiz y Saul Iglesias</p>
        </div>
    </footer>

    <script>
        /**
         * Funcionalidad JavaScript Individual: Búsqueda y Filtrado en Tiempo Real
         * Esta funcionalidad permite buscar y filtrar los resultados de la tabla
         * en tiempo real mientras el usuario escribe, sin necesidad de recargar la página.
         */
        
        document.addEventListener('DOMContentLoaded', function() {
            const busquedaInput = document.getElementById('busquedaInput');
            const tabla = document.getElementById('tablaConsulta');
            const contadorResultados = document.getElementById('contadorResultados');
            
            if (!busquedaInput || !tabla) return;
            
            // Obtener todas las filas de la tabla (excluyendo el encabezado)
            const filas = tabla.querySelectorAll('tbody tr');
            const totalFilas = filas.length;
            
            /**
             * Función para filtrar las filas de la tabla según el texto de búsqueda
             */
            function filtrarTabla() {
                const textoBusqueda = busquedaInput.value.toLowerCase().trim();
                let filasVisibles = 0;
                
                filas.forEach(function(fila) {
                    // Obtener todo el texto de la fila
                    const textoFila = fila.textContent.toLowerCase();
                    
                    // Mostrar u ocultar la fila según coincida con la búsqueda
                    if (textoFila.includes(textoBusqueda)) {
                        fila.style.display = '';
                        filasVisibles++;
                    } else {
                        fila.style.display = 'none';
                    }
                });
                
                // Actualizar contador de resultados
                if (contadorResultados) {
                    if (textoBusqueda === '') {
                        contadorResultados.textContent = `Mostrando ${totalFilas} registro(s)`;
                    } else {
                        contadorResultados.textContent = `Mostrando ${filasVisibles} de ${totalFilas} registro(s)`;
                        
                        // Cambiar color si no hay resultados
                        if (filasVisibles === 0) {
                            contadorResultados.style.color = 'var(--error-color)';
                            contadorResultados.textContent = `No se encontraron resultados para "${textoBusqueda}"`;
                        } else {
                            contadorResultados.style.color = 'var(--text-light)';
                        }
                    }
                }
                
                // Agregar efecto visual a las filas que coinciden
                if (textoBusqueda !== '') {
                    filas.forEach(function(fila) {
                        if (fila.style.display !== 'none') {
                            // Resaltar el texto que coincide
                            const textoFila = fila.textContent;
                            if (textoFila.toLowerCase().includes(textoBusqueda)) {
                                fila.style.backgroundColor = '#fff9e6';
                                fila.style.transition = 'background-color 0.3s';
                            }
                        }
                    });
                } else {
                    // Restaurar color original
                    filas.forEach(function(fila) {
                        fila.style.backgroundColor = '';
                    });
                }
            }
            
            // Agregar evento de entrada de texto (búsqueda en tiempo real)
            busquedaInput.addEventListener('input', filtrarTabla);
            
            // Agregar evento de tecla Enter para limpiar búsqueda
            busquedaInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    busquedaInput.value = '';
                    filtrarTabla();
                    busquedaInput.focus();
                }
            });
            
            // Agregar placeholder dinámico según el tipo de consulta
            const tipoConsulta = '<?php echo $tipoConsulta; ?>';
            const placeholders = {
                'clases': 'Buscar por título, categoría, profesor...',
                'inscripciones': 'Buscar por alumno, clase, estado...',
                'profesores': 'Buscar por nombre, especialidad, email...',
                'usuarios': 'Buscar por usuario, nombre, email, tipo...'
            };
            
            if (placeholders[tipoConsulta]) {
                busquedaInput.placeholder = '🔍 ' + placeholders[tipoConsulta];
            }
        });
        
        /**
         * Función adicional: Resaltar filas al pasar el mouse
         * Mejora la experiencia de usuario al navegar por la tabla
         */
        document.addEventListener('DOMContentLoaded', function() {
            const tabla = document.getElementById('tablaConsulta');
            if (tabla) {
                const filas = tabla.querySelectorAll('tbody tr');
                filas.forEach(function(fila) {
                    fila.addEventListener('mouseenter', function() {
                        if (this.style.display !== 'none') {
                            this.style.transform = 'scale(1.01)';
                            this.style.transition = 'transform 0.2s';
                        }
                    });
                    
                    fila.addEventListener('mouseleave', function() {
                        this.style.transform = 'scale(1)';
                    });
                });
            }
        });
    </script>
</body>
</html>

