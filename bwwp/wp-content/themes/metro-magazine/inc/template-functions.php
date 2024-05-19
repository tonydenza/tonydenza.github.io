<?php
/**
 * Custom template function for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Metro_Magazine
*/

if( ! function_exists( 'metro_magazine_doctype_cb' ) ) :
/**
 * Doctype Declaration
 * 
 * @since 1.0.1
*/
function metro_magazine_doctype_cb(){
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'metro_magazine_doctype', 'metro_magazine_doctype_cb' );

if( ! function_exists( 'metro_magazine_head' ) ) :
/**
 * Before wp_head
 * 
 * @since 1.0.1
*/
function metro_magazine_head(){
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
}
endif;
add_action( 'metro_magazine_before_wp_head', 'metro_magazine_head' );

if( ! function_exists( 'metro_magazine_page_start' ) ) :
/**
 * Page Start
 * 
 * @since 1.0.1
*/
function metro_magazine_page_start(){
    ?>
        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'metro-magazine' ); ?></a>
    <?php
}
endif;
add_action( 'metro_magazine_before_header', 'metro_magazine_page_start', 20 );

if( ! function_exists( 'metro_magazine_mobile_header' ) ) :
/**
* Mobile Header
*/
function metro_magazine_mobile_header(){
    ?>
    <div class="mobile-header" id="mobilemasthead" role="banner">
        <div class="container">
            <div class="site-branding">
                <?php 
                    if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                        the_custom_logo();
                    } 
                ?>
                <div class="text-logo">
                    <p class="site-title" itemprop="name">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a>
                    </p>
                    <?php
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) { ?>
                            <p class="site-description" itemprop="description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                    <?php } ?>
                </div>  
            </div><!-- .site-branding -->

            <button class="menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <?php do_action('metro_magazine_ads'); ?>

        </div> <!-- container -->

        <div class="mobile-menu">
            <nav id="mobile-site-navigation" class="mobile-main-navigation">            
                <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                    <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                    <?php get_search_form(); ?>           
                    <div class="mobile-menu-title" aria-label="<?php esc_attr_e( 'Mobile', 'metro-magazine' ); ?>">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'mobile-primary-menu', 'menu_class'     => 'nav-menu main-menu-modal' ) ); ?>
                </div>

                <?php
                    if ( has_nav_menu( 'secondary' ) ){
                        wp_nav_menu( array( 'theme_location' => 'secondary', 'container' => false, 'menu_class' => 'secondary-nav' ) );
                    }

                    $metro_magazine_ed_social = get_theme_mod( 'metro_magazine_ed_social' );
                    if( $metro_magazine_ed_social ){
                     /**
                      * metro_magazine_social_link_cb
                      */
                      do_action( 'metro_magazine_social_link' );
                    }
                ?>
            </nav><!-- #mobile-site-navigation -->
        </div> <!-- mobile-menu -->
    </div> <!-- mobile-header -->
    <?php
}
endif;
add_action( 'metro_magazine_header', 'metro_magazine_mobile_header', 5 );

