<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Metro_Magazine
 */
$read_more = get_theme_mod( 'metro_magazine_blog_page_read_more', __( 'Read More', 'metro-magazine' ) );    
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
        /**
         * Before before archive entry content
         * 
         * @hooked @see metro_magazine_archive_content_image  - 20 
        */
        do_action( 'metro_magazine_before_archive_entry_content' );    
    ?>
    	<div class="entry-content">
    		<?php the_excerpt(); ?>
    	</div><!-- .entry-content -->
        <?php if( $read_more ){ ?>
        	<footer class="entry-footer">
        		<a href="<?php the_permalink(); ?>" class="btn-readmore"><span class="fa fa-plus-circle"></span> <?php echo esc_html( $read_more ); ?></a>
        	</footer><!-- .entry-footer -->
        <?php } ?>
    </div>
</article><!-- #post-## -->
