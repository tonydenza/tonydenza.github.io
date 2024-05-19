<?php
/**
 * Ads Options
 *
 * @package Metro_Magazine
 */
 
function metro_magazine_customize_register_ads( $wp_customize ) {
	
     /** AD Settings */
    $wp_customize->add_section(
        'metro_magazine_ad_settings',
        array(
            'title'       => __( 'AD Settings', 'metro-magazine' ),
            'description' => __( 'Header & Footer AD Settings', 'metro-magazine' ),
            'priority'    => 40,
            'capability'  => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Header AD */
    $wp_customize->add_setting(
        'metro_magazine_ed_header_ad',
        array(
            'default'           => '',
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_ed_header_ad',
        array(
            'label'   => __( 'Enable Header AD', 'metro-magazine' ),
            'section' => 'metro_magazine_ad_settings',
            'type'    => 'checkbox',
        )
    );
       
    /** Open Link in Different Tab */
    $wp_customize->add_setting(
        'metro_magazine_open_link_diff_tab',
        array(
            'default'           => '1',
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_open_link_diff_tab',
        array(
            'label'   => __( 'Open Link in Different Tab', 'metro-magazine' ),
            'section' => 'metro_magazine_ad_settings',
            'type'    => 'checkbox',
        )
    );
    
    /** Header AD */
    $wp_customize->add_setting(
        'metro_magazine_header_ad',
        array(
            'default'           => '',
            'sanitize_callback' => 'metro_magazine_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Cropped_Image_Control(
           $wp_customize,
           'metro_magazine_header_ad',
           array(
               'label'   => __( 'Upload Header AD', 'metro-magazine' ),
               'section' => 'metro_magazine_ad_settings',
               'width'   => 728,
               'height'  => 90,
           )
       )
    );
    
    /** Header AD Link */
    $wp_customize->add_setting(
        'metro_magazine_header_ad_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_header_ad_link',
        array(
            'label' => __( 'Header AD Link', 'metro-magazine' ),
            'section' => 'metro_magazine_ad_settings',
            'type' => 'text',
        )
    );
    
    }
add_action( 'customize_register', 'metro_magazine_customize_register_ads' );