if( ! function_exists( 'metro_magazine_header_start' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_start(){
    ?>
    <header id="masthead" class="site-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">
    <?php 
}
endif;
add_action( 'metro_magazine_header', 'metro_magazine_header_start', 20 );

if( ! function_exists( 'metro_magazine_header_top' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_top(){
     $metro_magazine_ed_social = get_theme_mod( 'metro_magazine_ed_social' );

     if( has_nav_menu( 'secondary' ) || $metro_magazine_ed_social ){
    ?>
    <!-- header-top -->
    
        <div class="header-t">
            <div class="container">
            <?php if( has_nav_menu( 'secondary' ) ) { ?>
                <nav class="secondary-menu">
                    <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'secondary-nav' ) ); ?> 
                </nav>
            <?php }

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

}
endif;
add_action( 'metro_magazine_header', 'metro_magazine_header_top', 30 );

if( ! function_exists( 'metro_magazine_header_bottom' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_bottom(){
    ?>
    <!-- header-bottom -->
        <div class="header-b">
            <div class="container">
            <!-- logo of the site -->
                <div class="site-branding" itemscope itemtype="https://schema.org/Organization">
                    <?php 
                        if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                            the_custom_logo();
                        } 
                    ?>
                        <div class="text-logo">
                            <?php if ( is_front_page() ) : ?>
                                <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php else : ?>
                                <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                            <?php endif;
                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) { ?>
                                  <p class="site-description" itemprop="description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                          <?php } ?>
                        </div>  
                </div><!-- .site-branding -->
                <?php do_action('metro_magazine_ads'); ?>
          </div>
    <?php 
}
endif;
add_action( 'metro_magazine_header', 'metro_magazine_header_bottom', 40 );

if( ! function_exists( 'metro_magazine_header_menu' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_menu(){ ?>    
    <div class="nav-holder">
        <div class="container">
            <div class="nav-content">
                <!-- main-navigation of the site -->
                <?php if( has_nav_menu( 'primary' ) ) { ?>
                    <nav id="site-navigation" class="main-navigation" >
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                    </nav><!-- #site-navigation -->
                <?php } ?>

                <div class="search-content">
                    <a class="btn-search" id="myBtn" href="javascript:void(0);" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal .search-field"><span class="fa fa-search"></span></a>
                        <div id="formModal" class="modal modal-content header-search-modal cover-modal" data-modal-target-string=".header-search-modal">
                            <button type="button" class="close" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal"></button>
                            <?php get_search_form(); ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
}
endif;
add_action( 'metro_magazine_header', 'metro_magazine_header_menu', 50 );

if( ! function_exists( 'metro_magazine_header_end' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_end(){
    ?>
        </div>
    </header><!-- #masthead -->
    <?php 
}
endif;
add_action( 'metro_magazine_header', 'metro_magazine_header_end', 60 );

if( ! function_exists( 'metro_magazine_page_header_cb' ) ) :
/**
 * Page Header for inner pages
 * 
 * @since 1.0.1
*/
function metro_magazine_page_header_cb(){  
    echo '<div id="acc-content"><!-- done for accessibility reasons -->';
    if ( is_page_template( 'template-home.php' ) || ( is_front_page() && ! is_home() ) ){ 
        echo '<div class="home-content">'; 
    } else {     
        if( is_home() && ! is_front_page() ){ ?>
            <div class="top-bar">
                <div class="container">
                    <?php do_action( 'metro_magazine_breadcrumbs' ); ?>
                    <div class="page-header">
                        <h1 class="page-title">
                            <?php single_post_title(); ?>
                        </h1>
                    </div>
                </div>
            </div>
            <?php } elseif( is_archive() ){ ?>
            <div class="top-bar">
                <div class="container">
                    <?php do_action( 'metro_magazine_breadcrumbs' ); ?>
                    <div class="page-header">
                        <h1 class="page-title">
                            <?php the_archive_title(); ?>
                        </h1>
                    </div>
                </div>
            </div>
            <?php }elseif( is_404() ){ ?>
            <div class="top-bar">
                <div class="container">
                    <?php do_action( 'metro_magazine_breadcrumbs' ); ?>
                    <div class="page-header">
                        <h1 class="page-title">
                            <?php esc_html_e( '404 Error - Page Not Found','metro-magazine' ); ?>
                        </h1>
                    </div>
                </div>
            </div>
            <?php }elseif( is_search() ){ ?>
            <div class="top-bar">
                <div class="container">
                    <?php do_action( 'metro_magazine_breadcrumbs' ); ?>
                    <div class="page-header">
                        <h1 class="page-title">
                            <?php printf( esc_html__( 'Search Results for: %s', 'metro-magazine' ), get_search_query() ); ?>
                        </h1>
                    </div>
                </div>
            </div>
            <?php }elseif( is_singular() && ( get_theme_mod( 'metro_magazine_ed_breadcrumb' ) == true ) ){ ?>
            <div class="top-bar">
                <div class="container">
                    <?php do_action( 'metro_magazine_breadcrumbs' ); ?>
                </div>
            </div>
            <?php 
            }
        }        
    } 
endif;
add_action( 'metro_magazine_after_header', 'metro_magazine_page_header_cb', 10 );

/* Homepage Section */
if( ! function_exists( 'metro_magazine_featured_section' ) ) :
/**
 * Featured Section
 * 
 * @since 1.0.1
*/
function metro_magazine_featured_section(){

    $featured_post_one        = get_theme_mod( 'metro_magazine_featured_post_one' ); // from customizer
    $featured_post_two        = get_theme_mod( 'metro_magazine_featured_post_two' ); // from customizer
    $featured_post_three      = get_theme_mod( 'metro_magazine_featured_post_three' ); // from customizer
    $featured_post_four       = get_theme_mod( 'metro_magazine_featured_post_four' ); // from customizer
    $featured_post_five       = get_theme_mod( 'metro_magazine_featured_post_five' ); // from customizer    
    $featured_post_six        = get_theme_mod( 'metro_magazine_featured_post_six' ); // from customizer    
    $ed_featured_post_home    = get_theme_mod( 'metro_magazine_ed_featured_post_section_home' ); // from customizer
    $ed_featured_post_archive = get_theme_mod( 'metro_magazine_ed_featured_post_section_archive' ); // from customizer
    
    $featured_posts = array( $featured_post_three, $featured_post_four, $featured_post_five, $featured_post_six);
    $featured_posts = array_diff( array_unique( $featured_posts ), array('') );
    
    if( $featured_post_one && $featured_post_two && $featured_posts && ( ( ( is_front_page() || is_home() ) && $ed_featured_post_home ) || ( is_archive() && $ed_featured_post_archive ) ) ){
    ?>
    <!-- These section are for home page only -->
    <div class="all-post">
        <div class="container">
            <ul>
            <?php 
                if( $featured_post_one ){ 
                    $featured_qry = new WP_Query( "p=$featured_post_one" );  
                    if( $featured_qry->have_posts() ){
                        while( $featured_qry->have_posts() ){
                            $featured_qry->the_post();
                            if( has_post_thumbnail() ){
                            ?>
                            <li class="large">
                                <article class="post">
                                    <?php metro_magazine_colored_category(); ?>
                                    <a class="post-thumbnail" href="<?php the_permalink(); ?>">
                                        <?php 
                                            the_post_thumbnail( 'metro-magazine-featured-big', array( 'itemprop' => 'image' ) ); 
                                        ?>
                                    </a>
                                    <header class="entry-header">
                                        <h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                    </header>
                                </article>
                            </li>
                            <?php                        
                            }
                        }
                        wp_reset_postdata();
                    }                    
                }  
                if( $featured_post_two ){ 
                    $featured_qry = new WP_Query( "p=$featured_post_two" );  
                    if( $featured_qry->have_posts() ){
                        while( $featured_qry->have_posts() ){
                            $featured_qry->the_post();
                            if( has_post_thumbnail() ){
                            ?>
                            <li class="medium">
                                <article class="post">
                                    <?php metro_magazine_colored_category(); ?>
                                    <a class="post-thumbnail" href="<?php the_permalink(); ?>">
                                        <?php 
                                             the_post_thumbnail( 'metro-magazine-featured-mid', array( 'itemprop' => 'image' ) ); 
                                        ?>
                                    </a>
                                    <header class="entry-header">
                                        <h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                    </header>
                                </article>
                            </li>
                            <?php                        
                            }
                        }
                        wp_reset_postdata();
                    }                    
                }
                if( $featured_posts ){
                    $args = array(
                        'post_type'           => 'post',
                        'posts_per_page'      => -1,
                        'post_status'         => 'publish',
                        'post__in'            => $featured_posts,
                        'orderby'             => 'post__in',
                        'ignore_sticky_posts' => true
                    );
                    
                    $feature_qry = new WP_Query( $args );
                    if( $feature_qry->have_posts() ){
                        while( $feature_qry->have_posts() ){
                            $feature_qry->the_post();
                                if( has_post_thumbnail() ){ ?>
                                <li>
                                    <article class="post">
                                    <?php metro_magazine_colored_category(); ?>
                                        <a class="post-thumbnail" href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'metro-magazine-featured-small', array( 'itemprop' => 'image' ) ); ?>
                                        </a>
                                        <header class="entry-header">
                                        <h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                    </header>
                                </article>
                                </li>
                                <?php
                            }
                        }
                        wp_reset_postdata();
                    }                    
                }
            ?>
            </ul>
        </div>
    </div>    
    <!-- These section are for home page only -->
    <?php
    }
}
endif;
add_action( 'metro_magazine_after_header', 'metro_magazine_featured_section', 20 );

if( ! function_exists( 'metro_magazine_top_news_section' ) ) :
/**
 * Top News Section
 * 
 * @since 1.0.1
*/
function metro_magazine_top_news_section(){
    $top_news_title = get_theme_mod( 'metro_magazine_top_news_label', __( 'Top News', 'metro-magazine' ) ); //from customizer
    $top_news_one   = get_theme_mod( 'metro_magazine_top_news_one' ); //from customizer
    $top_news_two   = get_theme_mod( 'metro_magazine_top_news_two' ); //from customizer
    $top_news_three = get_theme_mod( 'metro_magazine_top_news_three' ); //from customizer
    $top_news_four  = get_theme_mod( 'metro_magazine_top_news_four' ); //from customizer
    $top_news_five  = get_theme_mod( 'metro_magazine_top_news_five' ); //from customizer
    $top_news_six   = get_theme_mod( 'metro_magazine_top_news_six' ); //from customizer
    $ed_topnews_sec = get_theme_mod( 'metro_magazine_ed_top_news_section' ); //from customizer
    
    $top_news_posts = array( $top_news_one, $top_news_two, $top_news_three, $top_news_four, $top_news_five, $top_news_six );
    $top_news_posts = array_diff( array_unique( $top_news_posts ), array('') );
    
    if( $ed_topnews_sec && is_front_page() ){ 
          
    ?>
    <section class="section-two top-news">
        <div class="container">         
            <?php if( $top_news_title ){ ?>
            <header class="header">
                <h2 class="header-title"><span><?php echo esc_html( $top_news_title ); ?></span></h2>
            </header>    
            <?php } ?>
            
            <div class="row">
                <?php
                if( $top_news_posts ){
                   $args = array(
                        'post_type'           => 'post',
                        'posts_per_page'      => -1,
                        'post_status'         => 'publish',
                        'post__in'            => $top_news_posts,
                        'orderby'             => 'post__in',
                        'ignore_sticky_posts' => true
                    );
                    
                    $top_news_qry = new WP_Query( $args );
                    if( $top_news_qry->have_posts() ){
                        while( $top_news_qry->have_posts() ){
                            $top_news_qry->the_post();
                            ?>
                            <div class="col">
                                <article class="post">
                                    <div class="image-holder">
                                        <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                            <?php
                                            if ( has_post_thumbnail() ) {
                                                the_post_thumbnail( 'metro-magazine-three-col', array( 'itemprop' => 'image' ) ); 
                                            }else{
                                                metro_magazine_get_fallback_svg( 'metro-magazine-three-col' );
                                            } ?>                                            
                                        </a>
                                        <?php metro_magazine_colored_category(); ?>
                                    </div>
                                    <header class="entry-header">
                                        <div class="entry-meta">                                
                                            <?php metro_magazine_posted_on_date(); ?>
                                        </div>
                                        <h3 class="entry-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                    </header>
                                    <div class="entry-content">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </article>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                    }                    
                }
                ?>               
            </div>
        </div>
    </section><!-- These section are for home page only -->
    <?php
    }
}
endif;
add_action( 'metro_magazine_home_page', 'metro_magazine_top_news_section', 10 );

if( ! function_exists( 'metro_magazine_three_col_cat_content' ) ) :
/**
 * Category Section One
*/
function metro_magazine_three_col_cat_content(){
    $first_cat  = get_theme_mod( 'metro_magazine_category_one' ); //from customizer
       
    if( $first_cat ){
    $cat = get_category( $first_cat );    
    $single_qry = new WP_Query( "post_type=post&posts_per_page=3&cat=$first_cat" );
    
    ?>
    <section class="section-two">
        <div class="container">
            <header class="header">
                <h2 class="header-title"><span><a href="<?php echo esc_url( get_category_link( $first_cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></span></h2>
            </header>
        
            <div class="row">
            <?php 
            if( $single_qry->have_posts() ){
                while( $single_qry->have_posts() ){
                    $single_qry->the_post();                                    
                    echo '<div class="col">';
                    ?>
                        <article class="post">
                            <div class="image-holder">
                               <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                    <?php 
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'metro-magazine-three-col', array( 'itemprop' => 'image' ) ); 
                                    }else{
                                        metro_magazine_get_fallback_svg( 'metro-magazine-three-col' );
                                    } ?>                                    
                                </a>
                               <?php metro_magazine_colored_category(); ?>
                            </div>
                            <header class="entry-header">
                                <div class="entry-meta">
                                    <?php metro_magazine_posted_on_date(); ?>
                                </div>
                                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </header>
                        </article>        
                    <?php
                    echo '</div>';
                }
                wp_reset_postdata();
            }    
            ?>
            </div>
        </div>
    </section>
    <?php 
    }   
}
endif;
add_action( 'metro_magazine_home_page', 'metro_magazine_three_col_cat_content', 20 );

if( ! function_exists( 'metro_magazine_three_row_cat_content' ) ) :
/**
 * Category Section Three
*/
function metro_magazine_three_row_cat_content(){
    $second_cat = get_theme_mod( 'metro_magazine_category_two' ); //from customizer
    
    if( $second_cat ){
    $cat = get_category( $second_cat );   
    ?>
    <section class="section-three">
        <div class="container">
            <header class="header">
                 <h2 class="header-title"><span><a href="<?php echo esc_url( get_category_link( $second_cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></span></h2>
            </header>
            
            <?php
                $single_qry = new WP_Query( "post_type=post&posts_per_page=3&cat=$second_cat" );
                if( $single_qry->have_posts() ){
                    while( $single_qry->have_posts() ){
                        $single_qry->the_post(); ?>
                        <div class="col">
                            <article class="post">
                               <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                    <?php 
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'metro-magazine-three-row', array( 'itemprop' => 'image' ) ); 
                                    }else{
                                        metro_magazine_get_fallback_svg( 'metro-magazine-three-row' );
                                    } ?>                                     
                                </a>
                                <div class="text-holder">
                                    <header class="entry-header">
                                        <div class="entry-meta">
                                            <?php metro_magazine_posted_on_date(); ?>
                                        </div>
                                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    </header>
                                    <div class="div entry-content">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </article>  
                        </div>      
                        <?php
                    }
                    wp_reset_postdata();
                }
            ?>
        </div>
    </section>
    <?php
    }
}
endif;
add_action( 'metro_magazine_home_page', 'metro_magazine_three_row_cat_content', 30 );

if( ! function_exists( 'metro_magazine_three_video_cat_content' ) ) :
/**
 * Category Section Three
*/
function metro_magazine_three_video_cat_content(){
    $third_cat = get_theme_mod( 'metro_magazine_category_three' ); //from customizer
        
    if( $third_cat ){ 
    $cat = get_category( $third_cat );  
    ?>
    <section class="videos">
        <div class="container">
            <header class="header">
                 <h2 class="header-title"><span><a href="<?php echo esc_url( get_category_link( $third_cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></span></h2>
            </header>
            
            <?php 
                $single_qry = new WP_Query( "post_type=post&posts_per_page=3&cat=$third_cat" );
                if( $single_qry->have_posts() ){                    
                    echo '<div class="row">';
                    while( $single_qry->have_posts() ){
                        $single_qry->the_post();
                        ?>
                        <div class="col" >
                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="image-holder">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php 
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'metro-magazine-three-col', array( 'itemprop' => 'image' ) ); 
                                        }else{
                                            metro_magazine_get_fallback_svg( 'metro-magazine-three-col' );
                                        } ?>                                            
                                    </a>
                                    <div class="text">
                                        <span><?php the_title(); ?></span>
                                    </div>
                                </div> 
                            </div>    
                        </div>
                        <?php
                    } 
                    wp_reset_postdata();
                    echo '</div>';
                }
            ?>
        </div>
    </section>
    <?php
    }
}
endif;
add_action( 'metro_magazine_home_page', 'metro_magazine_three_video_cat_content', 40 );

if( ! function_exists( 'metro_magazine_big_img_single_cat_content' ) ) :
/**
 * Category Section Four
*/
function metro_magazine_big_img_single_cat_content(){
    $fourth_cat = get_theme_mod( 'metro_magazine_category_four' ); //from customizer
    
    if( $fourth_cat ){
    $cat = get_category( $fourth_cat );  
    ?>
    <section class="section-four">
        <div class="img-holder">
            <div class="table">
                <div class="table-row">
                    <div class="table-cell">
                        <div class="text">
                            <h2 class="main-title"><span><?php echo esc_html( $cat->name ); ?></span></h2>
                            <?php echo category_description( $fourth_cat ) ; ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php 
            $single_qry = new WP_Query( "post_type=post&posts_per_page=3&cat=$fourth_cat" );
            if( $single_qry->have_posts() ){                
                echo '<div class="text-holder"><div class="post-holder">';
                while( $single_qry->have_posts() ){
                    $single_qry->the_post(); ?>
                    <div class="post">
                        <header class="entry-header">
                            <div class="entry-meta">
                                <?php metro_magazine_posted_on_date(); ?>
                            </div>
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </header>
                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div>
                    </div> 
                    <?php
                }
                wp_reset_postdata();
                echo '</div></div>';
            }
        ?>
    </section>
    <?php
    }    
}
endif;
add_action( 'metro_magazine_home_page', 'metro_magazine_big_img_single_cat_content', 50 );

if( ! function_exists( 'metro_magazine_more_news_content' ) ) :
/**
 * Category Section Five
*/
function metro_magazine_more_news_content(){
    if( is_front_page() ){
        $fifth_cat = get_theme_mod( 'metro_magazine_category_five' ); //from customizer
        
        $cat = get_category( $fifth_cat );  ?>
           <section class="section-five">
                <div class="container">
                    <header class="header">
                        <h2 class="header-title"><span><?php if( $fifth_cat ){ echo esc_html( $cat->name ); }else{ esc_html_e( 'Latest Posts', 'metro-magazine' ); } ?></span></h2>
                    </header>
                    
                    <?php 
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'cat' => $fifth_cat,            
                        );
                        $single_qry = new WP_Query( $args );
                        if( $single_qry->have_posts() ){
                        $read_more = get_theme_mod( 'metro_magazine_read_more', __( 'View Detail', 'metro-magazine' ) );    
                            echo '<div class="row">';
                                while( $single_qry->have_posts() ){
                                    $single_qry->the_post();
                                    ?>
                                    <div class="col">
                                        <div class="post">
                                            <div class="entry-meta">
                                                <?php metro_magazine_posted_on_date(); ?>
                                            </div>
                                            <div class="image-holder">
                                                <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                                    <?php 
                                                        if( has_post_thumbnail() ){ 
                                                            the_post_thumbnail( 'metro-magazine-more-news', array( 'itemprop' => 'image' ) );
                                                        }else{ 
                                                            metro_magazine_get_fallback_svg( 'metro-magazine-more-news' );
                                                        } 
                                                    ?>
                                                </a>
                                                <?php metro_magazine_colored_category(); ?>
                                            </div>
                                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php if( $read_more ){ ?>
                                                <div class="btn-detail"><a href="<?php the_permalink(); ?>">
                                                    <span class="fa fa-plus-circle"></span> 
                                                    <?php echo esc_html( $read_more ); ?></a>
                                                </div>
                                            <?php } ?>
                                        </div> 
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                            echo '</div>';
                        }
                    ?>
                    <div class="btn-holder"><a href="<?php if( $fifth_cat ){ echo esc_url( get_category_link( $fifth_cat ) ); }else{ echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); } ?>">               
                    <?php esc_html_e( 'View all','metro-magazine' ); ?></a></div>
                </div>
            </section>
        <?php 
    }
}
endif;
add_action( 'metro_magazine_home_page', 'metro_magazine_more_news_content', 60 );
/* Homepage Section End*/

if( ! function_exists( 'metro_magazine_breadcrumbs_cb' ) ) :
/**
 * App Landing Page Breadcrumb
 * 
 * @since 1.0.1
*/
function metro_magazine_breadcrumbs_cb() {    
    global $post;
    
    $post_page   = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front  = get_option( 'show_on_front' ); //What to show on the front page
    $showCurrent = get_theme_mod( 'metro_magazine_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $delimiter   = get_theme_mod( 'metro_magazine_breadcrumb_separator', __( '>', 'metro-magazine' ) ); // delimiter between crumbs
    $home        = get_theme_mod( 'metro_magazine_breadcrumb_home_text', __( 'Home', 'metro-magazine' ) ); // text for the 'Home' link
    $before      = '<span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'; // tag before the current crumb
    $after       = '</span>'; // tag after the current crumb
      
    $depth = 1;    
    echo '<div id="crumbs" itemscope itemtype="https://schema.org/BreadcrumbList"><span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url() ) . '" class="home_crumb"><span itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
        if( is_home() && ! is_front_page() ){            
            $depth = 2;
            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;          
        }elseif( is_category() ){            
            $depth = 2;
            $thisCat = get_category( get_query_var( 'cat' ), false );
            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;  
            }

            if ( $thisCat->parent != 0 ) {
                $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                $parent_categories = explode( ',', $parent_categories );

                foreach ( $parent_categories as $parent_term ) {
                    $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                    if( is_object( $parent_obj ) ){
                        $term_url    = get_term_link( $parent_obj->term_id );
                        $term_name   = $parent_obj->name;
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                        $depth ++;
                    }
                }
            }

            if( $showCurrent ) echo $before . '<span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;

        }elseif( is_tag() ){            
            $queried_object = get_queried_object();
            $depth = 2;

            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;    
        }elseif( is_author() ){            
            $depth = 2;
            global $author;
            $userdata = get_userdata( $author );
            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $userdata->display_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;  
        }elseif( is_day() ){            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'metro-magazine' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'metro-magazine' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            $depth ++;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'metro-magazine' ) ), get_the_time( __( 'm', 'metro-magazine' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'metro-magazine' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            $depth ++;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'd', 'metro-magazine' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
             
        }elseif( is_month() ){            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'metro-magazine' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'metro-magazine' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            $depth++;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'F', 'metro-magazine' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
        }elseif( is_year() ){            
            $depth = 2;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'metro-magazine' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
        }elseif( is_single() && !is_attachment() ) {            
            //For Post                
            $cat_object       = get_the_category();
            $potential_parent = 0;
            $depth            = 2;
            
            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';  
                $depth++;
            }
            
            if( is_array( $cat_object ) ){ //Getting category hierarchy if any
    
                //Now try to find the deepest term of those that we know of
                $use_term = key( $cat_object );
                foreach( $cat_object as $key => $object ){
                    //Can't use the next($cat_object) trick since order is unknown
                    if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                        $use_term = $key;
                        $potential_parent = $object->term_id;
                    }
                }
                
                $cat = $cat_object[$use_term];
          
                $cats = get_category_parents( $cat, false, ',' );
                $cats = explode( ',', $cats );

                foreach ( $cats as $cat ) {
                    $cat_obj = get_term_by( 'name', $cat, 'category' );
                    if( is_object( $cat_obj ) ){
                        $term_url    = get_term_link( $cat_obj->term_id );
                        $term_name   = $cat_obj->name;
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                        $depth ++;
                    }
                }
            }

            if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;        
        }elseif( is_page() ){            
            $depth = 2;
            if( $post->post_parent ){            
                global $post;
                $depth = 2;
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                
                while( $parent_id ){
                    $current_page  = get_post( $parent_id );
                    $breadcrumbs[] = $current_page->ID;
                    $parent_id     = $current_page->post_parent;
                }
                $breadcrumbs = array_reverse( $breadcrumbs );
                for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                    if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                    $depth++;
                }

                if ( $showCurrent ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;      
            }else{
                if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
            }
        }elseif( is_search() ){            
            $depth = 2;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html__( 'Search Results for "', 'metro-magazine' ) . esc_html( get_search_query() ) . esc_html__( '"', 'metro-magazine' ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {            
            $depth = 2;
            $post_type = get_post_type_object(get_post_type());
            if( get_query_var('paged') ){
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'metro-magazine'), get_query_var('paged') ) . $after;
            }elseif( is_archive() ){
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }else{
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }              
        }elseif( is_attachment() ){            
            $depth  = 2;
            $parent = get_post( $post->post_parent );
            $cat    = get_the_category( $parent->ID );
            if( $cat ){
                $cat = $cat[0];
                echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
            }
            if( $showCurrent ) echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;   
        }elseif ( is_404() ){
            if( $showCurrent ) echo $before . esc_html__( '404 Error - Page not Found', 'metro-magazine' ) . $after;
        }
        if( get_query_var('paged') ) echo __( ' (Page', 'metro-magazine' ) . ' ' . get_query_var('paged') . __( ')', 'metro-magazine' );        
        echo '</div>';
}
endif;
add_action( 'metro_magazine_breadcrumbs', 'metro_magazine_breadcrumbs_cb' );

