<?php
namespace JordanLeven\Plugins\BeaversaurusRex;

class BeaversaurusRexFLBuilderModule extends \FLBuilderModule
{
	const POST_TYPE_SAVED_BUILDER_ITEM = 'fl-builder-template';
	const TAXONOMY_SAVED_BUILDER_ITEM_TYPE = 'fl-builder-template-type';
	const TERM_SAVED_BUILDER_ITEM_TYPE_MODULE = 'module';
	const TERM_SAVED_BUILDER_ITEM_TYPE_ROW = 'row';
	const RENDER_MODULE_CSS_SELECTORS = array('.', '#', '&', '>');
	const RENDER_MODULE_CSS_HTML_TAGS = array(
		'div', 'a', 'p', 'span', 'ul', 'li', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'table', 'thead', 'tbody', 'tr', 'td', 'th',
		'dl', 'dd', 'dt', 'img', 'i'
	);
	const FL_LAYOUT_POST_TYPE = 'fl-theme-layout';
	public static function _getMenus($all_menus = array())
	{
		$menus = get_terms('nav_menu');
		$menus = array_combine(wp_list_pluck($menus, 'term_id'), wp_list_pluck($menus, 'name'));
		if (count($menus) < 1) {
			$menus['na'] = 'No menus available!';
		}
		return $menus + $all_menus;
	}

	public static function getBeaverBuilderVersion()
	{
		return defined('FL_BUILDER_VERSION') ? FL_BUILDER_VERSION : '1.0.0';
	}

	public static function supportsTypography($version = null)
	{
		$version = $version ? $version : self::getBeaverBuilderVersion();
		return version_compare($version, '2.2', '>=');
	}
	
	public static function _getSavedModules()
	{
		$return_array = array();
		$args = array(
			'post_type' => self::POST_TYPE_SAVED_BUILDER_ITEM, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'asc', 'tax_query' => array(
				array(
					'taxonomy' => self::TAXONOMY_SAVED_BUILDER_ITEM_TYPE, 'field' => 'slug', 'terms' => self::TERM_SAVED_BUILDER_ITEM_TYPE_MODULE
				)
			)
		);
		$query = new \WP_Query($args);
		$saved_modules = $query->posts;
		for ($i = 0; $i < count($saved_modules); $i++) {
			$current_saved_module = $saved_modules[$i];
			$return_array[$current_saved_module->ID] = $current_saved_module->post_title;
		}
		return $return_array;
	}
	public static function _getSavedRows()
	{
		$return_array = array();
		$args = array(
			'post_type' => self::POST_TYPE_SAVED_BUILDER_ITEM, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'asc', 'tax_query' => array(
				array(
					'taxonomy' => self::TAXONOMY_SAVED_BUILDER_ITEM_TYPE, 'field' => 'slug', 'terms' => self::TERM_SAVED_BUILDER_ITEM_TYPE_ROW
				)
			)
		);
		$query = new \WP_Query($args);
		$saved_modules = $query->posts;
		for ($i = 0; $i < count($saved_modules); $i++) {
			$current_saved_module = $saved_modules[$i];
			$return_array[$current_saved_module->ID] = $current_saved_module->post_title;
		}
		return $return_array;
	}

	protected function getModuleDirectory($module_directory)
	{
		return $module_directory . '/';
	}
	
	public function isViewingAsThemerLayout()
	{
		return get_post_type(get_the_ID()) === self::FL_LAYOUT_POST_TYPE;
	}

	public function isViewingInEditor()
	{
		return is_user_logged_in() && strpos($_SERVER['REQUEST_URI'], '?fl_builder') !== false;
	}

	/* public function getModuleSettingWithUnits($spa8a781, $spd6a9f7 = false)
	{
		$sp7faf6c = $spa8a781 . '_unit';
		if (isset($this->settings->{$sp7faf6c})) {
			$spd6a9f7 = $this->settings->{$sp7faf6c};
		} else {
			if (!$spd6a9f7) {
				$spd6a9f7 = 'px';
			}
		}
		return isset($this->settings->{$spa8a781}) && $this->settings->{$spa8a781} ? "{$this->settings->{$spa8a781}}{$spd6a9f7}" : null;
	} */

