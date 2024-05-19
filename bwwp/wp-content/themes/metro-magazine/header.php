<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Metro_Magazine
 */

	/**
     * Doctype Hook
     * 
     * @hooked metro_magazine_doctype_cb
    */
    do_action( 'metro_magazine_doctype' );
?>

<head itemscope itemtype="https://schema.org/WebSite">

<?php 
    /**
     * Before wp_head
     * 
     * @hooked metro_magazine_head
    */
    do_action( 'metro_magazine_before_wp_head' );

    wp_head(); 
?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php 
    wp_body_open(); 
    /**
     * Before Header
     * 
     * @hooked metro_magazine_page_start - 20 
    */
    do_action( 'metro_magazine_before_header' );
    
    /**
     * Metro Magazine Header
     * 
     * @hooked metro_magazine_mobile_header  - 5
     * @hooked metro_magazine_header_start  - 20
     * @hooked metro_magazine_header_top - 30
     * @hooked metro_magazine_header_bottom - 40
     * @hooked metro_magazine_header_menu - 50
     * @hooked metro_magazine_header_end - 60 
    */
    do_action( 'metro_magazine_header' );
    
    /**
     * Before Header
     * 
     * @hooked metro_magazine_after_header - 20 
    */
    do_action( 'metro_magazine_after_header' );
    
    /**
     * Before Content
     * 
     * @hooked metro_magazine_page_header - 20
    */
    do_action( 'metro_magazine_before_content' );