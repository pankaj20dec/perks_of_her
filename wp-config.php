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
define('DB_NAME', 'wp_perks_of_her');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'qCTR(a++EHTk)E-O7n9-#oG0QlKyj/gg.f,j=pplH@rG[1[0@H5SIpXErWYe40Rh');
define('SECURE_AUTH_KEY',  '8[Y)o[aiu@:#^9QTU<~pTF~DvE7Y%i+hMFpydK|-V|UP.P0DJp;7wuk`EEp^`gBh');
define('LOGGED_IN_KEY',    '<*k:G25oz8YpodtiPD2Ct*D&GE6M9U/@#}o-Igg;%&uxcg9G|W-by(_Zlo|>PPFz');
define('NONCE_KEY',        '_(>#G^+%#k,-WS{3$T 6a-UJL;WnPYWb$ZeFl@uZa%AqN#~s3RBsK3q>acxUqo0T');
define('AUTH_SALT',        'VTkd<9uP4`B1MIZo}XrBy2Jl{n;PXDv0kqz:=;`I;BCMoMKCd]j}8ur~5zj@j`7,');
define('SECURE_AUTH_SALT', ' Lc>8ZtT0d=n)TL[QY0E=G`;Xl^VtqwnX;21@lv`!!(k#/}1gJM;((/j~,_DnEK2');
define('LOGGED_IN_SALT',   '`u4Q2U{B69xA4gT,]K;JRgZ:&NI!R./|~e/hkO#D;,,ka`&5)zv%e!KionH!pj=B');
define('NONCE_SALT',       'Ic5Ljqy4>8X$q=<P,(rF{|^f}t(S@Ae{@VQK&530.%:I^rzjD7aI]c;uc XR-~6Q');

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