	/**
     * Method to return a value from an array of settings from a custom module.
     *
     * @param  string $key          The key to look for in the settings
     * @param  string $unit         The unit
     *
     * @return string | null        Either the value suffixed with the unit or null
     */

	/* public function getModuleTypographyWithUnits( $key,$type, $sub_key = '' ){ //added by AV
		if(!empty($this->settings->$key) && is_array($this->settings->$key)){

			if(isset($this->settings->$key[$type]) && is_array($this->settings->$key[$type])){
				
				return implode("", $this->settings->$key[$type]);
			}elseif(!empty($this->settings->$key[$type])){
				return ($this->settings->$key[$type]);
			}
		}
		return null;
	} */

	public function getModuleSettingWithUnits( $key, $unit = false ){
        // Check for custom unit

		/* 
		Start: Default Top Level Padding on Tablet: Added by AV
		*/
		if($key === 'padding_top_level_top_medium' || $key === 'padding_top_level_right_medium' || $key === 'padding_top_level_left_medium' || $key === 'padding_top_level_bottom_medium'){

			
			if(empty($this->settings->$key)){
				$this->settings->$key = 10;
			}
			//echo '<pre>';  print_r($this->settings);  die;
		}
		/* 
		End: Default Top Level Padding on Tablet: Added by AV
		*/
		 
        $custom_unit_name = $key . '_unit';
        if ( isset($this->settings->$custom_unit_name) ){
            $unit = $this->settings->$custom_unit_name;
        }
        else if ( !$unit ){
            $unit = 'px';
        }

        return isset( $this->settings->$key ) && $this->settings->$key ? "{$this->settings->$key}$unit" : null;
    }


	/* public function getModuleSettingColor($spa8a781, $sp1d0959 = null)
	{
		if (isset($this->settings->{$spa8a781}) && $this->settings->{$spa8a781} && !is_array($this->settings->{$spa8a781}) && !$sp1d0959) {
			$sp76257b = ctype_xdigit($this->settings->{$spa8a781}) ? '#' : '';
			return "{$sp76257b}{$this->settings->{$spa8a781}}";
		}
		if (isset($this->settings->{$spa8a781[$sp1d0959]}) && $this->settings->{$spa8a781[$sp1d0959]} && is_array($this->settings->{$spa8a781}) && $sp1d0959) {
			$sp76257b = ctype_xdigit($this->settings->{$spa8a781[$sp1d0959]}) ? '#' : '';
			return "{$sp76257b}{$this->settings->{$spa8a781[$sp1d0959]}}";
		} else {
			return null;
		}
	} */

	 /**
     * Method to return a color from an array of settings from a custom module.
     *
     * @param  string $key      The key to look for in the settings
     * @param  string $option      The option color (for pp-color types)
     *
     * @return string | null           Either the color prefixed with a hex or null
     */
    public function getModuleSettingColor( $key, $option = null ){
        // First, check if we have the value for when we're looking for the normal value of the object (no option)
        if ( isset( $this->settings->$key ) && $this->settings->$key && !is_array($this->settings->$key) && !$option){
            // Check if this is a hex value
            $hex_hash = ctype_xdigit($this->settings->$key) ? '#' : '';
            // Return the value
            return "$hex_hash{$this->settings->$key}";
        }
        // Otherwise, if we're looking for a specific option
        if ( isset( $this->settings->$key[$option] ) && $this->settings->$key[$option] && is_array($this->settings->$key) && $option){
            // Check if this is a hex value
            $hex_hash = ctype_xdigit($this->settings->$key[$option]) ? '#' : '';
            // Return the value
            return "$hex_hash{$this->settings->$key[$option]}";
        }
        // Otherwise, we have nothing
        else {
            return null;
        }
    }

	public function getTypography(string $typography)
	{
		$return_array = array();
		if (class_exists('FLBuilderCSS') && method_exists('FLBuilderCSS', 'typography_field_props')) {
			$return_array = \FLBuilderCSS::typography_field_props($this->settings->{$typography});
		} else {
			$return_array = array();
		}
		return $return_array;
	}

