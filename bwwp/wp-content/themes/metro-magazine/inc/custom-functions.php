<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Metro_Magazine
 */
 
 if ( ! function_exists( 'metro_magazine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function metro_magazine_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Metro Magazine, use a find and replace
	 * to change 'metro-magazine' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'metro-magazine', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
    
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'metro-magazine' ),
		'secondary' => esc_html__( 'Top Menu', 'metro-magazine' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
        'gallery',
        'status',
        'audio', 
        'chat'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'metro_magazine_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	// Custom Image Size
    add_image_size( 'metro-magazine-banner-post', 285, 307, true );
    add_image_size( 'metro-magazine-with-sidebar', 833, 474, true );
    add_image_size( 'metro-magazine-without-sidebar', 1110, 474, true );
    add_image_size( 'metro-magazine-featured-post', 285, 307, true );
    add_image_size( 'metro-magazine-promotional-post',322, 209, true);
    add_image_size( 'metro-magazine-recent-post', 78, 78, true );
    add_image_size( 'metro-magazine-search-thumbnail',230, 158, true );
    add_image_size( 'metro-magazine-promotional-block', 230, 230, true );    
    add_image_size( 'metro-magazine-featured-big', 752 , 365, true );
    add_image_size( 'metro-magazine-featured-mid', 384 , 365, true );
    add_image_size( 'metro-magazine-featured-small', 282 , 245, true );
    add_image_size( 'metro-magazine-three-row', 251 , 250, true );
    add_image_size( 'metro-magazine-three-col', 360 , 246, true );
    add_image_size( 'metro-magazine-more-news', 321 , 206, true );
    
    /** Custom Logo */
    add_theme_support( 'custom-logo', array(    	
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );

    if( metro_magazine_is_woocommerce_activated() ){
        global $woocommerce;
        // Woocommerce support
        add_theme_support( 'woocommerce' );
        if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
            add_theme_support( 'wc-product-gallery-zoom' );
            add_theme_support( 'wc-product-gallery-lightbox' );
            add_theme_support( 'wc-product-gallery-slider' );
        }
    }

    remove_theme_support( 'widgets-block-editor' );
}
endif;
add_action( 'after_setup_theme', 'metro_magazine_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function metro_magazine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'metro_magazine_content_width', 640 );
}
add_action( 'after_setup_theme', 'metro_magazine_content_width', 0 );

/**
* Adjust content_width value according to template.
*
* @return void
*/
function metro_magazine_template_redirect_content_width() {
	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = metro_magazine_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1140;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1170;
	}
}
add_action( 'template_redirect', 'metro_magazine_template_redirect_content_width' );

/**
 * Enqueue scripts and styles.
 */
function metro_magazine_scripts() {
	$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    if( get_theme_mod( 'ed_localgoogle_fonts',false ) && ! is_customize_preview() && ! is_admin() ){
        if ( get_theme_mod( 'ed_preload_local_fonts',false ) ) {
			metro_magazine_load_preload_local_fonts( metro_magazine_get_webfont_url( metro_magazine_fonts_url() ) );
        }
        wp_enqueue_style( 'metro-magazine-google-fonts', metro_magazine_get_webfont_url( metro_magazine_fonts_url() ) );
    }else{
        wp_enqueue_style( 'metro-magazine-google-fonts', metro_magazine_fonts_url() );
    }
    wp_enqueue_style( 'metro-magazine-style', get_stylesheet_uri(), METRO_MAGAZINE_THEME_VERSION );

    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '6.1.1', false );
    wp_enqueue_script( 'metro_magazine-modal-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), METRO_MAGAZINE_THEME_VERSION, true );
    wp_enqueue_script( 'metro-magazine-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery'), METRO_MAGAZINE_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'metro_magazine_scripts' );

if( ! function_exists( 'metro_magazine_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function metro_magazine_admin_scripts(){
    wp_enqueue_style( 'metro-magazine-admin', get_template_directory_uri() . '/inc/css/admin.css', '', METRO_MAGAZINE_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'metro_magazine_admin_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function metro_magazine_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }

    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }

    if(is_page()){
        $metro_magazine_post_class = metro_magazine_sidebar_layout(); 
        if( $metro_magazine_post_class == 'no-sidebar' )
        $classes[] = 'full-width';
    }

    if( !( is_active_sidebar( 'right-sidebar' )) || is_page_template( 'template-home.php' ) || is_404() ) {
        $classes[] = 'full-width'; 
    }

    return $classes;
}
add_filter( 'body_class', 'metro_magazine_body_classes' );

/**
 * Flush out the transients used in metro_magazine_categorized_blog.
 */
function metro_magazine_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'metro_magazine_categories' );
}
add_action( 'edit_category', 'metro_magazine_category_transient_flusher' );
add_action( 'save_post',     'metro_magazine_category_transient_flusher' );

