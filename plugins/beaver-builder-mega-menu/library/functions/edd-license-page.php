<?php
namespace JordanLeven\Plugins\BeaversaurusRex; 
define('EDD_SAMPLE_PLUGIN_LICENSE_PAGE', 'beaverbuildermegamenulicense'); 

function edd_sample_license_menu() { 
	add_plugins_page('BB Mega Menu License', 'BB Mega Menu License', 'manage_options', EDD_SAMPLE_PLUGIN_LICENSE_PAGE, __NAMESPACE__ . '\\edd_sample_license_page'); 
	
} 

function edd_expire_admin_notice__error(  ) { //added by AV

	$expires = get_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_EXPIRES_AT); 
	$current_time = current_time( 'timestamp' );
	$current_time_plus_one_month = strtotime($current_time.' +1 month');
	if(!empty($expires) && strtotime($expires) <= $current_time){
		$class = 'notice notice-error';
		$date = date_i18n(get_option('date_format'), strtotime($expires, current_time('timestamp')));
		$message = __( sprintf( 'IMPORTANT: Your BB Mega Menu license has expired on %s. Please <a href="%s">renew ASAP</a> to ensure continued functionality.', $date, 'https://bbmegamenu.com/your-account/'), '' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), ( $message ) );
	}
	
	//$current_time = strtotime(" +1 month", $current_time); //for testing only
	//echo "Current Time: ".date('Y-m-d H:i:s', $current_time).' Grace Period:'.date('Y-m-d H:i:s', strtotime($expires." +1 month")).'<br>';//for testing only

	if(!empty($expires) && strtotime($expires." +1 month") <= $current_time){
		update_option("beaversaurus_rex_license_status", 'invalid');
	}
	
}

//Add first time the licence expire time if not exists in DB
function edd__check_license() { //added by AV

	$expires = get_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_EXPIRES_AT); 
	
	if(!empty($expires)){
		return;
	}
	
	$store_url = EDD_SL_STORE_URL;
	
	$license = get_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_KEY);
	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_id' => EDD_SL_ITEM_ID,
		'url' => home_url()
	);
	$response = wp_remote_post( $store_url, array( 'body' => $api_params, 'timeout' => 15, 'sslverify' => false ) );
  	if ( is_wp_error( $response ) ) {
		return false;
  	}

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	/* echo '<pre>';  
	print_r($api_params);
	
	print_r($license_data);  die; */
	
	if(!empty($license_data->expires) || strtotime($license_data->expires) != strtotime($expires)){
		update_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_EXPIRES_AT, ($response->expires));
	}
}

function edd_sample_license_page() { 
    
    $licence_key = get_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_KEY); 
    $status = get_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_STATUS); 
    ?>
    <div class="wrap">
        <h2><?php  _e('Plugin License Options'); ?>
</h2>
        <?php  if (isset($_GET['sl_activation']) && $_GET['sl_activation'] === 'false' && isset($_REQUEST['message'])) { echo sprintf('<div class="notice notice-error"><p>Error activating: %s</p></div>', $_REQUEST['message']); } ?>
        <form method="post" action="options.php">

            <?php  settings_fields('edd_sample_license'); ?>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                            <?php  _e('License Key'); ?>
                        </th>
                        <td>
                            <input id="beaversaurus_rex_license_key" name="beaversaurus_rex_license_key" type="text" class="regular-text" value="<?php  esc_attr_e($licence_key); ?>
" />
                            <label class="description" for="beaversaurus_rex_license_key"><?php  _e('Enter your license key'); ?>
