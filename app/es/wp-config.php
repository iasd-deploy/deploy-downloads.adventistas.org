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
define( 'DB_NAME', $_ENV['WP_DB_NAME'] ."_es");

/** MySQL database username */
define( 'DB_USER', $_ENV['WP_DB_USER']);

/** MySQL database password */
define( 'DB_PASSWORD', $_ENV['WP_DB_PASSWORD']);

/** MySQL hostname */
define( 'DB_HOST', $_ENV['WP_DB_HOST'] .':3306');

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

/* Multisite */
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'downloads.adventistas.org');
define('PATH_CURRENT_SITE', '/es/');
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
define('AUTH_KEY',         'w:FLB`ad(9 a/D>:{X.]|1Ol=[yu(xa~:@ER4Lh+Jo?A`63gfI9$x;-@z5}r3>qz');
define('SECURE_AUTH_KEY',  'PQrU-|hd`nQo=|yckE:#*h!|BhJMOo^0BN?^4bXqiP,7vWNGm`RdhC+&D n|]Jv$');
define('LOGGED_IN_KEY',    'fl!}lLDw?R+FQ{;rY&;Ta]T%|Bs7 xYeT~&`;$Hwi<#W.=)|BB(P8npG<.,72N6-');
define('NONCE_KEY',        ';s.lku+~85%/m+P<n5LXHNCd^yT=N_a1-k`?[*;ZE2fa!o9Z( J[/ff(u( 5<h!`');
define('AUTH_SALT',        'LW 6=45X-i5J-lT0y?+N8W(yc*`(?WG8aw5[];XYUd@-|&fP=N.x=Ig*BG1kdhym');
define('SECURE_AUTH_SALT', 'Dx*2_NQhsY#)eu7^g!f-%3cIdpdA+?A&ESv90/4J`x?`>c>+Ea=>lq,YGYkK!a,U');
define('LOGGED_IN_SALT',   '>U0-+8?-:G2OixVz<B|^%6#d`zutDJ<^V*y*rCl/K8+jU1i/`T(/3KfDzt/?@|_]');
define('NONCE_SALT',       'NH,S%9P$Is$1Es4F6~o|GDV-16!7<f;O?#,129alL%P[aO^P8<6AWq!WW`P+vx4)');

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
define('WPLANG', 'es_ES');

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