if( ! function_exists( 'metro_magazine_content_start' ) ) :
/**
 * Content Start
 * 
 * @since 1.0.1
*/
function metro_magazine_content_start(){ 
    
    $class = is_404() ? 'error-holder' : 'row' ;
    $first_cat  = get_theme_mod( 'metro_magazine_category_one' ); //from customizer
    $second_cat = get_theme_mod( 'metro_magazine_category_two' ); //from customizer
    $third_cat  = get_theme_mod( 'metro_magazine_category_three' ); //from customizer
    $fourth_cat = get_theme_mod( 'metro_magazine_category_four' ); //from customizer
    $fifth_cat  = get_theme_mod( 'metro_magazine_category_five' ); //from customizer
    
    if( is_home() || !( $first_cat || $second_cat ||  $third_cat || $fourth_cat || $fifth_cat ) || !( is_front_page() || is_page_template( 'template-home.php' ) ) ){
    ?>
    <div id="content" class="site-content">
        <div class="container">
             <div class="<?php echo esc_attr( $class ); ?>">
    <?php
    }
}
endif;
add_action( 'metro_magazine_before_content', 'metro_magazine_content_start', 20 );

if( ! function_exists( 'metro_magazine_page_content_image' ) ) :
/**
 * Page Featured Image
 * 
 * @since 1.0.1
*/
function metro_magazine_page_content_image(){
    $sidebar_layout = metro_magazine_sidebar_layout();
    if( has_post_thumbnail() )
    ( is_active_sidebar( 'right-sidebar' ) && ( $sidebar_layout == 'right-sidebar' ) ) ? the_post_thumbnail( 'metro-magazine-with-sidebar', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'metro-magazine-without-sidebar', array( 'itemprop' => 'image' ) );    
}
endif;
add_action( 'metro_magazine_before_page_entry_content', 'metro_magazine_page_content_image' );

