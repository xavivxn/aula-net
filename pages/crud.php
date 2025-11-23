<?php
/**
 * Página CRUD - Gestión de Clases
 * Create, Read, Update, Delete de clases del sistema
 */
require_once '../includes/auth.php';
require_once '../includes/config.php';

$sesion = verificarSesion();
$pdo = getDBConnection();

$mensaje = '';
$tipoMensaje = '';
$claseEditar = null;

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    
    if ($accion === 'crear') {
        $titulo = $_POST['titulo'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $precio = $_POST['precio'] ?? 0;
        $duracion = $_POST['duracion_horas'] ?? 0;
        $imagen = $_POST['imagen'] ?? '';
        
        if (!empty($titulo) && !empty($descripcion)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO clases (titulo, descripcion, categoria, precio, duracion_horas, imagen, profesor_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$titulo, $descripcion, $categoria, $precio, $duracion, $imagen, 2]);
                $mensaje = "Clase creada exitosamente";
                $tipoMensaje = 'success';
            } catch (PDOException $e) {
                $mensaje = "Error al crear la clase: " . $e->getMessage();
                $tipoMensaje = 'error';
            }
        } else {
            $mensaje = "Por favor, complete todos los campos obligatorios";
            $tipoMensaje = 'error';
        }
    }
    
    if ($accion === 'actualizar') {
        $id = $_POST['id'] ?? 0;
        $titulo = $_POST['titulo'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $precio = $_POST['precio'] ?? 0;
        $duracion = $_POST['duracion_horas'] ?? 0;
        $imagen = $_POST['imagen'] ?? '';
        $activa = isset($_POST['activa']) ? 1 : 0;
        
        if ($id > 0 && !empty($titulo)) {
            try {
                $stmt = $pdo->prepare("UPDATE clases SET titulo = ?, descripcion = ?, categoria = ?, precio = ?, duracion_horas = ?, imagen = ?, activa = ? WHERE id = ?");
                $stmt->execute([$titulo, $descripcion, $categoria, $precio, $duracion, $imagen, $activa, $id]);
                $mensaje = "Clase actualizada exitosamente";
                $tipoMensaje = 'success';
            } catch (PDOException $e) {
                $mensaje = "Error al actualizar la clase: " . $e->getMessage();
                $tipoMensaje = 'error';
            }
        }
    }
    
    if ($accion === 'eliminar') {
        $id = $_POST['id'] ?? 0;
        if ($id > 0) {
            try {
                $stmt = $pdo->prepare("DELETE FROM clases WHERE id = ?");
                $stmt->execute([$id]);
                $mensaje = "Clase eliminada exitosamente";
                $tipoMensaje = 'success';
            } catch (PDOException $e) {
                $mensaje = "Error al eliminar la clase: " . $e->getMessage();
                $tipoMensaje = 'error';
            }
        }
    }
}

// Obtener clase para editar
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM clases WHERE id = ?");
        $stmt->execute([$id]);
        $claseEditar = $stmt->fetch();
    } catch (PDOException $e) {
        $mensaje = "Error al cargar la clase: " . $e->getMessage();
        $tipoMensaje = 'error';
    }
}

