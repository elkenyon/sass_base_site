<?php

/*
Plugin Name: Beaver Builder Mega Menu
Plugin URI: https://bbmegamenu.com
Description: Beaver Builder Mega Menu is modular element for creating Mega Menus on your site made with Beaver Builder.
Version: 1.4.4
Author: https://bbmegamenu.com
Author URI: https://bbmegamenu.com
Contributors: 
*/

define( 'EDD_SL_STORE_URL', 'https://bbmegamenu.com' );

define( 'EDD_SL_ITEM_ID', 25 );

define( 'BEAVERSAURUS_REX_PLUGIN_VERSION', '1.4.4' );

define( 'BEAVERSAURUS_REX_PLUGIN_MINIMUM_REQUIRED_PHP_VERSION', '5.6.0' );

define( 'BEAVERSAURUS_REX_PLUGIN_FILE', __FILE__ );

define( 'WP_OPTION_BEAVERSAURUS_REX_LICENSE_KEY', 'beaversaurus_rex_license_key');

define( 'WP_OPTION_BEAVERSAURUS_REX_LICENSE_STATUS', 'beaversaurus_rex_license_status');

define( 'WP_OPTION_BEAVERSAURUS_REX_LICENSE_EXPIRES_AT', 'beaversaurus_rex_license_expires_at'); //added by AV

defined( 'ABSPATH' ) or die( 'Nope :-D' );

require_once plugin_dir_path( __FILE__ ) . '/library/classes/class-edd-sl-plugin-updater.php';

// Include the main functions file class
require_once plugin_dir_path( __FILE__ ) . '/library/functions/functions.php';

function register_brex_modules(){
    // If the main BB class exists
    if ( class_exists( 'FLBuilder' ) ) {
        if ( function_exists( 'phpversion' ) && strnatcmp( phpversion(), BEAVERSAURUS_REX_PLUGIN_MINIMUM_REQUIRED_PHP_VERSION ) >= 0 ){
            // Include the vendor directory
            require_once plugin_dir_path( __FILE__ ) . '/library/vendor/autoload.php';
            // The licenser
            require_once plugin_dir_path( __FILE__ ) . '/library/functions/edd-license-page.php';
            // Include the BeaversaurusFLBuilderModule class
            require_once plugin_dir_path( __FILE__ ) . '/library/classes/class-brex-fl-builder-module.php';
            // Register all modules
            JordanLeven\Plugins\BeaversaurusRex\register_all_modules( plugin_dir_path( __FILE__ ) . 'library/modules/' );
            if ( defined( 'EDD_SL_STORE_URL' ) ){
                // And, for good measure, check for updates
                JordanLeven\Plugins\BeaversaurusRex\check_for_plugin_updates( EDD_SL_STORE_URL, __FILE__, basename(__DIR__) );
            }
        }
        else if ( function_exists( 'phpversion' )) {
            error_log( "Error in " . __FILE__ . ": Upsupported version of PHP(" . phpversion(). ")!" );
        }
        else {
            error_log( "Error in " . __FILE__ . ": Function phpversion doesn't exist!" );
        }
    }
    else {
        error_log( "Error in " . __FILE__ . ": FLBuilder does not exist!" );
    }
}

// Init the modules
add_action( 'init', 'register_brex_modules', 15 ); 
