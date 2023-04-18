<?php
namespace JordanLeven\Plugins\BeaversaurusRex;
if (!defined('ABSPATH')) {
	die;
}

class EDD_SL_Plugin_Updater
{
	private $api_url = '';
	private $api_data = array();
	private $name = '';
	private $slug = '';
	private $version = '';
	private $license_status = '';
	private $admin_page_url = '';
	private $purchase_url = '';
	private $plugin_title = '';

	public function __construct($url, $name, $settings, $data = null)
	{	
	
		
		$this->api_url = trailingslashit($url);
		$this->api_data = $data;
		$this->name = plugin_basename($name);
		$this->slug = basename($name, '.php');
		$this->version = $data['version'];
		if (is_array($settings) and isset($settings['license_status'], $settings['admin_page_url'], $settings['purchase_url'], $settings['plugin_title'])) {
			$this->license_status = $settings['license_status'];
			$this->admin_page_url = $settings['admin_page_url'];
			$this->purchase_url = $settings['purchase_url'];
			$this->plugin_title = $settings['plugin_title'];
		}
		$this->init();
		add_action('admin_init', array($this, 'show_changelog'));
	}

	public function init()
	{	
		
		add_filter('pre_set_site_transient_update_plugins', array($this, 'check_update'));
		add_filter('plugins_api', array($this, 'plugins_api_filter'), 10, 3);
		remove_action('after_plugin_row_' . $this->name, 'wp_plugin_update_row', 10, 2);
		add_action('after_plugin_row_' . $this->name, array($this, 'show_update_notification'), 10, 2);
		
        if ('valid' != $this->license_status and $this->admin_page_url) {
			add_action('admin_init', array($this, 'remove_plugin_update_message'), 99);
		}
	}

	public function remove_plugin_update_message()
	{
		remove_action('after_plugin_row_' . $this->name, 'wp_plugin_update_row', 10, 2);
	}
	public function check_update($version)
	{	
		
		
		global $pagenow;
		if (!is_object($version)) {
			$version = new \stdClass();
		}
		if ('plugins.php' == $pagenow && is_multisite()) {
			return $version;
		}

		//echo '<pre>->';  print_r($version);  
		
		if (empty($version->response) || empty($version->response[$this->name])) {
			$existing_trans = $this->send('plugin_latest_version', array('slug' => $this->slug));
			
			//echo '<pre>';  print_r($existing_trans);  die;
			
			if (false !== $existing_trans && is_object($existing_trans) && isset($existing_trans->new_version)) {
				if (version_compare($this->version, $existing_trans->new_version, '<')) {
					$version->response[$this->name] = $existing_trans;
				}
				$version->last_checked = time();
				$version->checked[$this->name] = $this->version;
			}
		}

		//echo '<pre>';  print_r($version);  die;
		
		return $version;
	}
	public function show_update_notification($name, $data)
	{
		if (!current_user_can('update_plugins')) {
			return;
		}
		if (!$this->admin_page_url and !is_multisite()) {
			return;
		}
		if ($this->name != $name) {
			return;
		}
		remove_filter('pre_set_site_transient_update_plugins', array($this, 'check_update'), 10);
		$transcient = get_site_transient('update_plugins');
		$transcient = is_object($transcient) ? $transcient : new \stdClass();
		if (empty($transcient->response) || empty($transcient->response[$this->name])) {
			$key = md5('edd_plugin_' . sanitize_key($this->name) . '_version_info');
			$existing_trans = get_transient($key);
			if (false === $existing_trans) {
				$existing_trans = $this->send('plugin_latest_version', array('slug' => $this->slug));
				set_transient($key, $existing_trans, 3600);
			}
			if (!is_object($existing_trans)) {
				return;
			}
			if (version_compare($this->version, $existing_trans->new_version, '<')) {
				$transcient->response[$this->name] = $existing_trans;
			}
			$transcient->last_checked = time();
			$transcient->checked[$this->name] = $this->version;
			set_site_transient('update_plugins', $transcient);
		} else {
			$existing_trans = $transcient->response[$this->name];
		}
		
        add_filter('pre_set_site_transient_update_plugins', array($this, 'check_update'));
		
        if (!empty($transcient->response[$this->name]) && version_compare($this->version, $existing_trans->new_version, '<')) {
			$table = _get_list_table('WP_Plugins_List_Table');
			echo '<tr class="plugin-update-tr"><td colspan="' . $table->get_column_count() . '" class="plugin-update colspanchange"><div class="update-message">';
			$url = self_admin_url(
				'index.php?edd_sl_action=view_plugin_changelog&plugin=' . $this->name . '&slug=' . $this->slug . '&TB_iframe=true&width=772&height=911'
			);
			if (!$this->admin_page_url || 'valid' == $this->license_status) {
				if (empty($existing_trans->download_link)) {
					printf(
						__(
							'There is a new version of %1$s available. <a target="_blank" class="thickbox" href="%2$s">View version %3$s details</a>.',
							'edd'
						),
						esc_html($existing_trans->name),
						esc_url($url),
						esc_html($existing_trans->new_version)
					);
				} else {
					printf(
						__(
							'There is a new version of %1$s available. <a target="_blank" class="thickbox" href="%2$s">View version %3$s details</a> or <a href="%4$s">update now</a>.',
							'edd'
						),
						esc_html($existing_trans->name),
						esc_url($url),
						esc_html($existing_trans->new_version),
						esc_url(
							wp_nonce_url(self_admin_url('update.php?action=upgrade-plugin&plugin=') . $this->name, 'upgrade-plugin_' . $this->name)
						)
					);
				}
			} else {
				printf(
					__('%sActivate%s your copy of %s to receive automatic upgrades and support.  Need a license key?  %sPurchase one now%s'),
					'<a href="' . $this->admin_page_url . '">',
					'</a>',
					$this->plugin_title,
					'<a href="' . $this->purchase_url . '">',
					'</a>'
				);
			}
			echo '</div></td></tr>';
		}
	}

