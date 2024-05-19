<?php
/**
 * Social Options
 *
 * @package Metro_Magazine
 */
 
 function metro_magazine_customize_register_social( $wp_customize ) {
    
    /** Social Settings */
    $wp_customize->add_section(
        'metro_magazine_social_settings',
        array(
            'title' => __( 'Social Settings', 'metro-magazine' ),
            'description' => __( 'Leave blank if you do not want to show the social link.', 'metro-magazine' ),
            'priority' => 90,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Social in Header */
    $wp_customize->add_setting(
        'metro_magazine_ed_social',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_ed_social',
        array(
            'label' => __( 'Enable Social Links', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Facebook */
    $wp_customize->add_setting(
        'metro_magazine_facebook',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_facebook',
        array(
            'label' => __( 'Facebook', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );
    
    
    /** Twitter */
    $wp_customize->add_setting(
        'metro_magazine_twitter',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_twitter',
        array(
            'label' => __( 'Twitter', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );
      
    /** LinkedIn */
    $wp_customize->add_setting(
        'metro_magazine_linkedin',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_linkedin',
        array(
            'label' => __( 'LinkedIn', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );

    /** Pinterest */
    $wp_customize->add_setting(
        'metro_magazine_pinterest',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_pinterest',
        array(
            'label' => __( 'Pinterest', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );
    
    /** Instagram */
    $wp_customize->add_setting(
        'metro_magazine_instagram',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_instagram',
        array(
            'label' => __( 'Instagram', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );

    /** Google Plus */
    $wp_customize->add_setting(
        'metro_magazine_google',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_google',
        array(
            'label' => __( 'Google Plus', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );

    /** YouTube */
    $wp_customize->add_setting(
        'metro_magazine_youtube',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_youtube',
        array(
            'label' => __( 'Youtube', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );
    
    /** OK */
    $wp_customize->add_setting(
        'metro_magazine_odnoklassniki',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_odnoklassniki',
        array(
            'label' => __( 'OK', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );
    
    /** VK */
    $wp_customize->add_setting(
        'metro_magazine_vk',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_vk',
        array(
            'label' => __( 'VK', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );
    
    /** Xing */
    $wp_customize->add_setting(
        'metro_magazine_xing',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_xing',
        array(
            'label' => __( 'Xing', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );

    
    /** Tiktok */
    $wp_customize->add_setting(
        'metro_magazine_tiktok',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_tiktok',
        array(
            'label' => __( 'Tiktok', 'metro-magazine' ),
            'section' => 'metro_magazine_social_settings',
            'type' => 'text',
        )
    );
    /** Social Settings Ends */
    
 }
 add_action( 'customize_register', 'metro_magazine_customize_register_social' );