if ( ! function_exists( 'metro_magazine_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function metro_magazine_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'metro_magazine_excerpt_more' );

if ( ! function_exists( 'metro_magazine_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function metro_magazine_excerpt_length( $length ) {
    return is_admin() ? $length : 20;
}
endif;
add_filter( 'excerpt_length', 'metro_magazine_excerpt_length', 999 );

/**
 * Custom CSS
*/
if ( function_exists( 'wp_update_custom_css_post' ) ) {
    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
    $css = get_theme_mod( 'metro_magazine_custom_css' );
    if ( $css ) {
        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
        $return = wp_update_custom_css_post( $core_css . $css );
        if ( ! is_wp_error( $return ) ) {
            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
            remove_theme_mod( 'metro_magazine_custom_css' );
        }
    }
} else {
    function metro_magazine_custom_css(){
        $custom_css = get_theme_mod( 'metro_magazine_custom_css' );
        if( ! empty( $custom_css ) ){
    		echo '<style type="text/css">';
    		echo wp_strip_all_tags( $custom_css );
    		echo '</style>';
    	}
    }
    add_action( 'wp_head', 'metro_magazine_custom_css', 100 );
}

if( ! function_exists( 'metro_magazine_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function metro_magazine_admin_notice(){
    global $pagenow;
    $theme_args     = wp_get_theme();
    $meta           = get_option( 'metro_magazine_admin_notice' );
    $name           = $theme_args->__get( 'Name' );
    $current_screen = get_current_screen();
    $dismissnonce   = wp_create_nonce( 'metro_magazine_admin_notice' );

    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'metro-magazine' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'metro-magazine' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=metro-magazine-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'metro-magazine' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?metro_magazine_admin_notice=1&_wpnonce=<?php echo esc_attr( $dismissnonce ); ?>"><?php esc_html_e( 'Dismiss', 'metro-magazine' ); ?></a></strong></p>
                </div>
            </div>
        </div>
        <?php 
    }
}
endif;
add_action( 'admin_notices', 'metro_magazine_admin_notice' );

if( ! function_exists( 'metro_magazine_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function metro_magazine_update_admin_notice(){
    if (!current_user_can('manage_options')) {
        return;
    }

     // Bail if the nonce doesn't check out
    if ( isset( $_GET['metro_magazine_admin_notice'] ) && $_GET['metro_magazine_admin_notice'] = '1' && wp_verify_nonce( $_GET['_wpnonce'], 'metro_magazine_admin_notice' ) ) {
        update_option( 'metro_magazine_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'metro_magazine_update_admin_notice' );

if( ! function_exists( 'metro_magazine_exclude_posts_for_homepage' ) ) :
/**
 * Function to exclude posts in blog index page
 */
function metro_magazine_exclude_posts_for_homepage( $query ) {
	$featured_post_one     = get_theme_mod( 'metro_magazine_featured_post_one' );
	$featured_post_two     = get_theme_mod( 'metro_magazine_featured_post_two' );
	$featured_post_three   = get_theme_mod( 'metro_magazine_featured_post_three' );
	$featured_post_four    = get_theme_mod( 'metro_magazine_featured_post_four' );
	$featured_post_five    = get_theme_mod( 'metro_magazine_featured_post_five' );
	$featured_post_six     = get_theme_mod( 'metro_magazine_featured_post_six' );
	$ed_featured_post_home = get_theme_mod( 'metro_magazine_ed_featured_post_section_home' );

    if ( ! is_admin() && $query->is_main_query() && ( $ed_featured_post_home && $query->is_home() ) ) {
        $featured_posts = array( $featured_post_one, $featured_post_two, $featured_post_three, $featured_post_four, $featured_post_five, $featured_post_six );
        $featured_posts = array_diff( array_unique( $featured_posts ), array('') );

        if( ! empty( $featured_posts ) ){
            $query->set( 'post__not_in', $featured_posts );
        }
    }
}
endif;
add_action( 'pre_get_posts', 'metro_magazine_exclude_posts_for_homepage' );