if( ! function_exists( 'metro_magazine_archive_content_image' ) ) :
/**
 * Archive Image
 * 
 * @since 1.0.1
*/
function metro_magazine_archive_content_image(){
    echo '<a href="' . esc_url( get_the_permalink() ) . '" class="post-thumbnail">'; 
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'metro-magazine-three-row', array( 'itemprop' => 'image' ) ); 
        }else{
            metro_magazine_get_fallback_svg( 'metro-magazine-three-row' );
        }
    echo '</a>';
}
endif;
add_action( 'metro_magazine_before_archive_entry_content', 'metro_magazine_archive_content_image', 10 );

if( ! function_exists( 'metro_magazine_post_content_image' ) ) :
/**
 * Post Featured Image
 * 
 * @since 1.0.1
*/
function metro_magazine_post_content_image(){
    if( has_post_thumbnail() ){
    echo ( !is_single() ) ? '<a href="' . get_the_permalink() . '" class="post-thumbnail">' : '<div class="post-thumbnail">'; 
         ( is_active_sidebar( 'right-sidebar' ) ) ? the_post_thumbnail( 'metro-magazine-with-sidebar', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'metro-magazine-without-sidebar', array( 'itemprop' => 'image' ) ) ; 
    echo ( !is_single() ) ? '</a>' : '</div>' ;    
    }
}
endif;
add_action( 'metro_magazine_before_post_entry_content', 'metro_magazine_post_content_image', 10 );
add_action( 'metro_magazine_before_search_entry_summary', 'metro_magazine_post_content_image', 10 );

