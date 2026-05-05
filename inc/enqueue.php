<?php
/**
 * Enqueue Styles & Scripts
 *
 * @package DevPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_enqueue_scripts', 'devportfolio_enqueue_assets' );

function devportfolio_enqueue_assets() {
    $main_css_version      = file_exists( DEV_PORTFOLIO_DIR . '/assets/css/main.css' ) ? filemtime( DEV_PORTFOLIO_DIR . '/assets/css/main.css' ) : DEV_PORTFOLIO_VERSION;
    $alfornon_js_version   = file_exists( DEV_PORTFOLIO_DIR . '/assets/js/alfornon.js' ) ? filemtime( DEV_PORTFOLIO_DIR . '/assets/js/alfornon.js' ) : DEV_PORTFOLIO_VERSION;

    wp_enqueue_style(
        'devportfolio-google-fonts',
        'https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'devportfolio-main',
        DEV_PORTFOLIO_URI . '/assets/css/main.css',
        array(),
        $main_css_version
    );

    wp_enqueue_script(
        'devportfolio-alfornon',
        DEV_PORTFOLIO_URI . '/assets/js/alfornon.js',
        array(),
        $alfornon_js_version,
        true
    );
}
