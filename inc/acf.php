<?php
/**
 * ACF Field Groups Registration
 *
 * Registers ACF field groups for archive page settings and other custom fields
 *
 * @package DevPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'acf/init', 'devportfolio_register_acf_field_groups' );

function devportfolio_register_acf_field_groups() {
    
    // Archive Page Settings
    if ( function_exists( 'acf_add_options_page' ) ) {
        acf_add_options_page( array(
            'page_title'  => 'Archive Settings',
            'menu_title'  => 'Archive Settings',
            'menu_slug'   => 'archive-settings',
            'capability'  => 'edit_theme_options',
            'position'    => 6,
            'icon_url'    => 'dashicons-admin-page',
            'redirect'    => false,
        ) );
    }

    if ( function_exists( 'acf_add_local_field_group' ) ) {
        
        // Works Archive Settings
        acf_add_local_field_group( array(
            'key' => 'group_works_archive',
            'title' => 'Works Archive Settings',
            'fields' => array(
                array(
                    'key' => 'field_works_archive_title',
                    'label' => 'Section Title',
                    'name' => 'works_archive_title',
                    'type' => 'text',
                    'instructions' => 'Main heading for the works archive page',
                    'default_value' => 'Featured Works',
                    'placeholder' => 'Featured Works',
                ),
                array(
                    'key' => 'field_works_archive_subtitle',
                    'label' => 'Section Subtitle',
                    'name' => 'works_archive_subtitle',
                    'type' => 'textarea',
                    'instructions' => 'Subtitle/description for the works archive page',
                    'default_value' => 'A showcase of innovative projects blending creativity with technical excellence',
                    'placeholder' => 'A showcase of innovative projects blending creativity with technical excellence',
                    'rows' => 2,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'archive-settings',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
        ) );

        // Skills Archive Settings
        acf_add_local_field_group( array(
            'key' => 'group_skills_archive',
            'title' => 'Skills Archive Settings',
            'fields' => array(
                array(
                    'key' => 'field_skills_archive_title',
                    'label' => 'Section Title',
                    'name' => 'skills_archive_title',
                    'type' => 'text',
                    'instructions' => 'Main heading for the skills archive page',
                    'default_value' => 'Skills & Tools',
                    'placeholder' => 'Skills & Tools',
                ),
                array(
                    'key' => 'field_skills_archive_subtitle',
                    'label' => 'Section Subtitle',
                    'name' => 'skills_archive_subtitle',
                    'type' => 'textarea',
                    'instructions' => 'Subtitle/description for the skills archive page',
                    'default_value' => 'Technologies and tools I work with',
                    'placeholder' => 'Technologies and tools I work with',
                    'rows' => 2,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'archive-settings',
                    ),
                ),
            ),
            'menu_order' => 1,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
        ) );

        // Certificates Archive Settings
        acf_add_local_field_group( array(
            'key' => 'group_certificates_archive',
            'title' => 'Certificates Archive Settings',
            'fields' => array(
                array(
                    'key' => 'field_certificates_archive_title',
                    'label' => 'Section Title',
                    'name' => 'certificates_archive_title',
                    'type' => 'text',
                    'instructions' => 'Main heading for the certificates archive page',
                    'default_value' => 'Certificates',
                    'placeholder' => 'Certificates',
                ),
                array(
                    'key' => 'field_certificates_archive_subtitle',
                    'label' => 'Section Subtitle',
                    'name' => 'certificates_archive_subtitle',
                    'type' => 'textarea',
                    'instructions' => 'Subtitle/description for the certificates archive page',
                    'default_value' => 'Professional certifications & achievements',
                    'placeholder' => 'Professional certifications & achievements',
                    'rows' => 2,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'archive-settings',
                    ),
                ),
            ),
            'menu_order' => 2,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
        ) );
    }
}
