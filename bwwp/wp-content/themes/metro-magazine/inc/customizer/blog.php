<?php
/**
 * Blog Page Options
 *
 * @package Metro_Magazine
 */
 
function metro_magazine_customize_register_blog_page_settings( $wp_customize ) {
    
    /** Blog Page Settings */
    $wp_customize->add_section(
        'metro_magazine_blog_page_settings',
        array(
            'title'       => __( 'Blog Page Settings', 'metro-magazine' ),
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
        )
    );
      
    $wp_customize->add_setting(
        'metro_magazine_blog_page_read_more',
        array(
            'default'           => 'Read More',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_blog_page_read_more',
        array(
            'label'   => __( 'Read More Label', 'metro-magazine' ),
            'section' => 'metro_magazine_blog_page_settings',
            'type'    => 'text',
        )
    );
    
}
add_action( 'customize_register', 'metro_magazine_customize_register_blog_page_settings' );