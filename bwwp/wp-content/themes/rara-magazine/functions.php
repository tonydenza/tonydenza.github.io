<?php
/**
 * Theme functions and definitions
 *
 * @package Rara_Magazine
 */

/**
 * After setup theme hook
 */
function rara_magazine_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'rara-magazine', get_stylesheet_directory() . '/languages' );

    // Custom Image Size
    add_image_size( 'rara-magazine-slider', 180, 90, true );
    add_image_size( 'rara-magazine-banner-one', 1256, 610, true );
    add_image_size( 'rara-magazine-banner-two', 643, 610, true );
    add_image_size( 'rara-magazine-banner-three', 479, 410, true );
    add_image_size( 'rara-magazine-banner-four', 473, 345, true );
    add_image_size( 'rara-magazine-banner-five', 949, 693, true );
}
add_action( 'after_setup_theme', 'rara_magazine_theme_setup' );

/**
 * Load assets.
 */
function rara_magazine_enqueue_styles_and_scripts() {
    $my_theme = wp_get_theme();
    $version = $my_theme['Version'];
    wp_enqueue_style( 'owl-carousel', get_stylesheet_directory_uri() . '/css/owl.carousel.css', '', '2.2.1' );
    wp_enqueue_style( 'metro-magazine-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'rara-magazine-style', get_stylesheet_directory_uri() . '/style.css', array( 'metro-magazine-style' ), $version );

    wp_enqueue_script( 'owl-carousel', get_stylesheet_directory_uri() . '/js/owl.carousel.js', array('jquery'), '2.2.1', true );
    wp_enqueue_script( 'jquery-ticker', get_stylesheet_directory_uri() . '/js/jquery.ticker.js', array('jquery'), $version, true );
    wp_enqueue_script( 'rara-magazine-custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), $version, true );

    $array = array(
        'rtl' => is_rtl(),
    );

    wp_localize_script( 'rara-magazine-custom-js', 'rm_data', $array );
}
add_action( 'wp_enqueue_scripts', 'rara_magazine_enqueue_styles_and_scripts' );

/**
 * Remove action from parent
 */
function rara_magazine_remove_parent_action(){
    remove_action( 'customize_register', 'metro_magazine_customizer_theme_info' );
    unregister_nav_menu( 'secondary' );
}
add_action( 'init', 'rara_magazine_remove_parent_action' );

/**
 * Rara Magazine Theme Info
 */
function rara_magazine_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'theme_info' , array(
		'title'       => __( 'Demo and Documentation' , 'rara-magazine' ),
		'priority'    => 6,
		));
        
    $wp_customize->add_setting(
		'setup_instruction',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		new Metro_Magazine_Theme_Info( 
			$wp_customize,
			'setup_instruction',
			array(
                'settings'      => 'setup_instruction',
                'section'       => 'theme_info',
			)
		)
	);

	$wp_customize->add_setting('theme_info_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
	));
    
    $theme_info = '';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Documentation', 'rara-magazine' ) . ': </label><a href="' . esc_url( 'https://docs.rarathemes.com/docs/rara-magazine/' ) . '" target="_blank">' . __( 'Click here', 'rara-magazine' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Demo', 'rara-magazine' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/previews/?theme=rara-magazine' ) . '" target="_blank">' . __( 'Click here', 'rara-magazine' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme info', 'rara-magazine' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/rara-magazine/' ) . '" target="_blank">' . __( 'Click here', 'rara-magazine' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support Ticket', 'rara-magazine' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/support-ticket/' ) . '" target="_blank">' . __( 'Click here', 'rara-magazine' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'More WordPress Themes', 'rara-magazine' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/' ) . '" target="_blank">' . __( 'Click here', 'rara-magazine' ) . '</a></span><br />';

	$wp_customize->add_control( new Metro_Magazine_Theme_Info( $wp_customize ,'theme_info_theme',array(
        'label' => __( 'About Rara Magazine' , 'rara-magazine' ),
		'section' => 'theme_info',
		'description' => $theme_info
	)));
}
add_action( 'customize_register', 'rara_magazine_customizer_theme_info' );

/**
 * Customize resgister settings and controls 
 */
