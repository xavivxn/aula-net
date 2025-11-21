<aside class="sidebar">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        <!-- Sidebar por defecto si no hay widgets -->
        <div class="widget">
            <h3 class="widget-title">Sobre este sitio</h3>
            <p>Bienvenido a la Biblioteca de Recursos Didácticos de Aula.Net. 
            Aquí encontrarás materiales educativos, guías y herramientas para 
            potenciar tu aprendizaje.</p>
        </div>
        
        <div class="widget">
            <h3 class="widget-title">Categorías</h3>
            <ul>
                <?php
                $categories = get_categories(array('hide_empty' => false));
                foreach ($categories as $category) :
                ?>
                    <li>
                        <a href="<?php echo get_category_link($category->term_id); ?>">
                            <?php echo $category->name; ?> (<?php echo $category->count; ?>)
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="widget">
            <h3 class="widget-title">Entradas Recientes</h3>
            <ul>
                <?php
                $recent_posts = wp_get_recent_posts(array('numberposts' => 5));
                foreach ($recent_posts as $post) :
                ?>
                    <li>
                        <a href="<?php echo get_permalink($post['ID']); ?>">
                            <?php echo $post['post_title']; ?>
                        </a>
                    </li>
                <?php endforeach; wp_reset_query(); ?>
            </ul>
        </div>
    <?php endif; ?>
</aside>
