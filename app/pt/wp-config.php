<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

/// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'downloads_pt');

/** MySQL database username */
define( 'DB_USER', 'root');

/** MySQL database password */
define( 'DB_PASSWORD', 'root');

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3307');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8mb4_unicode_ci');

define('AS3CF_SETTINGS', serialize(array(
	'provider' => 'aws',
	'access-key-id' => $_ENV['WP_S3_ACCESS_KEY'],
	'secret-access-key' => $_ENV['WP_S3_SECRET_KEY'],
	'bucket' => $_ENV['WP_S3_BUCKET']
)));

/** configuracoes personalizadas */
define('SITE', 'downloads');
define('DISALLOW_FILE_EDIT', true);
define('WP_AUTO_UPDATE_CORE', false);
define('FORCE_SSL', true);
define('FORCE_SSL_ADMIN', true);
$_SERVER['HTTPS'] = 'on';
define('PA_LANG', true);

// Ativa a lixeira das midias
define('MEDIA_TRASH', true);

/* Multisite */
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'downloads.adventistas.org');
define('PATH_CURRENT_SITE', '/pt/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

define('WP_POST_REVISIONS', false);

header('X-Frame-Options: SAMEORIGIN');
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'hkbG&}Q+|^Q(X_y09<RP]p~,yT&7YFtFTQ*-!{NAzN]rq.-/#rJ=O$(M{II~_FxU');
define('SECURE_AUTH_KEY',  'U3R|_+>oe- JRA-C+f:]om+W|Ac+ijar<}*j%!G;]bW4]Wbhj<GS.%jM2!|yE8s-');
define('LOGGED_IN_KEY',    ' /0z-,-In`D?a|1CmZdR-=8R&(^z>?8qq2 %D{2jA>!O?rNAfg>6!G0tX1C7kv4s');
define('NONCE_KEY',        '+r+YKpaz%THDa j_ @fte3^Xbue~dWO=[g^N;rAX+i=[e_y!+#:Sw_rmj>p=TK>%');
define('AUTH_SALT',        'vmI]?GehPcVYGNt)YK=>sm(vY8!0w[6XA|-bT+6OU@$!PuyF/Q [j>2T[8,,_N_(');
define('SECURE_AUTH_SALT', '`^}E+2M`Cl#gcx;TT+x_gggAmPT~)K6rC8u_IT#DfSz9PTc:?4-[|]ok0p]YG4aB');
define('LOGGED_IN_SALT',   '):L3}w|*. eBYvn^`L(n{:(-k$lblki@|:x8}:N,]Iw.|2R9G&wtI(lV0WS&#iDC');
define('NONCE_SALT',       '@JWM|Epz}P4]w*y7eudZQ<@U?2+g:o+>v v{2!DUT5X 9A/XhOzG:$,,jM-[){3c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'pt_BR');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/** Enable Cache */
 // Added by WP Rocket

define( 'PB_BACKUPBUDDY_MULTISITE_EXPERIMENT', true );
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
