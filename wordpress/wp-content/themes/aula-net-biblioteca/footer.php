</div><!-- #content -->

<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-info">
            <p class="footer-author">
                <strong>Creado por: Iván Ortiz</strong>
            </p>
            <p class="footer-description">
                Biblioteca de Recursos Didácticos - Parte del proyecto Aula.Net
            </p>
        </div>
        
        <div class="footer-links">
            <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
            <a href="../pages/inicio.php">Volver a Aula.Net</a>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'container' => false,
                'menu_class' => '',
                'depth' => 1,
                'fallback_cb' => false,
            ));
            ?>
        </div>
        
        <?php if (is_active_sidebar('footer-1')) : ?>
            <div class="footer-widgets">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>
        <?php endif; ?>
        
        <div class="footer-copyright">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
            Todos los derechos reservados. | 
            Proyecto de Programación Web - Grupo 7</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
