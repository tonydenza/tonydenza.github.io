<?php
/**
 * Breadcrumbs Options
 *
 * @package Metro_Magazine
 */
 
function metro_magazine_customize_register_breadcrumbs( $wp_customize ) {

    /** BreadCrumb Settings */    
    $wp_customize->add_section(
        'metro_magazine_breadcrumb_settings',
        array(
            'title' => __( 'Breadcrumb Settings', 'metro-magazine' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable BreadCrumb */
    $wp_customize->add_setting(
        'metro_magazine_ed_breadcrumb',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_ed_breadcrumb',
        array(
            'label' => __( 'Enable Breadcrumb', 'metro-magazine' ),
            'section' => 'metro_magazine_breadcrumb_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Show/Hide Current */
    $wp_customize->add_setting(
        'metro_magazine_ed_current',
        array(
            'default' => '1',
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_ed_current',
        array(
            'label' => __( 'Show current', 'metro-magazine' ),
            'section' => 'metro_magazine_breadcrumb_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Home Text */
    $wp_customize->add_setting(
        'metro_magazine_breadcrumb_home_text',
        array(
            'default' => __( 'Home', 'metro-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_breadcrumb_home_text',
        array(
            'label' => __( 'Breadcrumb Home Text', 'metro-magazine' ),
            'section' => 'metro_magazine_breadcrumb_settings',
            'type' => 'text',
        )
    );
    
    /** Breadcrumb Separator */
    $wp_customize->add_setting(
        'metro_magazine_breadcrumb_separator',
        array(
            'default' => __( '>', 'metro-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_breadcrumb_separator',
        array(
            'label' => __( 'Breadcrumb Separator', 'metro-magazine' ),
            'section' => 'metro_magazine_breadcrumb_settings',
            'type' => 'text',
        )
    );
    /** BreadCrumb Settings Ends */
    
}
add_action( 'customize_register', 'metro_magazine_customize_register_breadcrumbs' );
