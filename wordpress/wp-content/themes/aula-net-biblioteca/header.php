<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-container">
        <div class="site-branding">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" 
                     alt="<?php bloginfo('name'); ?>" 
                     class="logo-image"
                     onerror="this.style.display='none'">
                <div>
                    <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                    <?php 
                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) : 
                    ?>
                        <p class="site-description"><?php echo $description; ?></p>
                    <?php endif; ?>
                </div>
            </a>
        </div>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'primary-menu',
                'fallback_cb' => false,
            ));
            ?>
        </nav>
    </div>
</header>

<div id="content" class="site-content">