// Obtener todas las clases
$clases = [];
if ($pdo !== false) {
    try {
        $stmt = $pdo->query("SELECT * FROM clases ORDER BY fecha_creacion DESC");
        $clases = $stmt->fetchAll();
    } catch (PDOException $e) {
        $mensaje = "Error al cargar las clases: " . $e->getMessage();
        $tipoMensaje = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Clases - Naser Fernandez - Aula.Net</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .crud-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .crud-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 10px;
            color: white;
        }
        
        .crud-header h1 {
            margin: 0;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: var(--accent-color);
            color: white;
        }
        
        .btn-primary:hover {
            background: #d97706;
        }
        
        .btn-success {
            background: #10b981;
            color: white;
        }
        
        .btn-danger {
            background: var(--error-color);
            color: white;
        }
        
        .btn-warning {
            background: #f59e0b;
            color: white;
        }
        
        .message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .message.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }
        
        .message.error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid var(--error-color);
        }
        
        .crud-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }
        
        .form-section, .list-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: var(--text-color);
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 1em;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .clases-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .clases-table th,
        .clases-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        .clases-table th {
            background: var(--primary-color);
            color: var(--text-color);
            font-weight: bold;
        }
        
        .clases-table tr:hover {
            background: #f8fafc;
        }
        
        .actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-small {
            padding: 5px 10px;
            font-size: 0.9em;
        }
        
        .badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8em;
            font-weight: bold;
        }
        
        .badge-active {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
        }
        
        @media (max-width: 968px) {
            .crud-grid {
                grid-template-columns: 1fr;
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
                    <li><a href="acerca_de_mi.php">Acerca de Mí</a></li>
                    <li><a href="crud.php" class="active">Gestionar Clases</a></li>
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
        <div class="crud-container">
            <div class="crud-header">
                <h1>Gestión de Clases (CRUD)</h1>
                <?php if ($claseEditar): ?>
                    <a href="crud.php" class="btn btn-primary">Nueva Clase</a>
                <?php endif; ?>
            </div>

            <?php if ($mensaje): ?>
                <div class="message <?php echo $tipoMensaje; ?>">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>

            <div class="crud-grid">
                <!-- Formulario CREATE/UPDATE -->
                <div class="form-section">
                    <h2><?php echo $claseEditar ? 'Editar Clase' : 'Crear Nueva Clase'; ?></h2>
                    <form method="POST">
                        <input type="hidden" name="accion" value="<?php echo $claseEditar ? 'actualizar' : 'crear'; ?>">
                        <?php if ($claseEditar): ?>
                            <input type="hidden" name="id" value="<?php echo $claseEditar['id']; ?>">
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="titulo">Título *</label>
                            <input type="text" id="titulo" name="titulo" 
                                   value="<?php echo htmlspecialchars($claseEditar['titulo'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="descripcion">Descripción *</label>
                            <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($claseEditar['descripcion'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <select id="categoria" name="categoria">
                                <option value="Tecnología" <?php echo (($claseEditar['categoria'] ?? '') === 'Tecnología') ? 'selected' : ''; ?>>Tecnología</option>
                                <option value="Música" <?php echo (($claseEditar['categoria'] ?? '') === 'Música') ? 'selected' : ''; ?>>Música</option>
                                <option value="Ciencias" <?php echo (($claseEditar['categoria'] ?? '') === 'Ciencias') ? 'selected' : ''; ?>>Ciencias</option>
                                <option value="Idiomas" <?php echo (($claseEditar['categoria'] ?? '') === 'Idiomas') ? 'selected' : ''; ?>>Idiomas</option>
                                <option value="Arte y Diseño" <?php echo (($claseEditar['categoria'] ?? '') === 'Arte y Diseño') ? 'selected' : ''; ?>>Arte y Diseño</option>
                                <option value="Gastronomía" <?php echo (($claseEditar['categoria'] ?? '') === 'Gastronomía') ? 'selected' : ''; ?>>Gastronomía</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="precio">Precio ($)</label>
                            <input type="number" id="precio" name="precio" step="0.01" min="0"
                                   value="<?php echo htmlspecialchars($claseEditar['precio'] ?? '0'); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="duracion_horas">Duración (horas)</label>
                            <input type="number" id="duracion_horas" name="duracion_horas" min="0"
                                   value="<?php echo htmlspecialchars($claseEditar['duracion_horas'] ?? '0'); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="imagen">Nombre de Imagen</label>
                            <input type="text" id="imagen" name="imagen" 
                                   value="<?php echo htmlspecialchars($claseEditar['imagen'] ?? ''); ?>"
                                   placeholder="ej: programming.jpg">
                        </div>
                        
                        <?php if ($claseEditar): ?>
                            <div class="form-group checkbox-group">
                                <input type="checkbox" id="activa" name="activa" 
                                       <?php echo ($claseEditar['activa'] ?? 0) ? 'checked' : ''; ?>>
                                <label for="activa">Clase activa</label>
                            </div>
                        <?php endif; ?>
                        
                        <button type="submit" class="btn btn-success">
                            <?php echo $claseEditar ? 'Actualizar Clase' : 'Crear Clase'; ?>
                        </button>
                    </form>
                </div>

                <!-- Lista READ -->
                <div class="list-section">
                    <h2>Lista de Clases (<?php echo count($clases); ?>)</h2>
                    <?php if (empty($clases)): ?>
                        <p>No hay clases registradas. Crea una nueva clase usando el formulario.</p>
                    <?php else: ?>
                        <table class="clases-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clases as $clase): ?>
                                    <tr>
                                        <td><?php echo $clase['id']; ?></td>
                                        <td><?php echo htmlspecialchars($clase['titulo']); ?></td>
                                        <td><?php echo htmlspecialchars($clase['categoria'] ?? 'N/A'); ?></td>
                                        <td>$<?php echo number_format($clase['precio'] ?? 0, 2); ?></td>
                                        <td>
                                            <span class="badge <?php echo ($clase['activa'] ?? 0) ? 'badge-active' : 'badge-inactive'; ?>">
                                                <?php echo ($clase['activa'] ?? 0) ? 'Activa' : 'Inactiva'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="?editar=<?php echo $clase['id']; ?>" class="btn btn-warning btn-small">Editar</a>
                                                <form method="POST" style="display: inline;" 
                                                      onsubmit="return confirm('¿Está seguro de eliminar esta clase?');">
                                                    <input type="hidden" name="accion" value="eliminar">
                                                    <input type="hidden" name="id" value="<?php echo $clase['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-small">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
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

