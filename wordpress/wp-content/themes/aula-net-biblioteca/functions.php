<?php
/**
 * Aula.Net Biblioteca Theme Functions
 */

// Cargar estilos y scripts del tema
function aula_net_enqueue_styles() {
    // Cargar el archivo style.css principal
    wp_enqueue_style('aula-net-style', get_stylesheet_uri(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'aula_net_enqueue_styles');

// Configuración del tema
function aula_net_setup() {
    // Soporte para título dinámico
    add_theme_support('title-tag');
    
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(800, 400, true);
    
    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Registrar menús
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'aula-net-biblioteca'),
        'footer' => __('Menú Footer', 'aula-net-biblioteca'),
    ));
}
add_action('after_setup_theme', 'aula_net_setup');

// Registrar áreas de widgets
function aula_net_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'aula-net-biblioteca'),
        'id'            => 'sidebar-1',
        'description'   => __('Widgets para la barra lateral', 'aula-net-biblioteca'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer', 'aula-net-biblioteca'),
        'id'            => 'footer-1',
        'description'   => __('Widgets para el footer', 'aula-net-biblioteca'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'aula_net_widgets_init');

// Tamaños de extracto
function aula_net_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'aula_net_excerpt_length');

function aula_net_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'aula_net_excerpt_more');

// Formatear fecha en español
function aula_net_posted_on() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    
    $time_string = sprintf($time_string,
        esc_attr(get_the_date('c')),
        esc_html(get_the_date())
    );
    
    echo '<span class="posted-on">📅 ' . $time_string . '</span>';
}

// Mostrar autor
function aula_net_posted_by() {
    echo '<span class="byline">✍️ ' . get_the_author() . '</span>';
}

// Mostrar categorías
function aula_net_post_categories() {
    $categories = get_the_category();
    if ($categories) {
        echo '<div class="post-categories">';
        foreach ($categories as $category) {
            echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
        }
        echo '</div>';
    }
}

// Paginación personalizada
function aula_net_pagination() {
    global $wp_query;
    
    $big = 999999999;
    
    echo '<div class="pagination">';
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '← Anterior',
        'next_text' => 'Siguiente →',
        'type' => 'plain'
    ));
    echo '</div>';
}

// Widget personalizado de autor
class Aula_Net_Author_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'aula_net_author',
            'Autor del Sitio',
            array('description' => 'Muestra información del autor')
        );
    }
    
    public function widget($args, $instance) {
        echo $args['before_widget'];
        ?>
        <div class="author-widget">
            <img src="<?php echo get_template_directory_uri(); ?>/images/author-avatar.jpg" 
                 alt="Autor" 
                 class="author-avatar"
                 onerror="this.src='<?php echo get_template_directory_uri(); ?>/images/default-avatar.png'">
            <h3 class="author-name"><?php echo esc_html($instance['name']); ?></h3>
            <p class="author-bio"><?php echo esc_html($instance['bio']); ?></p>
        </div>
        <?php
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $name = !empty($instance['name']) ? $instance['name'] : 'Tu Nombre';
        $bio = !empty($instance['bio']) ? $instance['bio'] : 'Escribe tu biografía aquí...';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('name'); ?>">Nombre:</label>
            <input class="widefat" 
                   id="<?php echo $this->get_field_id('name'); ?>" 
                   name="<?php echo $this->get_field_name('name'); ?>" 
                   type="text" 
                   value="<?php echo esc_attr($name); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bio'); ?>">Biografía:</label>
            <textarea class="widefat" 
                      id="<?php echo $this->get_field_id('bio'); ?>" 
                      name="<?php echo $this->get_field_name('bio'); ?>" 
                      rows="5"><?php echo esc_textarea($bio); ?></textarea>
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['name'] = (!empty($new_instance['name'])) ? strip_tags($new_instance['name']) : '';
        $instance['bio'] = (!empty($new_instance['bio'])) ? strip_tags($new_instance['bio']) : '';
        return $instance;
    }
}

function aula_net_register_widgets() {
    register_widget('Aula_Net_Author_Widget');
}
add_action('widgets_init', 'aula_net_register_widgets');