if( ! function_exists( 'metro_magazine_post_entry_header' ) ) :
/**
 * Post Entry Header
 * 
 * @since 1.0.1
*/
function metro_magazine_post_entry_header(){ ?>    
    <header class="entry-header">
        <?php
            if ( is_single() ) {
                the_title( '<h1 class="entry-title">', '</h1>' );
            } else {
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }

        if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php metro_magazine_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
    </header>

    <?php
}
endif;
add_action( 'metro_magazine_before_post_entry_content', 'metro_magazine_post_entry_header', 20 );
add_action( 'metro_magazine_before_search_entry_summary', 'metro_magazine_post_entry_header', 20 );

if( ! function_exists( 'metro_magazine_archive_entry_header_before' ) ) :
/**
 * Archive Entry Header
 * 
 * @since 1.0.1
*/
function metro_magazine_archive_entry_header_before(){
    echo '<div class = "text-holder" >';
}    
endif; 
add_action( 'metro_magazine_before_archive_entry_content', 'metro_magazine_archive_entry_header_before', 20 );  
    
if( ! function_exists( 'metro_magazine_archive_entry_header' ) ) :
/**
 * Archive Entry Header
 * 
 * @since 1.0.1
*/
function metro_magazine_archive_entry_header(){
    ?>
    <header class="entry-header">
        <div class="entry-meta">
            <?php metro_magazine_posted_on_date(); ?>
        </div><!-- .entry-meta -->
        <h2 class="entry-title"><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h2>
    </header>   
    <?php
}
endif;
add_action( 'metro_magazine_before_archive_entry_content', 'metro_magazine_archive_entry_header', 20 );

