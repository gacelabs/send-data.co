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
define('AUTH_KEY',         'rZj%pY8P)#a{Y|ra{lDo8a8{g#G 7A{L3,OD53~]Cf]]DJrT/N(G.vIS{;|w161/');
define('SECURE_AUTH_KEY',  'DlF}9=wjvP_YM JwA@PM33,oKeGa>>v3L9hQ/-tnXkW30Xt<pyf^EjQ8]E(7Knx/');
define('LOGGED_IN_KEY',    '4ePyz_ySo5:~8r/#V*@4%C}pL%`Or`A#1onwDqZ+UpG)K;?)T9_KZxWtU&!>f^2q');
define('NONCE_KEY',        '|Y0bc:NzW:C9{MS}n]N7}//}Lbl]D=z~~;qgF&/6Egl00@m64dcgS(PLuU`Y*)FH');
define('AUTH_SALT',        'FK)*LV#o1J]KV=HPXC!F=P~aQR/K|WfBY^$_4?n:iuPv{aD_a1zcxFm[Ky=tDs/?');
define('SECURE_AUTH_SALT', 'L%$L{Z!1bEu[n{ *7j!%h1!2/}(+=dYlO]ErpqODH~|L#GH.tMU(`=[V{u+dbd=t');
define('LOGGED_IN_SALT',   'FwP<GzU=x2:jTE 9T(?M6$?:fqR-{=iL1.s$en$o5*7SDl@@zfiJ9@YP/&cQ!C5#');
define('NONCE_SALT',       'lS3?aW,`Tnx8KaVU+4j`2PXH/Cvb5I@g`9V|AY*AoX34EN*/,e|*Q=},ig}`?GDt');

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