	/* public function getModuleSettingDimension($spa8a781, $spd6a9f7 = 'px', $spba4ecb = false)
	{
		if ($spba4ecb) {
			$sp7faf6c = $spa8a781 . '_' . $spba4ecb . '_unit';
		} else {
			$sp7faf6c = $spa8a781 . '_unit';
		}
		if (isset($this->settings->{$sp7faf6c})) {
			$spd6a9f7 = $this->settings->{$sp7faf6c};
		}
		if ($spba4ecb) {
			$sp0bedb7 = $spa8a781 . '_top' . '_' . $spba4ecb;
			$spd971a2 = $spa8a781 . '_right' . '_' . $spba4ecb;
			$sp2d0ac2 = $spa8a781 . '_bottom' . '_' . $spba4ecb;
			$spe8cfcc = $spa8a781 . '_left' . '_' . $spba4ecb;
		} else {
			$sp0bedb7 = $spa8a781 . '_top';
			$spd971a2 = $spa8a781 . '_right';
			$sp2d0ac2 = $spa8a781 . '_bottom';
			$spe8cfcc = $spa8a781 . '_left';
		}
		$spa261e0 = array();
		array_push($spa261e0, $this->getModuleSettingWithUnits($sp0bedb7, $spd6a9f7));
		array_push($spa261e0, $this->getModuleSettingWithUnits($spd971a2, $spd6a9f7));
		array_push($spa261e0, $this->getModuleSettingWithUnits($sp2d0ac2, $spd6a9f7));
		array_push($spa261e0, $this->getModuleSettingWithUnits($spe8cfcc, $spd6a9f7));
		if (count(array_filter($spa261e0)) > 0) {
			$spa261e0 = array_map(function ($spd37204) { return is_null($spd37204) ? 0 : $spd37204; }, $spa261e0);
			return implode(' ', $spa261e0);
		} else {
			return null;
		}
	} */

	public function getModuleSettingDimension( $key, $unit = 'px', $type = false ){

		/* if($key != 'padding_top_level'){ //for testing only by AV
			return null;
		}
		$type = 'medium'; */
		
        if ( $type ){
            $custom_unit_name = $key . '_' . $type . '_unit';
        }
        else {
            $custom_unit_name = $key . '_unit';
        }
        if ( isset($this->settings->$custom_unit_name) ){
            $unit = $this->settings->$custom_unit_name;
        }
        if ( $type ){
            $top_dimension    = $key . '_top' . '_' . $type;
            $right_dimension  = $key . '_right' . '_' . $type;
            $bottom_dimension = $key . '_bottom' . '_' . $type;
            $left_dimension   = $key . '_left' . '_' . $type;
        }
        else {
            $top_dimension    = $key . '_top';
            $right_dimension  = $key . '_right';
            $bottom_dimension = $key . '_bottom';
            $left_dimension   = $key . '_left';
        }

		 /* echo $unit.'//'.$top_dimension; 
		echo '<pre>';  print_r($this->getModuleSettingWithUnits( $top_dimension, 'px' ));  die;
		
		die;  */
        // Declare our dimension array
        $dimension_array = array();
        // Add our top dimension
        array_push($dimension_array, $this->getModuleSettingWithUnits( $top_dimension, $unit ) );
        // Add our right dimension
        array_push($dimension_array, $this->getModuleSettingWithUnits( $right_dimension, $unit ) );
        // Add our bottom dimension
        array_push($dimension_array, $this->getModuleSettingWithUnits( $bottom_dimension, $unit ) );
        // Add our left dimension
        array_push($dimension_array, $this->getModuleSettingWithUnits( $left_dimension, $unit ) );
		
        // Only return dimensions if they're non-null
        if ( count( array_filter( $dimension_array ) ) > 0 ){
            // If the array value is null, replace with a zero so we can still
            // use the full dimension
            $dimension_array = array_map( function($v) {
                return ( is_null($v) ) ? 0 : $v;
            }, $dimension_array );
            // Return the string
            return implode(' ', $dimension_array);
        }
        else {
            return null;
        }
        
    }


