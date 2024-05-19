<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bassweight' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '351294' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'tq*+(n<yH#MY&m#nXatLCkt3k3tTz<L9,O9JFe_I*X`*.A9=iTp+1I*S;[>rBj_;' );
define( 'SECURE_AUTH_KEY',  '7XiYKzO!mvOxqK+1yXS%9G1]w`KLJd]dgr0qQ?h=esH)CUIC$VB@lu>!~*SfL9hW' );
define( 'LOGGED_IN_KEY',    '=dz%nD_ V9w>o&%x9GS74B>,*%$/5ehsW6x;kB;{W!WNC!$LcxB{Buesw#o$ku1R' );
define( 'NONCE_KEY',        'OTt;hZ659ox2=l^aN1cbf,y<i}0Rfg6./1v~W>&L$.:kf3)D=+.,XPlN-:%F=,#K' );
define( 'AUTH_SALT',        'sB)CFVU]O?sN)`?!:LIu}*1~kP=O)*y16+szn1okBA3eBboUy?VHU?CF=3!>u+-E' );
define( 'SECURE_AUTH_SALT', 'K}Fb-}+.-8A!P@(!U9#K5ML%l{A|2a-E{[:F+CV~KLYZsp}RJZNiX:f{X40)tg$l' );
define( 'LOGGED_IN_SALT',   'Vd/4Z4Z46`hNc%wX}6AS5co~x!J9~T?Tc-;0ujJi(>[x:!~c>9quK#&A0:b#DD1.' );
define( 'NONCE_SALT',       'FR{Xi-pIb:X2coqA(~l,m)]aX|N;)8)CN4awo)`!F~J.S=}/SWO,,tlna(HZPo}*' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
