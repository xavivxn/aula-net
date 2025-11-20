<?php
require_once '../includes/auth.php';
$sesion = verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos - Aula.Net</title>
    <link rel="stylesheet" href="../css/styles.css">
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
                    <li><a href="contacto.php" class="active">Contáctenos</a></li>
                    <li><a href="https://empleosnoticias.blogspot.com/2025/10/los-empleos-mas-frecuentes-y-con-mayor.html" target="_blank">Noticias</a></li>
                    <li class="user-menu">
                        <span>Bienvenido, <?php echo ucwords(htmlspecialchars($sesion['usuario'])); ?></span>
                        <a href="../includes/logout.php" class="logout-btn" style="color: white;">Cerrar Sesión</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <!-- Hero Section para Contacto -->
        <section class="contact-hero-section">
            <div class="container">
                <h1>Contáctanos</h1>
                <p>Estamos aquí para ayudarte. Ponte en contacto con nosotros y resolveremos todas tus dudas.</p>
            </div>
        </section>

        <!-- Sección de Información de Contacto -->
        <section class="contact-info-section">
            <div class="container">
                <div class="contact-grid">
                    <!-- Información de contacto -->
                    <div class="contact-details">
                        <h2>Información de Contacto</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        
                        <div class="contact-items">
                            <div class="contact-item">
                                <div class="contact-icon">📍</div>
                                <div class="contact-text">
                                    <h3>Ubicación</h3>
                                    <p>Av. Libertador 1234, Ciudad Universitaria<br>Buenos Aires, Argentina</p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">📞</div>
                                <div class="contact-text">
                                    <h3>Teléfono</h3>
                                    <p>+54 11 1234-5678<br>+54 11 8765-4321</p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">✉️</div>
                                <div class="contact-text">
                                    <h3>Email</h3>
                                    <p>contacto@aula.net<br>soporte@aula.net</p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">🕒</div>
                                <div class="contact-text">
                                    <h3>Horarios de Atención</h3>
                                    <p>Lunes - Viernes: 9:00 AM - 6:00 PM<br>Sábados: 10:00 AM - 2:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de contacto -->
                    <div class="contact-form-container">
                        <h2>Envíanos un Mensaje</h2>
                        <form class="contact-form" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nombre">Nombre Completo *</label>
                                    <input type="text" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electrónico *</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="tel" id="telefono" name="telefono">
                                </div>
                                <div class="form-group">
                                    <label for="asunto">Asunto *</label>
                                    <select id="asunto" name="asunto" required>
                                        <option value="">Selecciona un asunto</option>
                                        <option value="soporte">Soporte Técnico</option>
                                        <option value="informacion">Información de Cursos</option>
                                        <option value="profesor">Quiero ser Profesor</option>
                                        <option value="sugerencia">Sugerencias</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="mensaje">Mensaje *</label>
                                <textarea id="mensaje" name="mensaje" rows="6" placeholder="Escribe tu mensaje aquí..." required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="archivo">Adjuntar Archivo (opcional)</label>
                                <div class="file-input-container">
                                    <input type="file" id="archivo" name="archivo" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                    <label for="archivo" class="file-input-label">
                                        <span class="file-icon">📎</span>
                                        <span class="file-text">Seleccionar archivo</span>
                                    </label>
                                </div>
                                <small>Formatos permitidos: JPG, PNG, PDF, DOC, DOCX (máx. 5MB)</small>
                            </div>
                            
                            <button type="submit" class="contact-submit-btn">Enviar Mensaje</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección del Equipo -->
        <section class="team-section">
            <div class="container">
                <h2>Nuestro Equipo</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Conoce a las personas que hacen posible Aula.Net.</p>
                
                <div class="team-grid">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="../images/team/team1.jpg" alt="Director General" onerror="this.src='../images/default-avatar.svg'">
                        </div>
                        <div class="team-info">
                            <h3>María González</h3>
                            <p class="team-role">Directora General</p>
                            <p class="team-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
                            <div class="team-contact">
                                <span>📧 maria@aula.net</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="team-card">
                        <div class="team-image">
                            <img src="../images/team/team2.jpg" alt="Coordinador Académico" onerror="this.src='../images/default-avatar.svg'">
                        </div>
                        <div class="team-info">
                            <h3>Carlos Rodríguez</h3>
                            <p class="team-role">Coordinador Académico</p>
                            <p class="team-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud.</p>
                            <div class="team-contact">
                                <span>📧 carlos@aula.net</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="team-card">
                        <div class="team-image">
                            <img src="../images/team/team3.jpg" alt="Soporte Técnico" onerror="this.src='../images/default-avatar.svg'">
                        </div>
                        <div class="team-info">
                            <h3>Ana Martínez</h3>
                            <p class="team-role">Soporte Técnico</p>
                            <p class="team-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aute irure dolor in reprehenderit.</p>
                            <div class="team-contact">
                                <span>📧 soporte@aula.net</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de FAQ -->
        <section class="faq-section">
            <div class="container">
                <h2>Preguntas Frecuentes</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Encuentra respuestas a las preguntas más comunes.</p>
                
                <div class="faq-grid">
                    <div class="faq-item">
                        <h3>¿Cómo puedo registrarme como profesor?</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h3>¿Cuáles son los métodos de pago disponibles?</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h3>¿Puedo cancelar una clase?</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h3>¿Cómo funciona el sistema de calificaciones?</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2025 Aula.Net. Grupo 7 - Plataforma de Clases Particulares.</p>
        </div>
    </footer>

    <script>
        // Manejar el formulario de contacto
        document.querySelector('.contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validación básica
            const nombre = document.getElementById('nombre').value;
            const email = document.getElementById('email').value;
            const asunto = document.getElementById('asunto').value;
            const mensaje = document.getElementById('mensaje').value;
            
            if (!nombre || !email || !asunto || !mensaje) {
                alert('Por favor, completa todos los campos obligatorios.');
                return;
            }
            
            // Simulación de envío
            alert('¡Gracias por contactarnos! Tu mensaje ha sido enviado correctamente. Te responderemos pronto.');
            
            // Aquí puedes agregar la lógica real de envío
            // this.submit();
        });
        
        // Manejar la selección de archivos
        document.getElementById('archivo').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Seleccionar archivo';
            document.querySelector('.file-text').textContent = fileName;
        });
    </script>
</body>
</html>