	/**
     * Method to return a font family from an array of settings from a custom module.
     *
     * @param  string $key          The key to look for in the settings
     *
     * @return string | null       
     */
    public function getModuleSettingFontFamily( $key ){
		if(!isset($this->settings->$key)){
			return null;
		}
        $setting = $this->settings->$key;
        return isset( $setting['family'] ) && $setting['family'] ? $setting['family'] : null;
    }


	/**
     * Method to return a font weight from an array of settings from a custom module.
     *
     * @param  string $key          The key to look for in the settings
     *
     * @return string | null       
     */
    public function getModuleSettingFontWeight( $key ){
        
		if(!isset($this->settings->$key)){
			return null;
		}
		$setting = $this->settings->$key;
        return isset( $setting['weight'] ) && $setting['weight']? $setting['weight'] : null;
    }

	public function renderModuleCSSResponsiveMobile( $custom_css = array(), $echo = true, $debug = false ){
        $global_settings = \FLBuilderModel::get_global_settings();
        $this->renderModuleCSSResponsive( 
            array(
                'max' => $global_settings->responsive_breakpoint - 1
            ), 
            $custom_css, 
            $echo, 
            $debug 
        );
    }


	public function renderModuleCSSResponsiveTablet( $custom_css = array(), $echo = true, $debug = false ){
        $global_settings = \FLBuilderModel::get_global_settings();
        $this->renderModuleCSSResponsive( 
            array(
                'min' => $global_settings->responsive_breakpoint - 1,
                'max' => $global_settings->medium_breakpoint - 1
            ), 
            $custom_css, 
            $echo, 
            $debug 
        );
    }

	public function renderModuleCSSResponsiveDesktop( $custom_css = array(), $echo = true, $debug = false  ){
        $global_settings = \FLBuilderModel::get_global_settings();
        $this->renderModuleCSSResponsive( 
            array(
                'min' => $global_settings->medium_breakpoint
            ), 
            $custom_css, 
            $echo, 
            $debug 
        );
    }


	public function renderModuleCSSResponsive( $responsive_dimensions, $custom_css = array(), $echo = true, $debug = false ){
        // Get the minimum width
        $min_width = isset( $responsive_dimensions['min'] ) ? $responsive_dimensions['min'] : null;        
        // Get the maximum width
        $max_width = isset( $responsive_dimensions['max'] ) ? $responsive_dimensions['max'] : null;     
        // Create our media query argument array
        $media_query_array = array();
        // If we have a min width, add that to the array
        if ( isset( $responsive_dimensions['min'] ) ){
            array_push($media_query_array, "(min-width: " . $responsive_dimensions['min'] . "px)");
        }
         // If we have a max width, add that to the array
        if ( isset( $responsive_dimensions['max'] ) ){
            array_push($media_query_array, "(max-width: " . $responsive_dimensions['max'] . "px)");
        }
        // Create a string we can use
        $media_query_string = implode(' and ', $media_query_array);
        // Declare our indent
        $indent = $debug ? '    ' : '';
        // Declare our seperator
        $seperator = $debug ? '<br>' : '';
        // Declare our return string
        $return_string = '@media screen and ' . $media_query_string . '{' . $seperator;
        // Render the CSS
        $return_string .=  $indent . $this->renderModuleCSS( $custom_css, 0, $debug );
        // Add the closing bracket for the query
        $return_string .= $seperator . "}";

        // If we want to echo the return string.
        if ($echo){
            echo $return_string;
        }
        // Otherwise return the string
        else {
            return $return_string;
        }

        if ($debug){
            echo "</pre>";
            die;
        }
    }


	/**
     * Method to render the custom CSS for the module
     *
     * @param  array  $custom_css The custom CSS
     *
     * @return void
     */
    public function renderModuleCSS( $custom_css = array(), $echo = true, $debug = false ){
        // Get the ID for this element
        $element_id = $this->node;
        if ( $echo ){
            // Render the CSS
            self::_renderCustomCSS( $element_id, $custom_css, $echo, $debug );
        }
        else {
            // Return the CSS
            return self::_renderCustomCSS( $element_id, $custom_css, $echo, $debug );
        }
    }


