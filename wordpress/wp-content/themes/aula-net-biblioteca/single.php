<?php get_header(); ?>

<main class="site-content single-post">
    <div class="content-area">
        <div class="main-column">
            <?php
            while (have_posts()) : the_post();
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php aula_net_post_categories(); ?>
                        
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        
                        <div class="entry-meta">
                            <?php
                            aula_net_posted_on();
                            aula_net_posted_by();
                            ?>
                            <span class="comments-link">💬 <?php comments_number('0 comentarios', '1 comentario', '% comentarios'); ?></span>
                        </div>
                    </header>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail-single">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    
                    <?php
                    // Navegación entre posts
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    
                    if ($prev_post || $next_post) :
                    ?>
                        <nav class="post-navigation" style="display: flex; justify-content: space-between; margin-top: 40px; padding-top: 30px; border-top: 2px solid #e2e8f0;">
                            <div class="nav-previous">
                                <?php if ($prev_post) : ?>
                                    <a href="<?php echo get_permalink($prev_post); ?>" style="color: #ffa297; text-decoration: none;">
                                        ← <?php echo get_the_title($prev_post); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="nav-next">
                                <?php if ($next_post) : ?>
                                    <a href="<?php echo get_permalink($next_post); ?>" style="color: #ffa297; text-decoration: none;">
                                        <?php echo get_the_title($next_post); ?> →
                                    </a>
                                <?php endif; ?>
                            </div>
                        </nav>
                    <?php endif; ?>
                </article>
            <?php
            endwhile;
            ?>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</main>

<?php get_footer(); ?>
