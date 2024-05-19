<?php
/**
 * Custom Options
 *
 * @package Metro_Magazine
 */
 
function metro_magazine_customize_register_catcolor( $wp_customize ) {
    
    /** Category Color Settings */
    $wp_customize->add_section(
        'metro_magazine_cat_color_settings',
        array(
            'title'       => __( 'Category Color Settings', 'metro-magazine' ),
            'description' => __( 'Choose color for specific category.', 'metro-magazine' ),
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
        )
    );
    
    $args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'hide_empty'               => 0,
	   'taxonomy'                 => 'category'
    ); 
    
    $category_lists = get_categories( $args );
    
    foreach( $category_lists as $category ){
        
        $wp_customize->add_setting( 'metro_magazine_category_color_' . $category->term_id, 
            array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color'
            )
        );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'metro_magazine_category_color_' . $category->term_id, 
            array(
                'label'    => $category->name,
                'section'  => 'metro_magazine_cat_color_settings',
                'settings' => 'metro_magazine_category_color_' . $category->term_id,
            )
        ));
    }
    
}
add_action( 'customize_register', 'metro_magazine_customize_register_catcolor' );