function rara_magazine_customize_register( $wp_customize ){

    // Load our custom control.
    require_once get_stylesheet_directory() . '/inc/custom-controls/select/class-select-control.php';
    require_once get_stylesheet_directory() . '/inc/custom-controls/radioimg/class-radio-image-control.php';
    

    // Register the control type.
    $wp_customize->register_control_type( 'Rara_Magazine_Select_Control' );
    $wp_customize->register_control_type( 'Rara_Magazine_Radio_Image_Control' );

    // Active callback for feautred post
    $wp_customize->get_control( 'metro_magazine_featured_post_six' )->active_callback = 'rara_magazine_featured_post_ac';

    $wp_customize->add_panel( 'header_setting', array(
        'title'      => __( 'Header Settings', 'rara-magazine' ),
        'priority'   => 15,
        'capability' => 'edit_theme_options',
    ) );
    
    $wp_customize->add_section( 'header_misc_setting', array(
        'title'    => __( 'Misc Settings', 'rara-magazine' ),
        'priority' => 60,
        'panel'    => 'header_setting',
    ) );

    /** Breaking News Label */
    $wp_customize->add_setting(
        'breaking_news_label',
        array(
            'default'           => __( 'Breaking News', 'rara-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
       'breaking_news_label',
        array(
            'section'     => 'header_misc_setting',
            'label'       => __( 'Breaking News', 'rara-magazine' ),
            'description' => __( 'Leave blank to display Breaking News Category Name', 'rara-magazine' ),
            'type'        => 'text'
        )       
    );
    
    /** Select Category */
    $wp_customize->add_setting(
        'breaking_news_cat',
        array(
            'default'           => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Rara_Magazine_Select_Control(
            $wp_customize,
            'breaking_news_cat',
            array(
                'label'   => __( 'Breaking News Category', 'rara-magazine' ),
                'section' => 'header_misc_setting',
                'choices' => rara_magazine_get_categories(),   
            )
        )
    );

    // Slider settings
    $wp_customize->add_section( 'header_slider_setting', array(
        'title'    => __( 'Slider Settings', 'rara-magazine' ),
        'priority' => 22,
        'panel'    => 'header_setting',
    ) );

    /** Enable/Disable slider in Home Page */
    $wp_customize->add_setting(
        'ed_slider_section',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_slider_section',
        array(
            'label' => __( 'Enable Slider in Home Page', 'rara-magazine' ),
            'section' => 'header_slider_setting',
            'type' => 'checkbox',
        )
    );
    
    /** Select Category */
    $wp_customize->add_setting(
        'slider_cat',
        array(
            'default'           => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Rara_Magazine_Select_Control(
            $wp_customize,
            'slider_cat',
            array(
                'label'       => __( 'Slider Category', 'rara-magazine' ),
                'description' => __( 'Choose slider category for header.', 'rara-magazine' ),
                'section'     => 'header_slider_setting',
                'choices'     => rara_magazine_get_categories(),   
            )
        )
    );

    /** Featured Post Section */

    /** Enable/Disable boxed layout */
    $wp_customize->add_setting(
        'ed_boxed_banner',
        array(
            'default'           => false,
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_boxed_banner',
        array(
            'section' => 'metro_magazine_featured_post_settings',
            'label'   => __( 'Enable Box Design', 'rara-magazine' ),
            'type'    => 'checkbox'
        )
    );

    /** Category Layout */
    $wp_customize->add_setting( 'banner_cat_layout', array(
        'default'           => 'layout-2',
        'sanitize_callback' => 'rara_magazine_sanitize_radio'
    ) );
    
    $wp_customize->add_control(
        new Rara_Magazine_Radio_Image_Control(
            $wp_customize,
            'banner_cat_layout',
            array(
                'section'       => 'metro_magazine_featured_post_settings',
                'label'         => __( 'Banner Category Layout', 'rara-magazine' ),
                'description'   => __( 'Choose the layout for banner category.', 'rara-magazine' ),
                'choices'       => array(
                    'layout-1' => get_stylesheet_directory_uri() . '/images/featured1.png',
                    'layout-2' => get_stylesheet_directory_uri() . '/images/featured2.png',
                )
            )
        )
    );
}
add_action( 'customize_register', 'rara_magazine_customize_register', 100 );

/**
 * Active Callback
 */
function rara_magazine_featured_post_ac( $control ){
    $featured_layout = $control->manager->get_setting( 'banner_cat_layout' )->value();
    $control_id      = $control->id;
    
    // static banner controls
    if ( $control_id == 'metro_magazine_featured_post_six' && $featured_layout == 'layout-1' ) return true;

    return false;
}

/**
 * Function to list post categories in customizer options
*/
function rara_magazine_get_categories( $select = true, $slug = false ){
    
    /* Option list of all categories */
    $categories = array();
    
    $args = array( 'hide_empty' => false );
    
    $catlists = get_categories( $args );
    if( $select ) $categories[''] = __( 'Choose Category', 'rara-magazine' );
    foreach( $catlists as $category ){
        if( $slug ){
            $categories[$category->slug] = $category->name;
        }else{
            $categories[$category->term_id] = $category->name;    
        }        
    }
    
    return $categories;
}

/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_top(){
    $metro_magazine_ed_social = get_theme_mod( 'metro_magazine_ed_social' );
    ?>
   <!-- header-top -->
    
    <div class="header-t">
        <div class="container">
            <?php
            rara_magazine_get_breaking_news(); 

            if( $metro_magazine_ed_social ){
             /**
              * metro_magazine_social_link_cb
              */
              do_action( 'metro_magazine_social_link' );
            }
        ?>

        </div>
    </div>
<?php 
}

/**
 * Get Breaking news
*/
function rara_magazine_get_breaking_news(){ 
    $breaking_news_cat   = get_theme_mod( 'breaking_news_cat' ); //from customizer
    $breaking_news_label = get_theme_mod( 'breaking_news_label', __( 'Breaking News', 'rara-magazine' ) ); //from customizer
    
    if( $breaking_news_label ){
        $label = $breaking_news_label;
    }else{
        $cat   = get_category( $breaking_news_cat );
        $label = $cat->name;
    }
    
    if( $breaking_news_cat ){
        
        echo '<div class="scrolling-news">
                <div class="container">';
        
            $args = array(
                'post_type'           => 'post', 
                'cat'                 => $breaking_news_cat,
                'post_status'         => 'publish',
                'posts_per_page'      => -1,
                'ignore_sticky_posts' => true 
            );
            $breaking_qry = new WP_Query( $args );
            
            if( $breaking_qry->have_posts() ){
            ?>
                <a href="<?php echo esc_url( get_category_link( $breaking_news_cat ) ); ?>" class="breaking-news-link"><?php echo esc_html( $label ); ?></a>
                <div class="newsticker-wrapper">
                    <ul id="news-ticker">
                    <?php 
                        while( $breaking_qry->have_posts() ){
                            $breaking_qry->the_post();
                        ?>
                        <li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
                        <?php
                        }    
                    ?>
                    </ul>
                </div>
            <?php
            }
            wp_reset_postdata();
            
            echo '</div>';
        echo '</div>';
    }
}

/**
 * Add footer credit
 */
function metro_magazine_footer_credit(){
    $copyright_text = get_theme_mod( 'metro_magazine_footer_copyright_text' );
    echo '<div class="footer-b">';
        echo '<div class="container">'; 
            echo '<div class="site-info">';
                if( $copyright_text ){
                    echo wp_kses_post( $copyright_text );
                }else{
                esc_html_e( '&copy;&nbsp;', 'rara-magazine' ); 
                echo date_i18n( esc_html__( 'Y', 'rara-magazine' ) );
                esc_html_e( '&nbsp;', 'rara-magazine' );
                echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
                }
                echo esc_html__( ' Rara Magazine | Developed By ', 'rara-magazine' );
                echo '<a rel="nofollow" href="'. esc_url( __( 'https://rarathemes.com/', 'rara-magazine' ) ) .'" target="_blank">'. esc_html__( 'Rara Theme', 'rara-magazine' ) .'</a>';
                printf( esc_html__( ' Powered by %s', 'rara-magazine' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'rara-magazine' ) ) .'" target="_blank">'. esc_html__( 'WordPress', 'rara-magazine' ) . '</a>' );

                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link();
                }
            echo '</div>';
        echo '</div>';
    echo '</div>';
}

/**
 * Add header slider
 */
function rara_magazine_slider(){
    $ed_slider  = get_theme_mod( 'ed_slider_section' );
    $slider_cat = get_theme_mod( 'slider_cat' );
    
    if( $ed_slider && ! empty( $slider_cat ) ){
        if( is_front_page() && ! is_home() ){
            
            $args = array(
                'post_type'           => 'post', 
                'cat'                 => $slider_cat, 
                'post_status'         => 'publish',
                'posts_per_page'      => -1, 
                'ignore_sticky_posts' => true 
            );
            
            $qry = new WP_Query( $args );
            if( $qry->have_posts() ){ ?>
                <div class="header-slider-warp">
                    <ul class="top-news-slide owl-carousel">
                        <?php 
                        while( $qry->have_posts() ){
                            $qry->the_post();
                            if( has_post_thumbnail() ){ ?>
                                <li>
                                    <div class = "post" >
                                        <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                            <?php the_post_thumbnail( 'rara-magazine-slider', array( 'itemprop' => 'image' ) ); ?>
                                        </a>
                                        <header class="entry-header"><?php the_title(); ?></header>
                                    </div>
                                </li>
                            <?php                                 
                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
            <?php
            }
        }
    }
}
add_action( 'metro_magazine_header', 'rara_magazine_slider', 70 );

/**
 * Sanitization function for radio controls.
 */
function rara_magazine_sanitize_radio( $input, $setting ) {
    // Ensure input is a slug.
    $input = sanitize_key( $input );
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Featured Section
 * 
 */
function metro_magazine_featured_section(){
    $post_one          = get_theme_mod( 'metro_magazine_featured_post_one' );
    $post_two          = get_theme_mod( 'metro_magazine_featured_post_two' );
    $post_three        = get_theme_mod( 'metro_magazine_featured_post_three' );
    $post_four         = get_theme_mod( 'metro_magazine_featured_post_four' );
    $post_five         = get_theme_mod( 'metro_magazine_featured_post_five' );    
    $post_six          = get_theme_mod( 'metro_magazine_featured_post_six' );    
    $ed_banner_home    = get_theme_mod( 'metro_magazine_ed_featured_post_section_home' );
    $ed_banner_archive = get_theme_mod( 'metro_magazine_ed_featured_post_section_archive' );
    $banner_layout     = get_theme_mod( 'banner_cat_layout', 'layout-2' );
    $banner_posts      = array( $post_one, $post_two, $post_three, $post_four, $post_five, $post_six );
    $banner_posts      = array_diff( array_unique( $banner_posts ), array('') );
    
    if( ! empty( $banner_posts ) && ( ( ( is_front_page() || is_home() ) && $ed_banner_home ) || ( is_archive() && $ed_banner_archive ) ) ){

        $ed_boxed_banner = get_theme_mod( 'ed_boxed_banner', false );
    
        $img_one   = ( $ed_boxed_banner ) ? 'metro-magazine-featured-big' : 'rara-magazine-banner-one';
        $img_two   = ( $ed_boxed_banner ) ? 'metro-magazine-featured-mid' : 'rara-magazine-banner-two';
        $img_three = ( $ed_boxed_banner ) ? 'metro-magazine-featured-small' : 'rara-magazine-banner-three'; 
        
        if( $ed_boxed_banner ) echo '<div class="container">';
        
        echo '<div class="all-post ' . esc_attr( $banner_layout ) . '"><ul>';
        switch( $banner_layout ){
            case 'layout-1':
                rara_magazine_cat_query( $banner_layout, $banner_posts, $img_one, 1, false );
                rara_magazine_cat_query( $banner_layout, $banner_posts, $img_two, 1, 1 );
                rara_magazine_cat_query( $banner_layout, $banner_posts, $img_three, 4, 2 );
            break;
            
            case 'layout-2':
                rara_magazine_cat_query( $banner_layout, $banner_posts, 'rara-magazine-banner-four', 2, false );
                rara_magazine_cat_query( $banner_layout, $banner_posts, 'rara-magazine-banner-five', 1, 2 );
                rara_magazine_cat_query( $banner_layout, $banner_posts, 'rara-magazine-banner-four', 2, 3 );
            break;    
        }
        echo '</ul></div>';
        
        if( $ed_boxed_banner ) echo '</div>';
    }
}

/**
 * Function to query posts in home page
*/
function rara_magazine_cat_query( $layout, $banner_posts, $image_size, $post_per_page, $offset = false ){
    
    $args = array(
        'post_type'           => 'post',        
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'posts_per_page'      => $post_per_page
    );
    
    if( $banner_posts ){
        $args['post__in'] = $banner_posts; 
        $args['orderby']  = 'post__in';
    }
    
    if( $offset ) $args['offset'] = $offset;
    
        
    $qry = new WP_Query( $args );
    
    if( $qry->have_posts() ){
        
        rara_magazine_query_wrapper_start( $layout, $offset, $post_per_page );
        
        while( $qry->have_posts() ){
            $qry->the_post();
            
            rara_magazine_query_wrapper_start( $layout, $offset, $post_per_page, true );
            
                echo '<article class="post">';
                
                metro_magazine_colored_category();
                
                //post thumbnail function
                rara_magazine_get_post_thumbnail( $image_size );
                
                rara_magazine_get_contents();
                            
                echo '</article>';
                 
            rara_magazine_query_wrapper_end( $layout, $offset, $post_per_page, true );
        }
        wp_reset_postdata();
        
        rara_magazine_query_wrapper_end( $layout, $offset, $post_per_page );
    }    
}

/**
 * Starter Wraper for while loop in cat query
*/
function rara_magazine_query_wrapper_start( $layout, $offset, $post_per_page, $inside_while = false ){    
    if( $inside_while ){ //Inside While Loop
        switch( $layout ){
            case 'layout-1':
                if( $offset == 1 ){
                    echo '<li class="medium">';
                }elseif( $offset > 1 ){
                    echo '<li>';
                }else{
                    echo '<li class="large">';
                }
            break;                
        }
    }else{ //Outside While Loop
        switch( $layout ){
            case 'layout-2':
                echo $post_per_page == 1 ? '<li class="large">' : '<li>';
            break;                
        }
    }
}

/**
 * End Wrapper for while loop in cat query
*/
function rara_magazine_query_wrapper_end( $layout, $offset, $post_per_page, $inside_while = false ){    
    if( $inside_while ){ //Inside While Loop
        switch( $layout ){
            case 'layout-1':
            break;                
        }
    }else{ //Outside While Loop
        switch( $layout ){
            case 'layout-2':
                echo '</li>';
            break;                
        }
    }    
}

/**
 * Get post thumbnail for home page different sections
*/

function rara_magazine_get_post_thumbnail( $size ){
    ?>
    <a href="<?php the_permalink(); ?>" class="post-thumbnail">
        <?php 
            if( has_post_thumbnail() ){
                the_post_thumbnail( $size, array( 'itemprop' => 'image' ) );    
            }else{
                metro_magazine_get_fallback_svg( $size );
            } 
        ?>
    </a>
    <?php
}

/**
 * Contents for Home Posts
*/
function rara_magazine_get_contents(){
    echo '<header class="entry-header"><h2 class="entry-title">';
    echo '<a href="' . esc_url( get_the_permalink() ) . '">';
    the_title();
    echo '</a>';
    echo '</h2></header>';
}

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
	$banner_layout         = get_theme_mod( 'banner_cat_layout', 'layout-2' );
	$breaking_news_cat     = get_theme_mod( 'breaking_news_cat' );

    if( ! is_admin() && $query->is_main_query() && ( $ed_featured_post_home && $query->is_home() ) ){
        if( $banner_layout == 'layout-2' ){
            $featured_posts = array( $featured_post_one, $featured_post_two, $featured_post_three, $featured_post_four, $featured_post_five );
        }else{
            $featured_posts = array( $featured_post_one, $featured_post_two, $featured_post_three, $featured_post_four, $featured_post_five, $featured_post_six );
        }       
        
        $featured_posts = array_diff( array_unique( $featured_posts ), array('') );

        if( ! empty( $featured_posts ) ){
            $query->set( 'post__not_in', $featured_posts );
        }

        if( $breaking_news_cat ){
            $query->set( 'category__not_in', $breaking_news_cat );
        }   
    }
}