if( ! function_exists( 'metro_magazine_post_author' ) ) :
/**
 * Post Author Bio
 * 
 * @since 1.0.1
*/
function metro_magazine_post_author(){
    if( get_the_author_meta( 'description' ) ){
        global $post;
    ?>
    <section class="author-section">
        <div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 126 ); ?></div>
            <div class="text-holder">
                <strong class="name"><?php echo esc_html( get_the_author_meta( 'display_name', $post->post_author ) ); ?></strong>
                <?php echo wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ); ?>
            </div>
    </section>
    <?php  
    }  
}
endif;
add_action( 'metro_magazine_author_info_box', 'metro_magazine_post_author' );

if( ! function_exists( 'metro_magazine_get_comment_section' ) ) :
/**
 * Comment template
 * 
 * @since 1.0.1
*/
function metro_magazine_get_comment_section(){
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
}
endif;
add_action( 'metro_magazine_comment', 'metro_magazine_get_comment_section' );

if( ! function_exists( 'metro_magazine_content_end' ) ) :
/**
 * Content End
 * 
 * @since 1.0.1
*/
function metro_magazine_content_end(){
    $first_cat  = get_theme_mod( 'metro_magazine_category_one' ); //from customizer
    $second_cat = get_theme_mod( 'metro_magazine_category_two' ); //from customizer
    $third_cat  = get_theme_mod( 'metro_magazine_category_three' ); //from customizer
    $fourth_cat = get_theme_mod( 'metro_magazine_category_four' ); //from customizer
    $fifth_cat  = get_theme_mod( 'metro_magazine_category_five' ); //from customizer
    
    if ( is_page_template( 'template-home.php' ) || ( is_front_page() && ! is_home() ) ){ 
        echo '</div>'; 
    }
    if( is_home() || !( $first_cat || $second_cat ||  $third_cat || $fourth_cat || $fifth_cat ) || !( is_front_page() || is_page_template( 'template-home.php' ) ) ){
        echo '</div></div></div>';// .row /#content /.container
    }
}
endif;
add_action( 'metro_magazine_after_content', 'metro_magazine_content_end', 20 );

