<?php
require_once '../includes/auth.php';
require_once '../includes/Clase.php';
$sesion = verificarSesion();
$clasesPopulares = new ClasesPopulares();
$clases = $clasesPopulares->obtenerClases();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Naser Fernandez - Aula.Net</title>
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
                    <li><a href="inicio.php" class="active">Inicio</a></li>
                    <li><a href="contacto.php">Contáctenos</a></li>
                    <li><a href="acerca_de_mi.php">Acerca de Mí</a></li>
                    <li><a href="crud.php">Gestionar Clases</a></li>
                    <li><a href="consulta.php">Consultas</a></li>
                    <li><a href="../wordpress/" target="_blank">Biblioteca de Recursos</a></li>
                    <li><a href="https://empleosnoticias.blogspot.com/2025/10/los-empleos-mas-frecuentes-y-con-mayor.html" target="_blank">Noticias</a></li>
                    <li class="user-menu">
                        <span>Bienvenido, <?php echo ucwords(htmlspecialchars($sesion['usuario'])); ?></span>
                        <a href="../includes/logout.php" class="logout-btn">Cerrar Sesión</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <section class="hero-section">
            <div class="container">
                <h2>Encuentra un profesor</h2>
                <p>Conectamos profesores particulares con alumnos que buscan clases en distintas materias o habilidades.</p>
                
                <div class="search-section">
                    <input type="text" placeholder="Buscar por materia, profesor o habilidad...">
                    <button class="search-btn">Buscar</button>
                </div>
            </div>
        </section>

        <!-- Sección de Clases Populares -->
        <section class="popular-classes-section">
            <div class="container">
                <h2>Clases Más Solicitadas</h2>
                <p>Descubre los cursos favoritos de nuestros estudiantes</p>
                
                <div class="carousel-container">
                    <button class="carousel-btn carousel-btn-prev" onclick="moveCarousel(-1)">&#8249;</button>
                    <div class="carousel-wrapper">
                        <div class="carousel-track" id="carouselTrack">
                            <?php foreach ($clases as $index => $clase): ?>
                                <div class="class-card" data-index="<?php echo $index; ?>">
                                    <div class="card-image">
                                        <img src="../images/classes/<?php echo $clase->imagen; ?>" alt="<?php echo htmlspecialchars($clase->titulo); ?>" onerror="this.src='../images/default-class.svg'">
                                        <div class="card-category"><?php echo htmlspecialchars($clase->categoria); ?></div>
                                    </div>
                                    <div class="card-content">
                                        <h3><?php echo htmlspecialchars($clase->titulo); ?></h3>
                                        <p class="card-description"><?php echo htmlspecialchars($clase->descripcion); ?></p>
                                        <p class="card-professor">Profesor: <?php echo htmlspecialchars($clase->profesor); ?></p>
                                        <button class="start-btn" onclick="empezarClase('<?php echo htmlspecialchars($clase->titulo); ?>')">¡Empezar!</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button class="carousel-btn carousel-btn-next" onclick="moveCarousel(1)">&#8250;</button>
                </div>
                
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < count($clases); $i++): ?>
                        <button class="indicator <?php echo $i === 0 ? 'active' : ''; ?>" onclick="goToSlide(<?php echo $i; ?>)" data-index="<?php echo $i; ?>"></button>
                    <?php endfor; ?>
                </div>
            </div>
        </section>

        <section class="features-section">
            <div class="container">
                <div class="features-grid">
                    <div class="feature-card">
                        <h3>Para Alumnos</h3>
                        <p>Encuentra el profesor ideal para tus necesidades de aprendizaje</p>
                    </div>
                    <div class="feature-card">
                        <h3>Para Profesores</h3>
                        <p>Comparte tus conocimientos y conecta con estudiantes</p>
                    </div>
                    <div class="feature-card">
                        <h3>Múltiples Materias</h3>
                        <p>Desde matemáticas hasta música, encuentra lo que necesitas</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2025 Aula.Net. Grupo 7 - Plataforma de Clases Particulares.</p>
            <p>Desarrollado por: Naser Fernandez, Ivan Ortiz y Saul Iglesias</p>
        </div>
    </footer>

    <script>
        let currentSlide = 0;
        const totalSlides = <?php echo count($clases); ?>;
        const slidesToShow = 3; // Número de cards visibles a la vez
        let autoSlideInterval;

        function updateCarousel() {
            const track = document.getElementById('carouselTrack');
            const cardWidth = track.querySelector('.class-card').offsetWidth + 20; // 20px de gap
            const translateX = -currentSlide * cardWidth;
            track.style.transform = `translateX(${translateX}px)`;
            
            // Actualizar indicadores
            document.querySelectorAll('.indicator').forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSlide);
            });
        }

        function moveCarousel(direction) {
            const maxSlide = Math.max(0, totalSlides - slidesToShow);
            currentSlide += direction;
            
            if (currentSlide < 0) {
                currentSlide = maxSlide;
            } else if (currentSlide > maxSlide) {
                currentSlide = 0;
            }
            
            updateCarousel();
            resetAutoSlide();
        }

        function goToSlide(slideIndex) {
            const maxSlide = Math.max(0, totalSlides - slidesToShow);
            currentSlide = Math.min(slideIndex, maxSlide);
            updateCarousel();
            resetAutoSlide();
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                moveCarousel(1);
            }, 4000); // Cambiar cada 4 segundos
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        function empezarClase(titulo) {
            alert(`¡Excelente elección! Pronto comenzarás la clase: "${titulo}"`);
            // Aquí puedes agregar la lógica para redirigir a la página de la clase
        }

        // Inicializar carousel
        document.addEventListener('DOMContentLoaded', function() {
            updateCarousel();
            startAutoSlide();
            
            // Pausar auto-slide cuando el mouse está sobre el carousel
            const carouselContainer = document.querySelector('.carousel-container');
            carouselContainer.addEventListener('mouseenter', () => {
                clearInterval(autoSlideInterval);
            });
            
            carouselContainer.addEventListener('mouseleave', () => {
                startAutoSlide();
            });
        });

        // Responsive: ajustar slides visibles según el tamaño de pantalla
        function handleResize() {
            updateCarousel();
        }

        window.addEventListener('resize', handleResize);
    </script>
</body>
</html>