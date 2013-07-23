<?php
/*
This is a sample local-config.php file
In it, you *must* include the four main database defines

You may include other settings here that you only want enabled on your local development checkouts
*/

define( 'DB_NAME', 'local_db_name' );
define( 'DB_USER', 'local_db_user' );
define( 'DB_PASSWORD', 'local_db_password' );
define( 'DB_HOST', 'localhost' ); // Probably 'localhost'

// =================================================================
// Debugging
// =================================================================

 // Enable WP_DEBUG mode
define( 'WP_DEBUG', true) ;

// Enable Debug logging to the /content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Enable display of errors and warnings 
define( 'WP_DEBUG_DISPLAY', true );
@ini_set( 'display_errors', 1 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );

// Saves the database queries to an array and that array can be displayed to help analyze those queries. 
define( 'SAVEQUERIES', true );