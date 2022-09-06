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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'timothy' );

/** Database password */
define( 'DB_PASSWORD', 'o##e8ii4#?' );

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
define( 'AUTH_KEY',         '{jk@+w$jz6M&J#N]dpnAw~{EWXYOldBfC?&=s$&o%[*-?lHOxAJO*EtxDup,CHw]' );
define( 'SECURE_AUTH_KEY',  'fUW#1N]dy54[J67qT&(6%L]z2Cz_Ysr-aS<(elh;dG+xNwd@I++d%K%>Dd&NRlbj' );
define( 'LOGGED_IN_KEY',    'P+%d}+wBMo=p}Wht3FU1^ Z() s3<TUYx@NO[zG<L)?Vf+YXmf?IJ9g/0D[T+fX?' );
define( 'NONCE_KEY',        'P9/hsb1eI5R>O%dKN3N+)STB#Ji,Vd:g}GBj<-a+UXmFr8p!*}|m-sT_?}%!FrR?' );
define( 'AUTH_SALT',        'Z?f(`9b?SfP;Iq9t7FUB{}37xh>dPE.Q*grz#R1AG D7^r+A*Cn(3E,aIp=:!>$X' );
define( 'SECURE_AUTH_SALT', '.ziKitH*b%0.LO9%;f;M2Mp>Uh]^1)VwG._u6:HSN!|8l}V)4F[)HAFn&S2SiOpb' );
define( 'LOGGED_IN_SALT',   'S#/NUN559dYM 0x S?eiRkEfTpU8llHtv@3)PRt]TN603_=^k0T?/Ruuly2JnQpa' );
define( 'NONCE_SALT',       'f{>&S,C.N%@0r4j/dYSts@ewqUhqQCU9GWCy7cW,t0CmWTDS7#{/SC}h:/~;V4Cq' );

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