	/**
    * Function to render the custom CSS for the module
    *
    * @param  array  $custom_css [description]
    *
    * @return void
    */
    public static function _renderCustomCSS( $element_id, $custom_css = array(), $echo = true, $debug = false ){
        // Don't do anyhing if the array is empty
        if ( count($custom_css) < 1){
            return;
        }
        // Create a new RecursiveIteratorIterator object
        $custom_css_iterator = new \RecursiveIteratorIterator( new \RecursiveArrayIterator($custom_css) );
        // Create the array we'll store info in
        $custom_css_formatted = array();
        // Run through each of the CSS properties
        foreach ($custom_css_iterator as $property_name => $property_value) {
            // Don't both doing anything if the property is null
            if ( !$property_value ){
                continue;
            }
            // Our multiple property array
            $multiple_value_property = false;
            // Start by getting the selector we're working with
            $selector = array();
            // Find all ancestral keys
            for ( $i=0; $i<$custom_css_iterator->getDepth(); $i++ ) {
                // Get the parent selector
                $parent_selector = $custom_css_iterator->getSubIterator($i)->key();
                // Get the first character of the selector
                $parent_selector_first_char = $parent_selector[0];
                // If the selector is a valid CSS selector (in the RENDER_MODULE_CSS_SELECTORS array) then
                // add to the selector array
                if ( in_array($parent_selector_first_char, self::RENDER_MODULE_CSS_SELECTORS) || in_array($parent_selector, self::RENDER_MODULE_CSS_HTML_TAGS)){
                    // Add the parent selector to the selector array
                    array_push($selector, $parent_selector);
                }
                // Otherwise, we must be working with a property that has multiple values
                else {
                    // This is a multiple value property
                    $multiple_value_property = $parent_selector;
                }
            }
            // Turn the selector into a string
            $selector = implode(' ', $selector);
            // Replace apersands
            $selector = str_replace(" &", "", $selector);
            // If the selector isn't already in the array
            if ( !array_key_exists($selector, $custom_css_formatted) ){
                // Add the selector
                $custom_css_formatted[$selector] = array();
            }
            // If this is a vanilla k/v property
            if ( !$multiple_value_property ){
                // Add the property and property value. Use array push to add support for properties with multiple
                // values
                $custom_css_formatted[$selector][$property_name] = $property_value;
            }
            // Otherwise this is a multiple value property
            else {
                // Make sure we have an array at this property
                if ( !is_array($custom_css_formatted[$selector][$multiple_value_property]) ){
                    $custom_css_formatted[$selector][$multiple_value_property] = array();
                }
                // Add the multiple value to this property
                array_push($custom_css_formatted[$selector][$multiple_value_property], $property_value);
            }
        }
        // Declare our return string
        $return_string = '';
        // Declare our seperator
        $seperator = $debug ? '<br>' : '';
        // Declare our indent
        $indent = $debug ? '    ' : '';
        // Loop through the formatted array
        foreach ($custom_css_formatted as $selector => $properties) {
            // Create the selector and node
            $selector_and_node = ".fl-node-$element_id $selector";
            // Replace ampersands
            $selector_and_node = str_replace(" &", "", $selector_and_node);
            // Start the selector
            $return_string .= "$selector_and_node {" . $seperator;
            $property_node = isset( $properties[$i] ) ? $properties[$i] : null;
            foreach ($properties as $property_key => $property_value) {
                // If the property value is not an array, this this property can be echoed
                if ( !is_array($property_value) ){
                    $return_string .= "$indent$property_key: $property_value;$seperator";
                }
                // Otherwise, we have more than one property value we need to echo
                else {
                    // Loop through keys
                    foreach ($property_value as $property_multiple_value) {
                        $return_string .= "$indent$property_key: $property_multiple_value;$seperator";
                    }
                }
            }
            // End the selector
            $return_string .=  "}$seperator$seperator";
        }
        if ($debug){
            echo "<pre>";
        }

        // If we want to echo the return string.
        if ($echo){
            echo $return_string;
        }
        // Otherwise return the string
        else {
            return $return_string;
        }

        if ($debug){
            echo "</pre>";
            die;
        }
    }
}
