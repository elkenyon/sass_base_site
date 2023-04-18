<?php
namespace JordanLeven\Plugins\BeaversaurusRex;

/**
 * Function used to register all modules in the modules subdirectory
 *
 * @param  string $module_directory The module directory where all modules are located
 *
 * @return void                  
 */


function register_all_modules( $module_directory ){
    // Check that the directory exists
    if ( file_exists( $module_directory) && get_option("beaversaurus_rex_license_status") === "valid"){ //added by AV
        // Require all files in the directory. Create an iteration
        $module_directory_iterator = new \DirectoryIterator( $module_directory );
        // Loop through the directory. This brings us to each module directory
        foreach ( $module_directory_iterator as $module_directory_file_info ) {
            // If a real file...
            if ( $module_directory_file_info->isDir () ) {
                // Iterate through the module directory
                $individual_module_directory_iterator = new \DirectoryIterator( $module_directory_file_info->getPathname() );
                // Loop through the directory. This brings us to each module directory
                foreach ( $individual_module_directory_iterator as $individual_module_directory_file_info ) {
                    // If a real file and is a PHP file
                    if ( !$individual_module_directory_file_info->isDot() && $individual_module_directory_file_info->getExtension() == 'php' ) {
                        // Require the module
                        require_once( $individual_module_directory_file_info->getPathname() );
                    }
                }
            }
        }
    }
    // If the directory doesn't exist, then throw an error
    else {
        error_log( 'Error! Directory ' . $module_directory . ' does not exist!' );
    }
}

function check_for_plugin_updates($url, $file, $name)
{
	$res = new EDD_SL_Plugin_Updater(
		$url,
		$file,
		array(
			'license_status' => get_option('beaversaurus_rex_license_status'), 'admin_page_url' => admin_url('plugins.php?page=beaverbuildermegamenulicense')
		),
		array(
			'version' => BEAVERSAURUS_REX_PLUGIN_VERSION, 'license' => get_option('beaversaurus_rex_license_key'), 'item_id' => EDD_SL_ITEM_ID,
			'url' => home_url()
		)
	);
}


function update_plugin_description($data)
{
	$name = plugin_basename(BEAVERSAURUS_REX_PLUGIN_FILE);
	$phpv = function_exists('phpversion') ? phpversion() : 0;
	if (function_exists('phpversion') && strnatcmp(phpversion(), BEAVERSAURUS_REX_PLUGIN_MINIMUM_REQUIRED_PHP_VERSION) >= 0) {
		$url = '<a href="/wp-admin/plugins.php?page=beaverbuildermegamenulicense">Activate your License</a> to use Beaver Builder Mega Menu';
	} else {
		$url = 'This plugin requires PHP version ' . BEAVERSAURUS_REX_PLUGIN_MINIMUM_REQUIRED_PHP_VERSION . ' or higher. You are currently on version ' . $phpv . '. Please update your PHP version to use this plugin.';
	}
	if (isset($data[$name]) && $data[$name]['Name']) {
		$data[$name]['Description'] = $url;
	}
	return $data;
}
add_action(
	'init',
	function () {
		if (get_option('beaversaurus_rex_license_status') !== 'valid') {
			add_filter('all_plugins', __NAMESPACE__ . '\\update_plugin_description');
		}
	}
);
