<?php

# Database Configuration
 define( 'DB_NAME', 'wpengine-network' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASSWORD', '9dhlq5xS' );
    define( 'DB_HOST', 'localhost' ); // Probably 'localhost'
define('DB_HOST_SLAVE','localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';


# Security Salts, Keys, Etc
define('AUTH_KEY',         'c[Eh^G`>4Ou+4yV-E 6LPYob6XCA/}>)Y|~n8yo3Li;nquqiw9tbfMpLE&BkSmkl');
define('SECURE_AUTH_KEY',  'EWQO|o/S~Ul>4Kup5ZN#2mat6G4s1>%`_vDs!{hxvdD?-[Wix*MU-)qqj|JF#>x~');
define('LOGGED_IN_KEY',    'Rh_~4Re4aO/_B/;#P>p`m`/XGL5v1afJ9JDu,OOoW1#&O8P:!4@NmAr9?-wWb|Mt');
define('NONCE_KEY',        'W{q&-44pgItEW|+<|xTBu+&KtBY^+0{+5|[aSTs,P:`pGB}5+I*PV~e~;P(-|8 N');
define('AUTH_SALT',        'k5shaU++V+) UL]u|f ^**~D}ib Q.x0PjCi{rF}J3Nk<?bf5)9!QD69kBa Q/O|');
define('SECURE_AUTH_SALT', 'U]$W @aJM/QJC+qv`ElZ[:VF|ZD7|o]FjwTb[`|r^Q52g~E9Biyas/p_Zh|J?vwr');
define('LOGGED_IN_SALT',   '[r._`e15gg2tlW$]=DL00%JdSv[SAjH$W?-UM_ft^sw<r6Rywcp76jjFx!Y:wX@c');
define('NONCE_SALT',       '%X=E|;>rGy)>X2/2+CUgl/UWxr6SjlT)2LCVGeW]UPU|I6%KJm_|dhKqkej9Q  (');


# Localized Language Stuff

define('WP_CACHE',TRUE);

define('WP_AUTO_UPDATE_CORE',false);

define('PWP_NAME','alaskapacific');

define('FS_METHOD','direct');

define('FS_CHMOD_DIR',0775);

define('FS_CHMOD_FILE',0664);

define('PWP_ROOT_DIR','/nas/wp');

define('WPE_APIKEY','55b0c3786f8da0f6f07008aeb03ff94c68edecde');

define('WPE_FOOTER_HTML',"");

define('WPE_CLUSTER_ID','1932');

define('WPE_CLUSTER_TYPE','pod');

define('WPE_ISP',true);

define('WPE_BPOD',false);

define('WPE_RO_FILESYSTEM',false);

define('WPE_LARGEFS_BUCKET','largefs.wpengine');

define('WPE_CDN_DISABLE_ALLOWED',true);

define('DISALLOW_FILE_EDIT',FALSE);

define('DISALLOW_FILE_MODS',FALSE);

define('DISABLE_WP_CRON',false);

define('WPE_FORCE_SSL_LOGIN',false);

define('FORCE_SSL_LOGIN',false);

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define('WPE_EXTERNAL_URL',false);

define('WP_POST_REVISIONS',FALSE);

define('WPE_WHITELABEL','wpengine');

define('WP_TURN_OFF_ADMIN_BAR',false);

define('WPE_BETA_TESTER',false);

umask(0002);

$wpe_cdn_uris=array ();

$wpe_no_cdn_uris=array ();

$wpe_content_regexs=array ();

$wpe_all_domains=array (  0 => 'alaskapacific.edu',  1 => 'alaskapacific.wpengine.com',  2 => 'www.alaskapacific.edu',);

$wpe_varnish_servers=array (  0 => 'pod-1932',);

$wpe_ec_servers=array ();

$wpe_largefs=array ();

$wpe_netdna_domains=array ();

$wpe_netdna_push_domains=array ();

$wpe_domain_mappings=array ();

$memcached_servers=array (  'default' =>   array (    0 => 'unix:///tmp/memcached.sock',  ),);
define('WPLANG','');

# WP Engine ID


# WP Engine Settings


define('ADMIN_COOKIE_PATH', '/');

define('COOKIE_DOMAIN', '');

define('COOKIEPATH', '');

define('SITECOOKIEPATH', '');




define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
$base = '/';
define( 'DOMAIN_CURRENT_SITE', 'local.alaskapacific.edu' );
define( 'PATH_CURRENT_SITE','/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );


# That's It. Pencils down
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
