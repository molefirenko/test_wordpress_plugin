<?php
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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'mysql' );

/** MySQL database password */
define( 'DB_PASSWORD', 'mysql' );

/** MySQL hostname */
define( 'DB_HOST', 'db' );

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
define( 'AUTH_KEY',         'STXNa-Y~r^}nw+tJPu0A}vDHv#Sc_U&_T{lNzSb]?vMq=I%oOQy})[-t|X|Jil!;' );
define( 'SECURE_AUTH_KEY',  '{xg.[]p$iHe+AVxfs3[7S@=#J6({6@6}7v%U-wp3:=c>0::^+J=YRVoaL~qGjAU$' );
define( 'LOGGED_IN_KEY',    '1$IRqb$[p2`s+DrR(ccyL}ZX)M4ChjMLtFLGwC,L^HH{Z033%_-/y!T?TvMJ2-*&' );
define( 'NONCE_KEY',        '>Pk[L4Yu]G QNPEtu[D->+(t~%_/q{)-6-[E%39N&YCcl<h[4zDv.+[06a)*7:Yh' );
define( 'AUTH_SALT',        'PZ*iK+p!Uji=~mtZ ~FSC)HiXn.Sn(Zp(8JfHjxE>Y5I1B8y8S$*BE*CGX=mL^]~' );
define( 'SECURE_AUTH_SALT', 'dsJ.6)rZyp+]O[?~80_=t>ZD)#%L%cQn0|sIae)IrQ^k(Bt*.Z)BNdCX~; Nq(5,' );
define( 'LOGGED_IN_SALT',   'Or@dVGX^{wXTmupgSk1%BaMm0{/)_pXlyDY,Edg=/gt@i:iKq19SI5u(UPK4+1_b' );
define( 'NONCE_SALT',       '++?H4`{IEa,K)3^Kda{g^Ix&dmaENv8[ga4U$;5?#s$,cYKvsRN~A|U*Ii<tF|4!' );

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
