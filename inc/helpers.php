<?php
/**
 * Theme Helper Functions
 *
 * @package DevPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Parse a textarea ACF field into an array (one item per line).
 * Useful for technologies, tags, etc. without Repeater.
 *
 * @param string $field_value Raw textarea value.
 * @return array
 */
function devportfolio_parse_lines( $field_value ) {
    if ( empty( $field_value ) ) {
        return array();
    }
    $lines = explode( "\n", $field_value );
    return array_filter( array_map( 'trim', $lines ) );
}

/**
 * Get gallery images for a Work post (free ACF workaround).
 * Returns an array of image arrays from individual gallery fields.
 *
 * @param int $post_id
 * @return array
 */
function devportfolio_get_work_gallery( $post_id = 0 ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $gallery = array();
    for ( $i = 1; $i <= 3; $i++ ) {
        $img = get_field( 'work_gallery_' . $i, $post_id );
        if ( $img ) {
            $gallery[] = $img;
        }
    }
    return $gallery;
}

/**
 * Get proficiency color class based on level.
 *
 * @param string $level
 * @return string CSS class name
 */
function devportfolio_proficiency_color( $level ) {
    $map = array(
        'beginner'     => 'proficiency--beginner',
        'intermediate' => 'proficiency--intermediate',
        'advanced'     => 'proficiency--advanced',
        'expert'       => 'proficiency--expert',
    );
    return isset( $map[ $level ] ) ? $map[ $level ] : '';
}

/**
 * Custom excerpt with character limit.
 *
 * @param int $limit Character count.
 * @return string
 */
function devportfolio_excerpt( $limit = 120 ) {
    $excerpt = get_the_excerpt();
    if ( strlen( $excerpt ) > $limit ) {
        $excerpt = substr( $excerpt, 0, $limit ) . '&hellip;';
    }
    return $excerpt;
}

function devportfolio_get_default_nav_links() {
    $front_url = home_url( '/' );

    $links = array(
        array(
            'url'   => $front_url . '#about',
            'label' => __( 'About', 'dev-portfolio' ),
        ),
        array(
            'url'   => $front_url . '#works',
            'label' => __( 'Works', 'dev-portfolio' ),
        ),
        array(
            'url'   => $front_url . '#skills',
            'label' => __( 'Skills', 'dev-portfolio' ),
        ),
        array(
            'url'   => $front_url . '#certificates',
            'label' => __( 'Certificates', 'dev-portfolio' ),
        ),
        array(
            'url'   => $front_url . '#contact',
            'label' => __( 'Contact', 'dev-portfolio' ),
        ),
    );

    return $links;
}

function devportfolio_get_front_section_map() {
    return array(
        'about'        => 'about',
        'works'        => 'works',
        'work'         => 'works',
        'skills'       => 'skills',
        'skill'        => 'skills',
        'certificates' => 'certificates',
        'certificate'  => 'certificates',
        'contact'      => 'contact',
    );
}

function devportfolio_primary_menu_fallback( $args = null ) {
    $links = devportfolio_get_default_nav_links();

    echo '<ul class="nav-list">';
    foreach ( $links as $link ) {
        printf(
            '<li><a href="%1$s"><span class="nav-label">%2$s</span></a></li>',
            esc_url( $link['url'] ),
            esc_html( $link['label'] )
        );
    }
    echo '</ul>';
}

add_filter( 'wp_nav_menu_items', 'devportfolio_append_pages_to_primary_menu', 10, 2 );

add_filter( 'nav_menu_link_attributes', 'devportfolio_primary_section_menu_links', 10, 4 );

add_filter( 'wp_nav_menu_objects', 'devportfolio_remove_sample_page_from_primary_menu', 10, 2 );

function devportfolio_remove_sample_page_from_primary_menu( $items, $args ) {
    if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
        return $items;
    }

    return array_filter( $items, function ( $item ) {
        return 'sample-page' !== $item->post_name && 'sample-page' !== sanitize_title( $item->title );
    } );
}

function devportfolio_primary_section_menu_links( $atts, $menu_item, $args, $depth ) {
    if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
        return $atts;
    }

    $label = sanitize_title( wp_strip_all_tags( $menu_item->title ) );
    $map   = devportfolio_get_front_section_map();

    if ( isset( $map[ $label ] ) ) {
        $atts['href'] = home_url( '/#' . $map[ $label ] );
    }

    return $atts;
}

function devportfolio_append_pages_to_primary_menu( $items, $args ) {
    if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
        return $items;
    }

    $existing_urls = array();
    $existing_labels = array();

    if ( preg_match_all( '/href=["\']([^"\']+)["\']/', $items, $matches ) ) {
        foreach ( $matches[1] as $existing_url ) {
            $existing_urls[] = esc_url_raw( $existing_url );
            $existing_urls[] = esc_url_raw( home_url( '/' ) . ltrim( $existing_url, '/' ) );
        }
    }

    if ( preg_match_all( '/<a\b[^>]*>(.*?)<\/a>/is', $items, $label_matches ) ) {
        foreach ( $label_matches[1] as $existing_label ) {
            $existing_labels[] = strtolower( trim( wp_strip_all_tags( $existing_label ) ) );
        }
    }

    foreach ( devportfolio_get_default_nav_links() as $link ) {
        $url = esc_url_raw( $link['url'] );
        $label = strtolower( trim( wp_strip_all_tags( $link['label'] ) ) );

        if ( in_array( $url, $existing_urls, true ) || in_array( $label, $existing_labels, true ) ) {
            continue;
        }

        $items .= sprintf(
            '<li class="menu-item menu-item-type-custom"><a href="%1$s"><span class="nav-label">%2$s</span></a></li>',
            esc_url( $link['url'] ),
            esc_html( $link['label'] )
        );
    }

    return $items;
}

add_action( 'admin_post_devportfolio_contact_form', 'devportfolio_handle_contact_form' );
add_action( 'admin_post_nopriv_devportfolio_contact_form', 'devportfolio_handle_contact_form' );

function devportfolio_handle_contact_form() {
    $redirect = wp_get_referer() ?: home_url( '/' );

    if (
        ! isset( $_POST['devportfolio_contact_nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['devportfolio_contact_nonce'] ) ), 'devportfolio_contact_form' )
    ) {
        wp_safe_redirect( add_query_arg( 'contact_status', 'invalid', $redirect ) . '#contact' );
        exit;
    }

    $name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
    $email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
    $message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

    if ( empty( $name ) || empty( $email ) || empty( $message ) || ! is_email( $email ) ) {
        wp_safe_redirect( add_query_arg( 'contact_status', 'invalid', $redirect ) . '#contact' );
        exit;
    }

    $to      = get_option( 'admin_email' );
    $subject = sprintf( __( 'Portfolio contact from %s', 'dev-portfolio' ), $name );
    $body    = sprintf(
        "Name: %s\nEmail: %s\n\nMessage:\n%s",
        $name,
        $email,
        $message
    );
    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

    $sent = wp_mail( $to, $subject, $body, $headers );

    wp_safe_redirect( add_query_arg( 'contact_status', $sent ? 'sent' : 'failed', $redirect ) . '#contact' );
    exit;
}
