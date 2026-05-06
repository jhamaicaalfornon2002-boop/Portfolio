<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// ─── ACF Logo ───────────────────────────────────────────────
$logo = get_field('hero_logo');
?>

<header class="site-header" id="site-header">
    <div class="container">

        <!-- LOGO -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">

            <?php if ($logo) : ?>
                <img src="<?php echo esc_url($logo['url']); ?>" 
                     alt="<?php echo esc_attr(get_bloginfo('name')); ?>" 
                     class="site-logo__img">

            <?php else : ?>
                <span class="site-logo__text">
                    <?php bloginfo('name'); ?>
                </span>
            <?php endif; ?>

        </a>

        <!-- MOBILE TOGGLE -->
        <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- NAVIGATION -->
        <nav class="site-nav" id="site-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav-list',
                'fallback_cb'    => false,
                'depth'          => 1,
            ));
            ?>
        </nav>

    </div>
</header>

<main class="site-main">