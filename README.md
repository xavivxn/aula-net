# Aula.Net - Plataforma de Clases Particulares

Plataforma web para conectar profesores particulares con alumnos que buscan clases en distintas materias o habilidades.

## 🚀 Características

- ✅ Sistema de autenticación de usuarios
- ✅ Catálogo de clases más solicitadas con carousel
- ✅ Página de contacto con formulario completo
- ✅ Diseño responsive y moderno
- ✅ Paleta de colores consistente
- ✅ Navegación intuitiva

## 📋 Requisitos Previos

- **XAMPP** (o cualquier servidor con PHP y MySQL)
- **PHP 7.4** o superior
- **Navegador web** moderno

## 🔧 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/TU_USUARIO/programacion_web.git
```

### 2. Mover a la carpeta de XAMPP

Copia la carpeta del proyecto a:
```
C:\xampp\htdocs\programacion_web
```

### 3. Iniciar XAMPP

- Abre el Panel de Control de XAMPP
- Inicia **Apache**
- (Opcional) Inicia **MySQL** si planeas agregar base de datos

### 4. Agregar imágenes

Coloca tus imágenes en las siguientes carpetas:
- `images/logo.png` - Logo de la aplicación
- `images/login-image.jpg` - Imagen de la página de login
- `images/classes/` - Imágenes de las clases
- `images/team/` - Fotos del equipo

### 5. Acceder a la aplicación

Abre tu navegador y visita:
```
http://localhost/programacion_web/pages/login.php
```

## 👤 Credenciales de Prueba

- **Usuario:** `alumno`
- **Contraseña:** `1234`

## 📁 Estructura del Proyecto

```
programacion_web/
├── css/
│   └── styles.css          # Estilos globales
├── images/
│   ├── classes/            # Imágenes de clases
│   ├── team/               # Fotos del equipo
│   ├── logo.png
│   ├── login-image.jpg
│   ├── default-class.svg
│   └── default-avatar.svg
├── includes/
│   ├── auth.php            # Sistema de autenticación
│   ├── Clase.php           # Clase para manejar cursos
│   └── logout.php          # Cierre de sesión
├── pages/
│   ├── contacto.php        # Página de contacto
│   ├── inicio.php          # Página principal
│   └── login.php           # Página de login
└── index.php               # Punto de entrada
```

## 🎨 Paleta de Colores

- **Primary:** `#ffedeb` - `#ffa297`
- **Secondary:** `#64748b`
- **Accent:** `#f59e0b`
- **Dark:** `#494070`
- **Background:** `#f8fafc`

## 🛠️ Tecnologías Utilizadas

- **HTML5** - Estructura
- **CSS3** - Estilos y diseño
- **JavaScript** - Interactividad
- **PHP** - Backend y lógica del servidor

## 📝 Funcionalidades Principales

### Sistema de Login
- Validación de usuarios
- Gestión de sesiones
- Redirección automática

### Carousel de Clases
- 10 clases predefinidas
- Navegación manual con botones
- Indicadores de posición
- Diseño responsive

### Página de Contacto
- Formulario completo con validación
- Posibilidad de adjuntar archivos
- Sección del equipo
- FAQ (Preguntas frecuentes)

## 👥 Autores

**Grupo 7** - Proyecto de Programación Web

## 📄 Licencia

Este proyecto es de código abierto y está disponible para fines educativos.

## 🤝 Contribuir

Si deseas contribuir al proyecto:

1. Haz un Fork del repositorio
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📧 Contacto

Para más información, visita la sección de contacto en la aplicación.

---

⭐ Si te gusta este proyecto, no olvides darle una estrella en GitHub
