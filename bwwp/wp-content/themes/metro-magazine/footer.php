<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Metro_Magazine
 */

/**
     * After Content
     * 
     * @hooked metro_magazine_content_end - 20
    */
    do_action( 'metro_magazine_after_content' );
    

    /**
     * App Landing Page Footer
     * 
     * @hooked metro_magazine_footer_start  - 20
     * @hooked metro_magazine_footer_widgets   - 30
     * @hooked metro_magazine_footer_credit - 40
     * @hooked metro_magazine_footer_end    - 50
    */
	do_action( 'metro_magazine_footer' ); 
    
    /**
	 * After Footer
     * 
     * @hooked metro_magazine_page_end - 20
	 */
    do_action( 'metro_magazine_after_footer' );
    

wp_footer(); ?>

</body>
</html>