</label>
                        </td>
                    </tr>
                    <?php  if (false !== $licence_key) { ?>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php  _e('Activate License'); ?>
                            </th>
                            <td>
                                <?php  if ($status !== false && $status == 'valid') { ?>
                                    <span style="color:green;"><?php  _e('active'); ?>
</span>
                                    <?php  wp_nonce_field('beaversaurus_rex_noonce', 'beaversaurus_rex_noonce'); ?>
                                    <input type="submit" class="button-secondary" name="beaversaurus_rex_edd_license_deactivate" value="<?php  _e('Deactivate License'); ?>
"/>
                                <?php  } else { wp_nonce_field('beaversaurus_rex_noonce', 'beaversaurus_rex_noonce'); ?>
                                    <input type="submit" class="button-secondary" name="beaversaurus_rex_edd_license_activate" value="<?php  _e('Activate License'); ?>
"/>
                                <?php  } ?>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
            <?php  submit_button(); ?>

        </form>
        <?php  } 
        
        
function edd_sample_register_option()
{
	register_setting('edd_sample_license', 'beaversaurus_rex_license_key', 'edd_sanitize_license');
}

function edd_sanitize_license($existing_key)
{
	$key = get_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_KEY);
	if ($key && $key != $existing_key) {
		delete_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_STATUS);
	}
	return $existing_key;
}

function edd_sample_activate_license()
{
	if (isset($_POST['beaversaurus_rex_edd_license_deactivate'])) {
		delete_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_KEY);
		delete_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_STATUS);
	} else {
		if (isset($_POST['beaversaurus_rex_edd_license_activate'])) {
			if (!check_admin_referer('beaversaurus_rex_noonce', 'beaversaurus_rex_noonce')) {
				return;
			}
			$licence_key = trim(get_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_KEY));
			$data = array('edd_action' => 'activate_license', 'license' => $licence_key, 'item_id' => EDD_SL_ITEM_ID, 'url' => home_url());
			$res = wp_remote_post(EDD_SL_STORE_URL, array('timeout' => 15, 'sslverify' => false, 'body' => $data));
			if (is_wp_error($res) || 200 !== wp_remote_retrieve_response_code($res)) {
				$message = is_wp_error($res) && !empty($res->get_error_message()) ? $res->get_error_message() : __('An error occurred, please try again.');
			} else {
				$response = json_decode(wp_remote_retrieve_body($res));

				//echo '<pre>';  print_r($response);  die;
				
				if (false === $response->success) {
					switch ($response->error) {
						case 'expired':
							$message = sprintf(
								__('Your license key expired on %s.'),
								date_i18n(get_option('date_format'), strtotime($response->expires, current_time('timestamp')))
							);
							break;

						case 'revoked':
							$message = __('Your license key has been disabled.');
							break;

						case 'missing':
							$message = __('Invalid license.');
							break;

						case 'invalid':
						case 'site_inactive':
							$message = __('Your license is not active for this URL.');
							break;

						case 'item_name_mismatch':
							$message = sprintf(__('This appears to be an invalid license key for %s.'), EDD_SL_ITEM_ID);
							break;

						case 'no_activations_left':
							$message = __('Your license key has reached its activation limit.');
							break;

						default:
							$message = __('An error occurred, please try again.');
							break;
					}
				}
			}
			if (!empty($message)) {
				$url = admin_url('plugins.php?page=' . EDD_SAMPLE_PLUGIN_LICENSE_PAGE);
				$url = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $url);
				wp_redirect($url);
				die;
			}

			
			update_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_STATUS, $response->license);
			update_option(WP_OPTION_BEAVERSAURUS_REX_LICENSE_EXPIRES_AT, ( $response->expires == 'lifetime' ? date('Y-m-d H:i:s', strtotime("+ 50 years")) : $response->expires ) ); //added by AV
			wp_redirect(admin_url('plugins.php?page=' . EDD_SAMPLE_PLUGIN_LICENSE_PAGE));
			die;
		}
	}
}
add_action('admin_init', __NAMESPACE__ . '\\edd_sample_activate_license');
add_action('admin_init', __NAMESPACE__ . '\\edd_sample_register_option');
add_action('admin_menu', __NAMESPACE__ . '\\edd_sample_license_menu');
add_action( 'admin_notices',  __NAMESPACE__ . '\\edd_expire_admin_notice__error' ); //added by AV
add_action('admin_init', __NAMESPACE__ . '\\edd__check_license');

