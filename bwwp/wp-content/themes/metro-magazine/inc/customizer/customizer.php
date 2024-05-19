<?php
/**
 * Metro Magazine Theme Customizer.
 *
 * @package Metro_Magazine
 */
    function metro_magazine_modify_sections( $wp_customize ){
    if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
          $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'metro-magazine' );
        }
    }
    add_action( 'customize_register', 'metro_magazine_modify_sections' );

    $metro_magazine_settings = array( 'default', 'home', 'ads', 'breadcrumb', 'blog', 'catcolor', 'color', 'custom', 'social', 'info', 'footer' );

    /* Option list of all post */	
    $metro_magazine_options_posts     = array();
    $metro_magazine_options_posts_obj = get_posts('posts_per_page=-1');
    $metro_magazine_options_posts[''] = __( 'Choose Post', 'metro-magazine' );
    foreach ( $metro_magazine_options_posts_obj as $metro_magazine_posts ) {
    	$metro_magazine_options_posts[$metro_magazine_posts->ID] = $metro_magazine_posts->post_title;
    }
    
    /* Option list of all categories */
    $metro_magazine_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $metro_magazine_option_categories     = array();
    $metro_magazine_category_lists        = get_categories( $metro_magazine_args );
    $metro_magazine_option_categories[''] = __( 'Choose Category', 'metro-magazine' );
    foreach( $metro_magazine_category_lists as $metro_magazine_category ){
        $metro_magazine_option_categories[$metro_magazine_category->term_id] = $metro_magazine_category->name;
    }

	foreach( $metro_magazine_settings as $setting ){
		require get_template_directory() . '/inc/customizer/' . $setting . '.php';
	}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function metro_magazine_customize_preview_js() {
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    wp_enqueue_script( 'metro_magazine_customizer', get_template_directory_uri() . '/js' . $build . '/customizer' . $suffix . '.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'metro_magazine_customize_preview_js' );

/**
 * Enqueue Scripts for customize controls
*/
function metro_magazine_customize_scripts() {
    $array = array( 
        'ajax_url'   => admin_url( 'admin-ajax.php' ),
        'flushit'    => __( 'Successfully Flushed!','metro-magazine' ),
        
        'nonce'      => wp_create_nonce('ajax-nonce')
    );
	wp_enqueue_style( 'metro_magazine-customize-style',get_template_directory_uri().'/inc/css/customize.css', '1.0', 'screen' );    
    wp_enqueue_script( 'metro_magazine-admin-js', get_template_directory_uri().'/inc/js/admin.js', array( 'jquery' ), '', true );
    wp_localize_script( 'metro_magazine-admin-js', 'metro_magazine_cdata', $array );
}
add_action( 'customize_controls_enqueue_scripts', 'metro_magazine_customize_scripts' );