if( ! function_exists( 'metro_magazine_footer_start' ) ) :
/**
 * Footer Start
 * 
 * @since 1.0.1
*/
function metro_magazine_footer_start(){
    echo '<footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">';
}
endif;
add_action( 'metro_magazine_footer', 'metro_magazine_footer_start', 20 );

if( ! function_exists( 'metro_magazine_footer_widgets' ) ) :
/**
 * Footer Bottom
 * 
 * @since 1.0.1 
*/
function metro_magazine_footer_widgets(){
    echo '<div class="footer-t">';
        echo '<div class="container">';
            echo '<div class="row">';
                 echo '<div class= "col">';
                     if( is_active_sidebar( 'footer-sidebar-one') ) dynamic_sidebar( 'footer-sidebar-one' ); 
                 echo '</div>';
                 echo '<div class= "col">';
                     if( is_active_sidebar( 'footer-sidebar-two') ) dynamic_sidebar( 'footer-sidebar-two' ); 
                 echo '</div>';
                 echo '<div class= "col">';
                     if( is_active_sidebar( 'footer-sidebar-three') ) dynamic_sidebar( 'footer-sidebar-three' ); 
                 echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
}
endif;
add_action( 'metro_magazine_footer', 'metro_magazine_footer_widgets', 30 );

