<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Metro_Magazine
 */

get_header(); ?>

	<h1><?php esc_html_e( '404', 'metro-magazine' ); ?></h1>
	<h2><?php esc_html_e( 'The requested page cannot be found', 'metro-magazine' ); ?></h2>
	<p><?php esc_html_e( 'Sorry but the page you are looking for cannot be found. Take a moment and do a search below or start from our', 'metro-magazine' ); ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'homepage.', 'metro-magazine' ); ?></a></p>
	<?php
		get_search_form();
	?>

<?php
get_footer();