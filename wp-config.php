<?php

// ===================================================
// Load database info and local development parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
    define( 'WP_LOCAL_DEV', true );
    include( dirname( __FILE__ ) . '/local-config.php' );
} else {
    define( 'WP_LOCAL_DEV', false );
    define( 'DB_NAME', '%%DB_NAME%%' );
    define( 'DB_USER', '%%DB_USER%%' );
    define( 'DB_PASSWORD', '%%DB_PASSWORD%%' );
    define( 'DB_HOST', '%%DB_HOST%%' ); // Probably 'localhost'
}

// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content' );


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
 //Added by WP-Cache Manager
// define('WP_CACHE', true); //Added by WP-Cache Manager
// define( 'WPCACHEHOME', '/Users/joverton/Sites/APU/alaskapacific.edu/content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define('AUTH_KEY',         '~|oN,:3x/I&~t%RK+y&(paj3**}Z<=kMz_tJ+Lf&8j+lza||V)}J`C{N|@V(~Hf ');
define('SECURE_AUTH_KEY',  'XmZzC|D8+Lm@B~P)w+rKl^Af5.TwKzH6zpoW|+U81x`j0C-BcAXpLb]?,J@%TV}w');
define('LOGGED_IN_KEY',    '_1T;7@C.Z!6|Ig!PqMMxcV;)&5#99l!?ekM&,,L--Z,a.:f.E)(YH]DOH}YVH|%i');
define('NONCE_KEY',        '%fE^KxUEp#|:g$j%OYx? K-T6+ ^C7{y2>n9Hl+/=@Oi+%jQ0:j^8@&IGMiCTnE5');
define('AUTH_SALT',        'qf/J(V&mh>-|?@6%r0Eelg,6:3-{2AfxAwCC =P.myTgL+SzFPg%#{^=2bQ:&)_x');
define('SECURE_AUTH_SALT', '8r]9RWd4M2io6%N?.y-PO@%bA,h4Yo)%`FWZ/[n^>H?0nL5(8g6bZ[DP|yRT4_V{');
define('LOGGED_IN_SALT',   'x:u4jBK{]a!mYz#:xgXw>8vCx8YGo|D/#74beJ8Kz7{nHv6S<nxIL]2`X{[_T}-H');
define('NONCE_SALT',       '/kb3+<w 3R}D:6mNOx[^xQB]^.|WHV0V*)NgjBp0YakTDk +7%!=c127g&|CT?cP');

// =================
// Security settings
// =================

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    define( 'FORCE_SSL_ADMIN', true );
}

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );

// ===========
// Hide errors
// ===========
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );


// ===============
// Multisite Setup
// ===============
define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'local.dev.alaskapacific.edu');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
define( 'PB_BACKUPBUDDY_MULTISITE_EXPERIMENT', true );

// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
    $memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );

// ===========================================================================================
// This can be used to programatically set the stage when deploying (e.g. production, staging)
// ===========================================================================================
define( 'WP_STAGE', '%%WP_STAGE%%' );
define( 'STAGING_DOMAIN', '%%WP_STAGING_DOMAIN%%' ); // Does magic in WP Stack to handle staging domain rewriting

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
    define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
require_once( ABSPATH . 'wp-settings.php' );
