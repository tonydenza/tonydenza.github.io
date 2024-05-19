<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Metro_Magazine
 */

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" itemscope itemtype="https://schema.org/WPSideBar">
	<?php dynamic_sidebar( 'right-sidebar' ); ?>
</aside><!-- #secondary -->