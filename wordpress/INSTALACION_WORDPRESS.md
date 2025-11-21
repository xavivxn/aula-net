# Guía de Instalación de WordPress - Biblioteca de Recursos Didácticos

## 📋 Pasos para Configurar WordPress

### 1. Iniciar Servicios de XAMPP
1. Abre el **Panel de Control de XAMPP**
2. Inicia **Apache**
3. Inicia **MySQL**

### 2. Crear la Base de Datos

**Opción A: Usando phpMyAdmin**
1. Abre tu navegador y ve a: `http://localhost/phpmyadmin`
2. Haz clic en "Nueva" en el panel izquierdo
3. Nombre de la base de datos: `aula_net_wp`
4. Cotejamiento: `utf8mb4_unicode_ci`
5. Haz clic en "Crear"

**Opción B: Usando SQL directo**
1. En phpMyAdmin, ve a la pestaña "SQL"
2. Copia y pega el contenido del archivo `create_database.sql`
3. Haz clic en "Continuar"

### 3. Instalar WordPress

1. Abre tu navegador
2. Ve a: `http://localhost/programacion_web/wordpress/`
3. Deberías ver la pantalla de instalación de WordPress
4. Haz clic en "¡Vamos a ello!"

### 4. Completar la Instalación

WordPress te pedirá la siguiente información:

**Información del sitio:**
- **Título del sitio:** Biblioteca de Recursos Didácticos - Aula.Net
- **Nombre de usuario:** admin (o tu nombre)
- **Contraseña:** (crea una segura)
- **Tu email:** tu_email@ejemplo.com
- **Visibilidad:** Marca la casilla para que los motores de búsqueda indexen el sitio

Haz clic en **"Instalar WordPress"**

### 5. Acceder al Panel de Administración

1. URL de acceso: `http://localhost/programacion_web/wordpress/wp-admin/`
2. Usuario: El que creaste en el paso anterior
3. Contraseña: La que creaste en el paso anterior

---

## 🎨 Configuración del Tema Personalizado

Una vez instalado WordPress, necesitarás:

### 1. Crear un Tema Personalizado
El tema se creará para mantener la consistencia visual con Aula.Net:
- Colores: Rosa/Coral (#ffedeb - #ffa297)
- Tipografía: Segoe UI
- Header con logo de Aula.Net
- Footer con tu nombre visible

### 2. Contenido Sugerido

**Páginas principales:**
- Inicio (Bienvenida a la Biblioteca)
- Sobre Mí (Tu nombre y presentación)
- Recursos por Categoría
- Contacto

**Categorías de recursos:**
- Programación
- Matemáticas
- Ciencias
- Idiomas
- Música
- Diseño

**Posts sugeridos (5-7 artículos):**
1. "Bienvenidos a la Biblioteca de Recursos Didácticos"
2. "10 Mejores Recursos Gratuitos para Aprender Programación"
3. "Guías de Estudio: Matemáticas para Todos los Niveles"
4. "Recursos de Ciencia: Experimentos y Videos Educativos"
5. "Aprende Idiomas: Plataformas y Apps Recomendadas"
6. "Música para Principiantes: Tutoriales y Partituras Gratis"
7. "Diseño Gráfico: Herramientas y Recursos Gratuitos"

---

## ✅ Verificación

Asegúrate de que:
- [ ] WordPress está instalado correctamente
- [ ] Puedes acceder al panel de administración
- [ ] El enlace desde el menú principal funciona
- [ ] La URL muestra claramente que es WordPress: `/wordpress/`
- [ ] Tu nombre está visible en el sitio

---

## 🔧 Troubleshooting

### Error: "Error establishing a database connection"
- Verifica que MySQL esté corriendo en XAMPP
- Verifica que la base de datos `aula_net_wp` exista
- Verifica las credenciales en `wp-config.php`

### Error 404 en las páginas
- Ve a: Ajustes > Enlaces Permanentes
- Selecciona "Nombre de la entrada"
- Guarda cambios

### No puedo acceder al panel de administración
- URL correcta: `http://localhost/programacion_web/wordpress/wp-admin/`
- Verifica usuario y contraseña

---

## 📝 Notas Importantes

1. **Nombre visible:** Asegúrate de que tu nombre esté visible en:
   - Footer del sitio
   - Página "Sobre Mí"
   - Firma de autor en los posts

2. **Contenido relacionado:** Todos los recursos deben estar relacionados con educación/aprendizaje

3. **Diseño consistente:** Usa los mismos colores y estilos del sitio principal

4. **No incluir:** Plantillas genéricas, contacto duplicado, etc.

---

## 🎯 Siguiente Paso

Una vez instalado WordPress, avísame para:
1. Crear el tema personalizado
2. Configurar las páginas y categorías
3. Crear el contenido de ejemplo
4. Personalizar el diseño

¡Listo para comenzar! 🚀