if( ! function_exists( 'metro_magazine_footer_credit' ) ) :
/**
 * Footer Credits 
 */
function metro_magazine_footer_credit(){
    $copyright_text = get_theme_mod( 'metro_magazine_footer_copyright_text' );
    echo '<div class="footer-b">';
        echo '<div class="container">'; 
            echo '<div class="site-info">';
                if( $copyright_text ){
                    echo wp_kses_post( $copyright_text );
                }else{
                    esc_html_e( '&copy; ', 'metro-magazine' ); 
                    echo esc_html( date_i18n( __( 'Y', 'metro-magazine' ) ) );
                    echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
                }
                esc_html_e( 'Metro Magazine | Developed By ', 'metro-magazine' );
                echo '<a href="'. esc_url( __( 'https://rarathemes.com/', 'metro-magazine' ) ) .'" rel="nofollow" target="_blank">'. esc_html__( 'Rara Theme', 'metro-magazine' ) . '</a>. ';
                printf( esc_html__( 'Powered by %s.', 'metro-magazine' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'metro-magazine' ) ) .'" target="_blank">'. esc_html__( 'WordPress', 'metro-magazine' ) . '</a>' );
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                     the_privacy_policy_link();
                   }
            echo '</div>';
        echo '</div>';
    echo '</div>';
}
endif;
add_action( 'metro_magazine_footer', 'metro_magazine_footer_credit', 40 );

if( ! function_exists( 'metro_magazine_footer_end' ) ) :
/**
 * Footer End
 * 
 * @since 1.0.1 
*/
function metro_magazine_footer_end(){
    echo '</footer>'; // #colophon
    echo '<div class="overlay"></div>'; 
}
endif;
add_action( 'metro_magazine_footer', 'metro_magazine_footer_end', 50 );

if( ! function_exists( 'metro_magazine_page_end' ) ) :
/**
 * Page End
 * 
 * @since 1.0.1
*/
function metro_magazine_page_end(){ ?>
        </div><!-- #acc-content -->
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'metro_magazine_after_footer', 'metro_magazine_page_end', 20 );