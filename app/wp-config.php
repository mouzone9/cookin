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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'data' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

/** Database hostname */
define( 'DB_HOST', 'db' );

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
define( 'AUTH_KEY',         '_btsf)^R(E&c<h3J$HeF?FtO4Mawp32Nn+Hm!VaJE5P`#as]LB=]1p?e/eH?FZTM' );
define( 'SECURE_AUTH_KEY',  'lcz^&9k!Mhn*lebJnK-1&L{+3rVT-I7xH2>2j/R)_2;F!aXdy9X_iE,#[x3gwg&@' );
define( 'LOGGED_IN_KEY',    't&yF>lZOcAV%NH/w}h(xgbcQzv)pvi`WfZ$389YevAkX!z|cbR-yq!dOT_GUq@)j' );
define( 'NONCE_KEY',        'cS)sY;g*0PFtIgKUxo,&7k/c(.|Wt=^]8{ujD)KMfAN]Qx9KMKcY8i-9K vc_-]E' );
define( 'AUTH_SALT',        ',X{KdxQvD(i8;|^528R4vb5c~/6ca(qkW.Mqix(5Z|G>FV|D?IZDz|_3EWb]HLCo' );
define( 'SECURE_AUTH_SALT', 'PJ]Br?d{{#=d#0I&dI;o*t[pDtZ[WrXctqJ`(UqEq g/GaB_N[N/CwyXHAy:m51 ' );
define( 'LOGGED_IN_SALT',   'B2&/k{iWxC8dD;SWfNo jH(]m8$9zO<u#(NQv!:cGQ>&@2wdWEkNzKxDlM!dUw};' );
define( 'NONCE_SALT',       '=ndwAb*Xc*g/]0r>&Yvy@mi$ZnD,f>-(1Mo+I*<d)7ib`}Sz9dv;R%JkBJ/<v)Nr' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
