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
define( 'DB_NAME', 'frdxuf3cs7bew6mv' );

/** Database username */
define( 'DB_USER', 'zn07zad6tsnbl6fi' );

/** Database password */
define( 'DB_PASSWORD', 'f4wsd14ju1mh6uq6' );

/** Database hostname */
define( 'DB_HOST', 'q0h7yf5pynynaq54.cbetxkdyhwsb.us-east-1.rds.amazonaws.com' );

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
define( 'AUTH_KEY',         'kJuS?nj$f(K;_`6rf>bnN^pB8@1R-t|v8jmJmHM!6+V,n-CJ[R`Le[B3O.%i/@o)' );
define( 'SECURE_AUTH_KEY',  'Dw!&vM*ui)n&F-lQ-Yn5HTUKBx&COt.4HBNo^2]r90jO1SL3jNj`:AgBW/<RHN40' );
define( 'LOGGED_IN_KEY',    'rB_tYE Ho[U]Ye7: [>fP#uqZyTa=^Y`s*4*A1Qo?:?Nk,gG[MMJ.C<.3bU/uf4M' );
define( 'NONCE_KEY',        '}Vs*tr/i%GV&Mv!4;V+^F<.,]<tu?ue{_#KHFAw,F#t]~LDH$j&eAX{|+|*pe|V,' );
define( 'AUTH_SALT',        'E<jL!,DdW/sf)1V$Oqs&dpq3E9,>v;cjD*Uy,Jcz:W=s)]]/g%Tx9x?TH*P{IKHJ' );
define( 'SECURE_AUTH_SALT', 'wL;9jfZ$NB.aRF-59yfo7y?VEc(- YB]f]N,65n}Fm},%>SZ]#j2Z?3E)~mVK8od' );
define( 'LOGGED_IN_SALT',   ' n:(1_I|z:IlO44uc;;U`m/~fo9&Fy/HjK?;fNPL$M1R3 ,=/;/1NyK5z.e/xSSy' );
define( 'NONCE_SALT',       'PGB:cCXWXW<C$TE3-@Im8~,Qnf>5v@g`cuO%OB,#f@w^3`O8w`pddIyDeIH#ErH1' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_mml';

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
