<?php 
/**
 * Footer Option.
 *
 * @package Metro Magazine
 */
 
function metro_magazine_customize_footer_settings( $wp_customize ) {

 /** Footer Section */
    $wp_customize->add_section(
        'metro_magazine_footer_section',
        array(
            'title' => __( 'Footer Settings', 'metro-magazine' ),
            'priority' => 70,
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'metro_magazine_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'metro-magazine' ),
            'section' => 'metro_magazine_footer_section',
            'type' => 'textarea',
        )
    );

}
add_action( 'customize_register', 'metro_magazine_customize_footer_settings' ); 