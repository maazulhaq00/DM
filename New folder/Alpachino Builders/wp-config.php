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
define( 'DB_NAME', 'alpachino_db' );

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
define( 'AUTH_KEY',         'mV_#m@6$$d+A(#P[S}+0.p`ao1i*%(UM.={wT=PU_[+@KMuu>ODX0>xtLt9X0o?o' );
define( 'SECURE_AUTH_KEY',  'omn1 q:n*IIh5ER&B^SQ!&G-pnZH>mWFR{g!3&oSe&/a@z7qX7_u%N=AXl/U ]N6' );
define( 'LOGGED_IN_KEY',    '{;):J:%j]PE{:g+>-p9NqTJPDCu<%^!~O!Ecz*SD.WbL+)NHmnn871G>Zq8x:sAp' );
define( 'NONCE_KEY',        'WQv pt+RwYGo~F+GOnn$(IV(N?gtLZd-wMVPp/v^8(p_lNL0GH4_Gdse%..YC%Z^' );
define( 'AUTH_SALT',        '0%(J<pKnYZQA{Gb&wd#UA|)M*z3+t=:_sba-Gf4lK}GEx*9t-#e/2unxT:a>b6xB' );
define( 'SECURE_AUTH_SALT', 'x=c@L|[I{OF[P+,kS0gA/<>l,;>{BGa1oSS?WT}K~V!n={6lxssu|[,WiRud8nH=' );
define( 'LOGGED_IN_SALT',   '`5a@k2OkHejj-Nq(JS[jOB@g{]OJ1qgu5[&pgY1:Ym*Gh,T-SoPfFR6#OUF&DVD{' );
define( 'NONCE_SALT',       '0.Qq0T:yMO>|8Ih%sWBc#RA0 CX(7@?`EZA9J-*-3~|8Q5?AOF[U}WhMf9nKUEeg' );

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
