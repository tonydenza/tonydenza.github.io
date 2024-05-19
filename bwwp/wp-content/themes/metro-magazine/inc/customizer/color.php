<?php
/**
 * Color Options
 *
 * @package Metro_Magazine
 */
 
function metro_magazine_customize_register_color_scheme( $wp_customize ) {
    
    /** Category Color Settings */
    $wp_customize->add_section(
        'metro_magazine_color_scheme_settings',
        array(
            'title'       => __( 'Color Scheme Settings', 'metro-magazine' ),
            'description' => __( 'Choose color scheme for theme.', 'metro-magazine' ),
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
        )
    );
      
    $wp_customize->add_setting( 'metro_magazine_color_scheme', 
        array(
        'default'           => '#386FA7',
        'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'metro_magazine_color_scheme', 
        array(
            'label'    => __( 'Color Scheme', 'metro-magazine' ),
            'section'  => 'metro_magazine_color_scheme_settings',
            'settings' => 'metro_magazine_color_scheme',
        )
    ));
    
}
add_action( 'customize_register', 'metro_magazine_customize_register_color_scheme' );