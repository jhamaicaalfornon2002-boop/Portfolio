<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
    <div class="alfornon-container">
        <div class="alfornon-nav-wrapper">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo alfornon-brand" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                <span class="alfornon-logo-frame">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="alfornon-logo" />
                </span>
            </a>

            <button class="nav-toggle" id="nav-toggle" type="button" aria-label="<?php esc_attr_e( 'Toggle navigation', 'dev-portfolio' ); ?>" aria-controls="site-nav" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <nav class="site-nav alfornon-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'dev-portfolio' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'nav-list',
                    'fallback_cb'    => 'devportfolio_primary_menu_fallback',
                    'depth'          => 1,
                    'link_before'    => '<span class="nav-label">',
                    'link_after'     => '</span>',
                ) );
                ?>
            </nav>
        </div>
    </div>
</header>

<main class="site-main">
