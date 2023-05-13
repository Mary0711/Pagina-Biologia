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
define( 'DB_NAME', 'ccom' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3305' );

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
define( 'AUTH_KEY',         'B^-iEWQ91g:n0FELZlZKp($/)t1|pi3 RFM=Jy0$@HTBuo-ze3v}vk$}V9h ,S5P' );
define( 'SECURE_AUTH_KEY',  ':9F3J2Pm3.E/{z0N)>8u?t q~.)D>LAEPX8!{5LC#3)Z!cVmajf^C;JqD&m{Q6bG' );
define( 'LOGGED_IN_KEY',    'f]E7/.5)`27l4bg@kV@3VO-J}f0k#53C>*iI8HebmW}g_:^:w0 e p1/ Di3[Ut[' );
define( 'NONCE_KEY',        'c==UGR*o^:KvB-]yj%:z!)Ywzrhy*3UyUKr*f9:GpPz%S% UMBZ14hUQ>JB&nsc~' );
define( 'AUTH_SALT',        'tf_lyPnuTRTJ?.4)-;vDA7,}cra!U+=?:vT%h7%y55u7Ddd@JY$90_bkO!*t{xa/' );
define( 'SECURE_AUTH_SALT', 'l$XFgFF:+0IBHA=FF;kig0=^%@~Kf#2.d)@PD02qnEkkx)fCElzYI|4IB%p8xH!V' );
define( 'LOGGED_IN_SALT',   ')1rwGdlK&LeLHRaChz4*!tjICHtC-w&.HBjv9a49# 0.5Gz&_uGkOm;jb9y7r73n' );
define( 'NONCE_SALT',       'P5&yv]>M&l}(9nE( e3IDZ72Ln88<5aGsd&NN]r*QNmUNLl~}LJI=ff9,]gWQqfk' );

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
