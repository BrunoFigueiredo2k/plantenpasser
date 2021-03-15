<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'planten-passer-nl' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'DuGpuh6$Aj`+wt,Z2{3}Vc@5)RjbKTvPZUMF<:sH2 @2glmu!A{PTIttaWVHAT1b' );
define( 'SECURE_AUTH_KEY',  'gnf%^B=S0864E;SP15X(No1O.+|txZBdR$SQ.F+gv`IFO&it)A>;aoNVxg6w42iL' );
define( 'LOGGED_IN_KEY',    'j[.Hy,2u%0klg{E_i_~Q4XBVlXjdaU-kKFT.p#;5~bZ~G3(X<l{do#18H5x1o,/a' );
define( 'NONCE_KEY',        '&=a|,IjqEpb6`E]$65nX/c0e;An=[+`snf23JZC@qmtm+_9($~d^WWu-hBREBQg#' );
define( 'AUTH_SALT',        '/Q*[uX!U@EeaYu{R-[1oI`kOlay8a&t$[D0L>_l0mZP}_&ct,=%(+gjo 5CKeB,3' );
define( 'SECURE_AUTH_SALT', 'Q.c_4oFHHSk8jnoOD~?<wG`u7HQy!)btZqXnFkJ#kV `tLwR8E!pe#YE8@oqmj,&' );
define( 'LOGGED_IN_SALT',   'p#|TV4/4ovJWzU*K:1D!8hIP5e#epXpBsZ;TGQ~qX~S$~HLnRI*9!VS42bqnX;2|' );
define( 'NONCE_SALT',       'rp+C_}_lPzb]LykpoFT5xB,WV<ViRQ!G<-C`R.j4^-3Jr`B]/m$o5?4=J`H&[NZN' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
