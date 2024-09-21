<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'a7CWMp~`1SEJ)G*#SLWZm[cATd(1@d4INUT=aPW?ecClApbnNrXoLg(!XG4J$_d(' );
define( 'SECURE_AUTH_KEY',  '&>AR?qe :.SYwh#pSserZhm!%KwWa~<ub3:9K{Wn.KzD]s<N]SK#]JizF[*=6i.n' );
define( 'LOGGED_IN_KEY',    '&r ]!GO{3!iy)+X?HizV+]P6r]RA.K=>XGzk(9P)k.*Y}*>|L>E={>ROKW=;LYgR' );
define( 'NONCE_KEY',        '.`` {{qh%~Jq8j~~Ik!(vyzXHJS/^r]C?&i%ZM hzc$fwN)+Zqfi3*0(%hLUY30k' );
define( 'AUTH_SALT',        '*z+?M7~4B4 tNqola=}@B4w[T67gk[c_(1qbf{%+jiMo^/m./+W_%|<_g&~6QmM?' );
define( 'SECURE_AUTH_SALT', 'j*g>M^`nU{p^u/sGh9T.Vecj&[fu?I%}sl=MDU/Mi6hN9(2gp{<~l_hJz!.(Fi=_' );
define( 'LOGGED_IN_SALT',   '4|jRuW)f(Dt>psID5&.oO*Z<a}+0k@o&c&;Hbp:m-}>D?w|xiFIu+_N1K3quGIfK' );
define( 'NONCE_SALT',       'x$0z0.<}$j#SL#WG<3h[ ByiJZzkyM_h+^b{ln+]FUhW$D;n1Nn|4Jw;/WVA=2q@' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
