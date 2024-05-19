<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Metro_Magazine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<a href="<?php the_permalink(); ?>" class="entry-link"><?php the_permalink(); ?></a>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<footer class="entry-footer">
		<a class="btn-readmore" href="<?php the_permalink(); ?>"><span class="fa fa-plus-circle"></span> <?php esc_html_e('Read More','metro-magazine'); ?></a>
	</footer>
</article><!-- #post-## -->

						