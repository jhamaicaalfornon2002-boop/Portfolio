<?php
/**
 * Dev Portfolio - functions.php
 * Theme setup, CPT registration, ACF field groups, and asset enqueue.
 *
 * @package DevPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'DEV_PORTFOLIO_VERSION', '1.0.0' );
define( 'DEV_PORTFOLIO_DIR', get_template_directory() );
define( 'DEV_PORTFOLIO_URI', get_template_directory_uri() );

// ─── Include Modules ────────────────────────────────────────────────
require_once DEV_PORTFOLIO_DIR . '/inc/theme-setup.php';
require_once DEV_PORTFOLIO_DIR . '/inc/custom-post-types.php';
require_once DEV_PORTFOLIO_DIR . '/inc/enqueue.php';
require_once DEV_PORTFOLIO_DIR . '/inc/helpers.php';
