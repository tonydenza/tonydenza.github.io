<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Metro Magazine
 */

$first_cat  = get_theme_mod( 'metro_magazine_category_one' ); //from customizer
$second_cat = get_theme_mod( 'metro_magazine_category_two' ); //from customizer
$third_cat  = get_theme_mod( 'metro_magazine_category_three' ); //from customizer
$fourth_cat = get_theme_mod( 'metro_magazine_category_four' ); //from customizer
$fifth_cat  = get_theme_mod( 'metro_magazine_category_five' ); //from customizer
$ed_topnews_sec = get_theme_mod( 'metro_magazine_ed_top_news_section' );

if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
}elseif( $ed_topnews_sec || $first_cat || $second_cat || $third_cat || $fourth_cat || $fifth_cat ){ 
    get_header();
    /**
     * @hooked metro_magazine_top_news_section - 10 
     * @hooked metro_magazine_three_col_cat_content - 20
     * @hooked metro_magazine_three_row_cat_content - 30
     * @hooked metro_magazine_three_video_cat_content - 40
     * @hooked metro_magazine_big_img_single_cat_content - 50
     * @hooked metro_magazine_more_news_content          - 60  
    */
    do_action( 'metro_magazine_home_page' );
    get_footer();   
}else{
    include( get_page_template() );
}