<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Metro_Magazine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php 
        /**
         * Before Page entry content
         * 
         * @hooked metro_magazine_post_content_image - 10
         * @hooked metro_magazine_post_entry_header  - 20 
        */
        do_action( 'metro_magazine_before_post_entry_content' ); 
    ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'metro-magazine' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php metro_magazine_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
