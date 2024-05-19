<?php
/**
 * Metro Magazine functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Metro_Magazine
 */

$metro_magazine_theme_data = wp_get_theme();
if( ! defined( 'METRO_MAGAZINE_THEME_VERSION' ) ) define( 'METRO_MAGAZINE_THEME_VERSION', $metro_magazine_theme_data->get( 'Version' ) );
if( ! defined( 'METRO_MAGAZINE_THEME_NAME' ) ) define( 'METRO_MAGAZINE_THEME_NAME', $metro_magazine_theme_data->get( 'Name' ) );
if( ! defined( 'METRO_MAGAZINE_THEME_TEXTDOMAIN' ) ) define( 'METRO_MAGAZINE_THEME_TEXTDOMAIN', $metro_magazine_theme_data->get( 'TextDomain' ) );

/**
 * Implement Local Font Method functions.
 */
require get_template_directory() . '/inc/class-webfont-loader.php';

/**
 * Implement the Custom functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Custom template function for this theme.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin for right and no sidebar
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Load widgets.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Dynamic Styles
 */
require get_template_directory() . '/css/style.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';
/**
* Recommended Plugins
*/
require_once get_template_directory() . '/inc/tgmpa/recommended-plugins.php';
