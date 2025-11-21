<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1>Biblioteca de Recursos Didácticos</h1>
        <p>Descubre recursos educativos gratuitos para potenciar tu aprendizaje. 
        Guías, tutoriales, herramientas y más para estudiantes y profesores.</p>
    </div>
</section>

<!-- Contenido Principal -->
<main class="site-content">
    <div class="content-area">
        <div class="main-column">
            <div class="posts-grid">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('post-thumbnail', array('class' => 'post-thumbnail')); ?>
                            </a>
                        <?php endif; ?>
                        
                        <div class="post-content-wrapper">
                            <?php aula_net_post_categories(); ?>
                            
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="entry-meta">
                                <?php
                                aula_net_posted_on();
                                aula_net_posted_by();
                                ?>
                                <span class="comments-link">💬 <?php comments_number('0 comentarios', '1 comentario', '% comentarios'); ?></span>
                            </div>
                            
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                Leer más →
                            </a>
                        </div>
                    </article>
                <?php
                    endwhile;
                    
                    // Paginación
                    aula_net_pagination();
                    
                else :
                ?>
                    <article class="post">
                        <div class="post-content-wrapper">
                            <h2>No se encontraron recursos</h2>
                            <p>Aún no hay recursos publicados. ¡Vuelve pronto!</p>
                        </div>
                    </article>
                <?php endif; ?>
            </div>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</main>

<?php get_footer(); ?>
