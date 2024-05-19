<?php
/**
 * App Landing Page Widgets
 *
 * @package Metro_Magazine
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function metro_magazine_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'metro-magazine' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'metro-magazine' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	 register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar One', 'metro-magazine' ),
		'id'            => 'footer-sidebar-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	  register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Two', 'metro-magazine' ),
		'id'            => 'footer-sidebar-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	   register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Three', 'metro-magazine' ),
		'id'            => 'footer-sidebar-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
 
}
add_action( 'widgets_init', 'metro_magazine_widgets_init' );

/**
 * Load widget featured post.
 */
require get_template_directory() . '/inc/widgets/widget-featured-post.php';

/**
 * Load widget featured post.
 */
require get_template_directory() . '/inc/widgets/widget-popular-post.php';

/**
 * Load widget recent post.
 */
require get_template_directory() . '/inc/widgets/widget-recent-post.php';

/**
 * Load widget social link.
 */
require get_template_directory() . '/inc/widgets/widget-social-links.php';
