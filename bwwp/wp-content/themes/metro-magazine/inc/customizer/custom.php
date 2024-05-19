<?php
/**
 * Custom Options
 *
 * @package Metro_Magazine
 */
 
 function metro_magazine_customize_register_custom( $wp_customize ) {
    
    if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
        
        /** Custom CSS*/
        $wp_customize->add_section(
            'metro_magazine_custom_settings',
            array(
                'title' => __( 'Custom CSS Settings', 'metro-magazine' ),
                'priority' => 50,
                'capability' => 'edit_theme_options',
            )
        );
        
        $wp_customize->add_setting(
            'metro_magazine_custom_css',
            array(
                'default' => '',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'wp_strip_all_tags'
                )
        );
        
        $wp_customize->add_control(
            'metro_magazine_custom_css',
            array(
                'label' => __( 'Custom Css', 'metro-magazine' ),
                'section' => 'metro_magazine_custom_settings',
                'description' => __( 'Put your custom CSS', 'metro-magazine' ),
                'type' => 'textarea',
            )
        );
        /** Custom CSS Ends */
    }
    
 }
 add_action( 'customize_register', 'metro_magazine_customize_register_custom' );