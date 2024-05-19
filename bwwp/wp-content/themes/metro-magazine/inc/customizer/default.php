<?php
/**
 * Default Theme Option.
 *
 * @package Metro_Magazine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

 
function metro_magazine_customize_register_default( $wp_customize ) {

    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Default Settings', 'metro-magazine' ),
            'description' => __( 'Default section provided by wordpress customizer.', 'metro-magazine' ),
        ) 
    );

    $wp_customize->add_section(
        'metro_magazine_typography_section',
        array(
            'title' => __( 'Typography Settings', 'metro-magazine' ),
            'priority' => 80,
        )
    );

    $wp_customize->add_setting(
        'ed_localgoogle_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_localgoogle_fonts',
        array(
            'label'   => __( 'Load Google Fonts Locally', 'metro-magazine' ),
            'section' => 'metro_magazine_typography_section',
            'type'    => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'ed_preload_local_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_preload_local_fonts',
        array(
            'label'           => __( 'Preload Local Fonts', 'metro-magazine' ),
            'section'         => 'metro_magazine_typography_section',
            'type'            => 'checkbox',
            'active_callback' => 'metro_magazine_flush_fonts_callback'
        )
    );
    

    $wp_customize->add_setting(
        'flush_google_fonts',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses',
        )
    );

    $wp_customize->add_control(
        'flush_google_fonts',
        array(
            'label'       => __( 'Flush Local Fonts Cache', 'metro-magazine' ),
            'description' => __( 'Click the button to reset the local fonts cache.', 'metro-magazine' ),
            'type'        => 'button',
            'settings'    => array(),
            'section'     => 'metro_magazine_typography_section',
            'input_attrs' => array(
                'value' => __( 'Flush Local Fonts Cache', 'metro-magazine' ),
                'class' => 'button button-primary flush-it',
            ),
            'active_callback' => 'metro_magazine_flush_fonts_callback'
        )
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel     = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel            = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel  = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel = 'wp_default_panel'; 
    $wp_customize->get_section( 'metro_magazine_typography_section' )->panel = 'wp_default_panel';
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
    
}
add_action( 'customize_register', 'metro_magazine_customize_register_default' );

function metro_magazine_flush_fonts_callback( $control ){
    $ed_localgoogle_fonts   = $control->manager->get_setting( 'ed_localgoogle_fonts' )->value();
    $control_id   = $control->id;
    
    if ( $control_id == 'flush_google_fonts' && $ed_localgoogle_fonts ) return true;
    if ( $control_id == 'ed_preload_local_fonts' && $ed_localgoogle_fonts ) return true;
    return false;
}