	public function plugins_api_filter($data, $plugin_info = '', $object = null)
	{
		
		
		if ($plugin_info != 'plugin_information') {
			return $data;
		}
		if (!isset($object->slug) || $object->slug != $this->slug) {
			return $data;
		}
		$body = array('slug' => $this->slug, 'is_ssl' => is_ssl(), 'fields' => array('banners' => false, 'reviews' => false));
		$res = $this->send('plugin_information', $body);

		
		
		if (false !== $res) {
			$data = $res;
		}
		return $data;
	}

	public function http_request_args($data, $url)
	{
		if (strpos($url, 'https://') !== false && strpos($url, 'edd_action=package_download')) {
			$data['sslverify'] = false;
		}
		return $data;
	}

	private function send($plugin_info, $data)
	{

		
		global $spe0a0c4;
		$data = array_merge($this->api_data, $data);
		if ($data['slug'] != $this->slug) {
			return;
		}
		if ($this->api_url == home_url()) {
			return false;
		}
		$body = array(
			'edd_action' => 'get_version', 'license' => !empty($data['license']) ? $data['license'] : '', 'item_name' => isset($data['item_name']) ? $data['item_name'] : false, 'item_id' => isset($data['item_id']) ? $data['item_id'] : false, 'slug' => isset($data['slug']) ? $data['slug'] : false, 'author' => isset($data['author']) ? $data['author'] : false, 'url' => home_url()
		);
		$res = wp_remote_post($this->api_url, array('timeout' => 15, 'sslverify' => false, 'body' => $body));
		if (!is_wp_error($res)) {
			$res = json_decode(wp_remote_retrieve_body($res));
		}
		if ($res && isset($res->sections)) {
			$res->sections = maybe_unserialize($res->sections);
		} else {
			$res = false;
		}
		return $res;
	}

	public function show_changelog()
	{
		if (empty($_REQUEST['edd_sl_action']) || 'view_plugin_changelog' != $_REQUEST['edd_sl_action']) {
			return;
		}
		if (empty($_REQUEST['plugin'])) {
			return;
		}
		if (empty($_REQUEST['slug'])) {
			return;
		}
		if (!current_user_can('update_plugins')) {
			wp_die(__('You do not have permission to install plugin updates', 'edd'), __('Error', 'edd'), array('response' => 403));
		}
		$res = $this->send('plugin_latest_version', array('slug' => $_REQUEST['slug']));
		if ($res && isset($res->sections['changelog'])) {
			echo '<div style="background:#fff;padding:10px;">' . $res->sections['changelog'] . '</div>';
		}
		die;
	}
}
