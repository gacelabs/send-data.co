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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'dpt-site');

/** MySQL database username */
define('DB_USER', 'pushthru');

/** MySQL database password */
define('DB_PASSWORD', 'D4t4Pu5h7hrU!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'o)8/P&Oe<LF/L>NjjtZmMj%D/v$@fX8[VUaMnc(:uVfU$3p;@f!x;Zp:hn`+&:#k');
define('SECURE_AUTH_KEY',  'k>SI#asuU$7s*9!/+&[J~5SY!F1QZX| (tfPm$6AO[k?hXKE|;TUNjZvDRaC|fSK');
define('LOGGED_IN_KEY',    'iS8CZI6bRjBgnb.YSmw-m*dh7`WIB9TFarUT-EIyLtL]lWxZ7#ZrEI.ta+@[/ od');
define('NONCE_KEY',        'xqv3e4;>hB#mVEL;FbK^J.WD=[.NCEhYY%*^kGr7;p?|Ul0g3Riwgv0s>^I%i>,v');
define('AUTH_SALT',        '^]j;az%f3_L_$W(Lxlk) ??<a{`r|P@XqBbH2M2vKGE= q6?8HCEEHv)`~0B!kfH');
define('SECURE_AUTH_SALT', 'kAg}.3pzGet+?8]N{>:[2dnGIZ]GLgwif[aBL}buI!w0 K5v+bPIzYdvow@]JV3-');
define('LOGGED_IN_SALT',   'ng1u.LFI3c0g&1?(RRh>~LTkw,u+x+U*f6;Wh3)0_#CTr}<Iy)06@aiI4:Xq60YH');
define('NONCE_SALT',       ']aS!:!2*tF 9<V+ZL.g2P>=E%sk@rPk{k5w>!ab$M}J@~x8[c8nYxDdJ~y,_iA0f');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
