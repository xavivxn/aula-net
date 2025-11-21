# Tema: Aula.Net Biblioteca

Tema personalizado de WordPress para la Biblioteca de Recursos Didácticos del proyecto Aula.Net.

## 🎨 Características del Tema

- ✅ Diseño consistente con Aula.Net
- ✅ Paleta de colores idéntica (rosa/coral)
- ✅ Responsive (móviles, tablets, desktop)
- ✅ Widget personalizado de autor
- ✅ Soporte para imágenes destacadas
- ✅ Sidebar con widgets
- ✅ Navegación personalizable
- ✅ Footer con nombre del autor visible

## 📋 Instrucciones de Activación

### 1. Activar el Tema
1. Ve al panel de WordPress: `http://localhost/programacion_web/wordpress/wp-admin/`
2. Ve a **Apariencia > Temas**
3. Busca "Aula.Net Biblioteca"
4. Haz clic en **Activar**

### 2. Configurar el Menú
1. Ve a **Apariencia > Menús**
2. Crea un nuevo menú llamado "Menú Principal"
3. Agrega las páginas que quieras
4. Asigna el menú a la ubicación **"Menú Principal"**
5. Guarda los cambios

### 3. Configurar Widgets (Sidebar)
1. Ve a **Apariencia > Widgets**
2. En "Sidebar Principal" agrega:
   - **Widget "Autor del Sitio"** (personalizado)
     - Nombre: Tu Nombre Completo
     - Biografía: Una breve descripción tuya
   - **Categorías** (opcional)
   - **Entradas Recientes** (opcional)
   - **Buscar** (opcional)

### 4. Personalizar el Nombre del Sitio
1. Ve a **Ajustes > Generales**
2. **Título del sitio:** Biblioteca de Recursos Didácticos
3. **Descripción:** Tu descripción personalizada
4. Guarda los cambios

### 5. Personalizar el Footer con tu Nombre
1. Edita el archivo: `footer.php` (línea 8)
2. Cambia **"Tu Nombre Aquí"** por tu nombre real
3. Guarda el archivo

### 6. Agregar el Logo
Copia el logo de Aula.Net:
```
Desde: programacion_web/images/logo.png
Hacia: wordpress/wp-content/themes/aula-net-biblioteca/images/logo.png
```

## 📝 Crear Contenido

### Categorías Sugeridas
Ve a **Entradas > Categorías** y crea:
- Programación
- Matemáticas
- Ciencias
- Idiomas
- Música
- Diseño

### Crear Posts (5-7 artículos)

#### Post 1: Bienvenida
- **Título:** "Bienvenidos a la Biblioteca de Recursos Didácticos"
- **Categoría:** Sin categoría
- **Contenido:** 
  - Presentación personal
  - Objetivo del sitio
  - Qué encontrarán los visitantes

#### Post 2: Programación
- **Título:** "10 Mejores Recursos Gratuitos para Aprender Programación"
- **Categoría:** Programación
- **Contenido:**
  - FreeCodeCamp
  - Codecademy
  - GitHub Learning Lab
  - W3Schools
  - MDN Web Docs
  - etc.

#### Post 3: Matemáticas
- **Título:** "Guías de Estudio: Matemáticas para Todos los Niveles"
- **Categoría:** Matemáticas
- **Contenido:**
  - Khan Academy
  - Wolfram Alpha
  - GeoGebra
  - Videos educativos
  - Ejercicios prácticos

#### Post 4: Ciencias
- **Título:** "Recursos de Ciencia: Experimentos y Videos Educativos"
- **Categoría:** Ciencias
- **Contenido:**
  - Canales de YouTube educativos
  - Simuladores online
  - Documentales recomendados

#### Post 5: Idiomas
- **Título:** "Aprende Idiomas: Plataformas y Apps Recomendadas"
- **Categoría:** Idiomas
- **Contenido:**
  - Duolingo
  - Babbel
  - British Council
  - Podcasts
  - Libros digitales

## 🎨 Colores del Tema

```css
--primary-color: #ffedeb;
--primary-dark: #ffa297;
--dark-color: #494070;
--accent-color: #f59e0b;
--text-color: #334155;
--background-color: #f8fafc;
```

## 📁 Estructura de Archivos

```
aula-net-biblioteca/
├── style.css           # Estilos principales
├── functions.php       # Funcionalidades del tema
├── header.php          # Encabezado
├── footer.php          # Pie de página (¡TU NOMBRE AQUÍ!)
├── index.php           # Página principal
├── single.php          # Post individual
├── sidebar.php         # Barra lateral
├── screenshot.png      # Vista previa del tema
├── images/             # Carpeta de imágenes
│   └── logo.png        # Logo (copiar desde /images/)
└── README.md           # Este archivo
```

## ✅ Checklist Final

- [ ] Tema activado
- [ ] Menú configurado
- [ ] Widget de autor agregado con tu nombre
- [ ] Footer personalizado con tu nombre
- [ ] Logo copiado
- [ ] 5-7 posts publicados
- [ ] Categorías creadas
- [ ] Imágenes destacadas en los posts
- [ ] Enlaces permanentes configurados (Ajustes > Enlaces Permanentes)

## 🚀 URLs Importantes

- **Sitio público:** `http://localhost/programacion_web/wordpress/`
- **Panel admin:** `http://localhost/programacion_web/wordpress/wp-admin/`
- **Temas:** `http://localhost/programacion_web/wordpress/wp-admin/themes.php`
- **Entradas:** `http://localhost/programacion_web/wordpress/wp-admin/edit.php`

---

**Nota:** Asegúrate de que tu nombre esté visible en el footer y en el widget de autor para cumplir con los requisitos del proyecto.
