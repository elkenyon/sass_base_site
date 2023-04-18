<?php

use JordanLeven\Plugins\BeaversaurusRex as BeaversaurusRex;

/**
 * @class BeaversaurusRexMegaMenu
 */
class BeaversaurusRexMegaMenu extends BeaversaurusRex\BeaversaurusRexFLBuilderModule {

    /**
     * Parent class constructor.
     * @method __construct
     */
    public function __construct(){
        FLBuilderModule::__construct(
            array(
                'name'            => __( 'Mega Menu' ),
                'description'     => __( 'A custom mega menu for the ' . get_bloginfo( 'name' ) . ' site.' ),
                'category'        => __( 'Actions' ),
                'dir'             => $this->getModuleDirectory( __DIR__ ),
                'url'             => plugin_dir_url(__FILE__),
                'editor_export'   => true,
                'enabled'         => true,
                'partial_refresh' => false
            )
        );
    }

    /**
     * Method that we use when handling the typography settings upgrade to Beaver Builder 2.2 (if the native
     * settings aren't already defined.)
     *
     * @param  object $settings The existing settings
     * @param  object $object The object
     *
     * @return object           The returned settings
     */
    public function filter_settings( $settings, $object ) {
        
        
        // Only check for legacy settings if we have a set beaver builder version
        if ( isset( $settings->set_beaver_builder_version ) ){

            // If the supplied version doesn't support typography but the current does, proceed
            if ( !self::supportsTypography( $settings->set_beaver_builder_version ) && self::supportsTypography() ){

                // For the top-level items
                if ( isset( $settings->font_top_level_items['family'] ) && isset( $settings->font_top_level_items['weight'] ) ){
                    $settings->typography_top_level_items                = array();
                    $settings->typography_top_level_items['font_family'] = $settings->font_top_level_items['family'];
                    $settings->typography_top_level_items['font_weight'] = $settings->font_top_level_items['weight'];
                }

                $settings->typography_top_level_items['font_size']                = array();
                $settings->typography_top_level_items['font_size']['length']      = $settings->font_size_top_level_items;
                $settings->typography_top_level_items['font_size']['unit']        = $settings->font_size_top_level_items_unit;

                $settings->typography_top_level_items['line_height']              = array();
                $settings->typography_top_level_items['line_height']['length']    = $settings->line_height_top_level_items;
                $settings->typography_top_level_items['line_height']['unit']      = $settings->line_height_top_level_items_unit;

                $settings->typography_top_level_items['letter_spacing']           = array();
                $settings->typography_top_level_items['letter_spacing']['length'] = $settings->letter_spacing_top_level_items;
                $settings->typography_top_level_items['letter_spacing']['unit']   = 'px';

                // For the dropdown
                if ( isset( $settings->font_dropdown_items['family'] ) && isset( $settings->font_dropdown_items['weight'] ) ){
                    $settings->typography_dropdown_items                = array();
                    $settings->typography_dropdown_items['font_family'] = $settings->font_dropdown_items['family'];
                    $settings->typography_dropdown_items['font_weight'] = $settings->font_dropdown_items['weight'];
                }

                $settings->typography_dropdown_items['font_size']                = array();
                $settings->typography_dropdown_items['font_size']['length']      = $settings->font_size_dropdown_items;
                $settings->typography_dropdown_items['font_size']['unit']        = $settings->font_size_dropdown_items_unit;

                $settings->typography_dropdown_items['line_height']              = array();
                $settings->typography_dropdown_items['line_height']['length']    = $settings->line_height_dropdown_items;
                $settings->typography_dropdown_items['line_height']['unit']      = $settings->line_height_dropdown_items_unit;

                $settings->typography_dropdown_items['letter_spacing']           = array();
                $settings->typography_dropdown_items['letter_spacing']['length'] = $settings->letter_spacing_dropdown_items;
                $settings->typography_dropdown_items['letter_spacing']['unit']   = 'px';

                // For the mobile menu
                if ( isset( $settings->font_mobile_menu['family'] ) && isset( $settings->font_mobile_menu['weight'] ) ){
                    $settings->typography_mobile_menu                = array();
                    $settings->typography_mobile_menu['font_family'] = $settings->font_mobile_menu['family'];
                    $settings->typography_mobile_menu['font_weight'] = $settings->font_mobile_menu['weight'];
                }

                $settings->typography_mobile_menu['font_size']                = array();
                $settings->typography_mobile_menu['font_size']['length']      = $settings->font_size_mobile_menu;
                $settings->typography_mobile_menu['font_size']['unit']        = $settings->font_size_mobile_menu_unit;

                $settings->typography_mobile_menu['line_height']              = array();
                $settings->typography_mobile_menu['line_height']['length']    = $settings->line_height_mobile_menu;
                $settings->typography_mobile_menu['line_height']['unit']      = $settings->line_height_mobile_menu_unit;

                $settings->typography_mobile_menu['letter_spacing']           = array();
                $settings->typography_mobile_menu['letter_spacing']['length'] = $settings->letter_spacing_mobile_menu;
                $settings->typography_mobile_menu['letter_spacing']['unit']   = 'px';

                // Let's not do this every time
                $settings->set_beaver_builder_version = self::getBeaverBuilderVersion();
            }

        }

        
        return $settings;
    }

    public function renderStandardDropdown( $menu_item_name, $wordpress_menu_id, $item, $navigation_item_extra_class ){ //$item added by AV

        // echo '<pre>';  print_r($navigation_item_extra_class);  die;
        if(!empty($navigation_item_extra_class)){
            $topNavClass = "drop-down ".$navigation_item_extra_class;
        }else{
            $topNavClass = "drop-down";
        }
        if ($item->saved_row_top_level_dd != 'Yes') $item->saved_row_top_level_link_url_dd = '#!'; //added by AV
        echo sprintf( 
            '<li class="%s">
            <a %s target="%s" href="%s" class="dd-saved-row-a">%s <i class="%s"></i></a>
            %s
            </li>',
            $topNavClass,
            $item->saved_row_top_level_link_url_dd_nofollow === 'yes' ? 'rel="nofollow"' : '', //added by AV
            $item->saved_row_top_level_link_url_dd_target, //added by AV,
            $item->saved_row_top_level_link_url_dd, //added by Av
            $menu_item_name,
            $this->settings->icon_top_level_mega_menu_dropdown,
            wp_nav_menu( 
                array(
                    'menu'       => $wordpress_menu_id,
                    'menu_class' => 'drop-down-ul',
                    'depth'      => 1,
                    'echo'       => false,
                    'container'  => false
                )
            )
        );
    }

    public function renderMegaMenu( $menu_item_name, $saved_row_id, $item, $top_level = 'No', $top_level_link_url = '#!',$navigation_item_extra_class= '', $saved_row_mega_menu_width = array()  ){ //$item added by AV

        //echo '<pre>';  print_r($item);  die;
        if(!empty($navigation_item_extra_class)){
            $topNavClass = "mega-menu-saved-row ".$navigation_item_extra_class;
        }else{
            $topNavClass = "mega-menu-saved-row";
        }
        $inlineWidthStyle = "";
        if(isset($saved_row_mega_menu_width) && !empty($saved_row_mega_menu_width)){
            if(isset($saved_row_mega_menu_width[0]) && $saved_row_mega_menu_width[0] > 0){
                $inlineWidthStyle = "style='max-width:".$saved_row_mega_menu_width[0].$saved_row_mega_menu_width[1]."';";
            }
        }
        $saved_row = $this->isViewingInEditor() ? "" : do_shortcode('[fl_builder_insert_layout id="'. $saved_row_id. '" type="fl-builder-template"]');
        if ($top_level != 'Yes') $top_level_link_url = '#!';
        echo sprintf( 
            '<li class="%s">
            <a %s target="%s" class="mega-menu-saved-row-a" href="%s">%s <i class="%s"></i></a>
            <div class="mega-menu-saved-row-container" %s>
            %s
            </div>
            </li>',
            $topNavClass,
            $item->saved_row_top_level_link_url_nofollow === 'yes' ? 'rel="nofollow"' : '', //added by AV
            $item->saved_row_top_level_link_url_target, //added by AV
            $top_level_link_url,
            $menu_item_name,
            $this->settings->icon_top_level_mega_menu_dropdown,
            $inlineWidthStyle,
            $saved_row
        );
    }

    public function renderSimpleLink( $menu_item_name, $attrs, $navigation_item_extra_class= '' ){
        $classes = array();
        if ($this->isCurrentPage($attrs['url'])){
            array_push($classes, 'current-menu-item');
        }
        echo sprintf(
            '<li class="%s">
            <a %s class="%s" target="%s" href="%s">%s</a>
            </li>',
            $navigation_item_extra_class,
            $attrs['no_follow'] === 'yes' ? 'rel="nofollow"' : '',
            implode(' ', $classes),
            $attrs['target'],
            $attrs['url'],
            $menu_item_name
        );
    }

    private function isCurrentPage($link){
        $permalink = get_permalink();
        $parsed_url_link = parse_url($link);
        $parsed_url_page = parse_url($permalink);
        return $parsed_url_link['path'] === $parsed_url_page['path'];
    }

    public static function getSettingsFromFile( $filename ){

        include __DIR__ . '/settings/' . $filename;

        return $settings;
    }

    public static function getTypographySettingsFromFile( $args = array() ){
        $filename;
        if ( self::supportsTypography() ){
            $filename = $args['typography_supported'];
        }
        else {
            $filename = $args['typography_unsupported'];
        }
        return self::getSettingsFromFile( $filename );
    }

    public function renderMenuFrontend(){
        echo '<ul class="brex-mega-menu">';
        // Loop theough the menu items
        for ($i=0; $i<count($this->settings->menu_items); $i++){
            // Get the current menu item
            $current_menu_item = $this->settings->menu_items[$i];
            // Get the the type of menu item
            $menu_item_type = $current_menu_item->navigation_item_type;
            // For different types of menus...
            switch( $menu_item_type ){

                // For vanilla dropdowns
                case 'standard_dropdown':
                $this->renderStandardDropdown( 
                    $current_menu_item->navigation_item_name,
                    $current_menu_item->dropdown_items_menu,
                    $current_menu_item, // added by AV
                    $current_menu_item->navigation_item_extra_class
                );
                break;

                // For mega menus
                case 'mega_menu':
                $this->renderMegaMenu( 
                    $current_menu_item->navigation_item_name, 
                    $current_menu_item->saved_row,
                    $current_menu_item, //added by AV
                    $current_menu_item->saved_row_top_level,
                    $current_menu_item->saved_row_top_level_link_url,
                    $current_menu_item->navigation_item_extra_class,
                    array( $current_menu_item->saved_row_mega_menu_width, $current_menu_item->saved_row_mega_menu_width_unit )
                    
                );
                break;

                // For regular links
                case 'simple_link':
                $this->renderSimpleLink( 
                    $current_menu_item->navigation_item_name, 
                    array(
                        'url'       => $current_menu_item->simple_link_url,
                        'no_follow' => $current_menu_item->simple_link_url_nofollow,
                        'target'    => $current_menu_item->simple_link_url_target
                    ),
                    $current_menu_item->navigation_item_extra_class
                );
                break;

                case '':
                break;
                // All unknowns
                default:
                error_log( 'Unknown menu type: ' . $menu_item_type );
                break;
            }
        }
        echo '</ul>';
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
    'BeaversaurusRexMegaMenu', array(
        'general'       => array( 
            'title'       => __( 'General', 'fl-builder' ),
            'sections'    => array(
                'desktop_menu'      => array(
                    'title'       => __( 'Desktop Menu', 'fl-builder' ),
                    'fields'        => array(
                        'menu_items'      => array(
                            'type'         => 'form',
                            'label'        => __('List items', 'fl-builder'),
                            'form'         => 'beaversaurus_mega_menu_item_form',
                            'preview_text' => 'navigation_item_name',
                            'multiple'     => true
                        ),
                        'set_beaver_builder_version'      => array(
                            'type'         => 'text',
                            'label'        => __('Beaver builder version', 'fl-builder'),
                            'default' => BeaversaurusRex\BeaversaurusRexFLBuilderModule::getBeaverBuilderVersion()
                        )
                    )
                )
            )
        ),
        'mobile_menu'       => array( 
            'title'       => __( 'Mobile', 'fl-builder' ),
            'sections'    => array(
                'mobile_general'      => array(
                    'title'       => __( 'General', 'fl-builder' ),
                    'fields'        => array(
                        'mobile_menu_id' => array(
                            'type'    => 'select',
                            'label'   => __('Mobile Menu', 'fl-builder'),
                            'options' => BeaversaurusRex\BeaversaurusRexFLBuilderModule::_getMenus(array(/*'mobile_menu_mega_menu' => 'Use mega menu'*/))
                        ),
                        'mobile_menu_icon' => array(
                            'type'    => 'icon',
                            'label'   => __('Mobile Icon', 'fl-builder'),
                            'default' => 'fas fa-align-justify'
                        )
                    )
                ),
                'mobile_menu_slide_settings'      => array(
                    'title'       => __( 'Slide Settings', 'fl-builder' ),
                    'fields'        => array(
                        'mobile_menu_slide_in_side' => array(
                            'type'    => 'select',
                            'label'   => __('Slide in side', 'fl-builder'),
                            'default' => 'left',
                            'options' => array(
                                'left'  => 'Left',
                                'right' => 'Right',
                                'top' => 'Top'
                            ),
                            'toggle' => array(
                                'left' => array(
                                    'fields' => array(
                                        'mobile_menu_width'
                                    )
                                ),
                                'right' => array(
                                    'fields' => array(
                                        'mobile_menu_width'
                                    )
                                )
                            )
                        ),
                        'mobile_menu_width' => array(
                            'type'       => 'unit',
                            'units'      => array( 'px', '%' ),
                            'label'      => __( 'Mobile menu width', 'fl-builder'),
                            'help'       => 'Set the width of the mobile menu',
                            'default'    => 250
                        ),
                        'mobile_menu_slide_enable_close_icon' => array(
                            'type'    => 'select',
                            'label'   => __('Enable close button', 'fl-builder'),
                            'default' => 'disabled',
                            'options' => array(
                                'enabled'  => 'Enabled',
                                'disabled' => 'Disabled'
                            ),
                            'toggle' => array(
                                'enabled' => array(
                                    'fields' => array(
                                        'mobile_menu_close_icon',
                                        'colors_mobile_menu_close_icon',
                                        'font_size_mobile_menu_close_icon',
                                        'mobile_menu_position_top',
                                        'mobile_menu_position_right'
                                    )
                                )
                            )
                        ),
                        'mobile_menu_close_icon' => array(
                            'type'       => 'icon',
                            'label'      => __( 'Mobile menu close icon', 'fl-builder'),
                            'default'    => 'dashicons dashicons-before dashicons-no-alt'
                        ),
                        'colors_mobile_menu_close_icon' => array(
                            'type'       => 'color',
                            'label'      => __( 'Mobile menu close icon color', 'fl-builder'),
                            'show_reset' => true,
                            'show_alpha' => true,
                            'default'    => '000000'
                        ),
                        'font_size_mobile_menu_close_icon' => array(
                            'type'    => 'unit',
                            'label'   => __( 'Mobile menu close icon size', 'fl-builder'),
                            'units'   => array( 'px'),
                            'default' => 24
                        ),
                        'mobile_menu_position_top' => array(
                            'type'    => 'unit',
                            'label'   => __( 'Mobile menu close icon position (top)', 'fl-builder'),
                            'units'   => array( 'px'),
                            'default' => 20
                        ),
                        'mobile_menu_position_right' => array(
                            'type'    => 'unit',
                            'label'   => __( 'Mobile menu close icon position (right)', 'fl-builder'),
                            'units'   => array( 'px'),
                            'default' => 20
                        ),
                    )
                ) //
            ) //
        ), //
        'style'       => array( //
            'title'       => __( 'Style', 'fl-builder' ),
            'sections'    => array(
                'style_top_level'      => array(
                    'title'         => __( 'Top-level', 'fl-builder' ),
                    'fields'        => BeaversaurusRexMegaMenu::getSettingsFromFile( 'settings-style-top-level.php' )
                ),
                'style_drop_down'      => array(
                    'title'         => __( 'Dropdown Menu', 'fl-builder' ),
                    'fields'        => BeaversaurusRexMegaMenu::getSettingsFromFile( 'settings-style-dropdown.php' )
                ),
                'style_mobile_menu'      => array(
                    'title'         => __( 'Mobile Menu', 'fl-builder' ),
                    'fields'        => BeaversaurusRexMegaMenu::getSettingsFromFile( 'settings-style-mobile.php' )
                )
            )
        ),
        'typography'       => array(
            'title'       => __( 'Typography', 'fl-builder' ),
            'sections'    => array(
                'typography_top_level' => array(
                    'title'         => __( 'Top-level', 'fl-builder' ),
                    'fields' => BeaversaurusRexMegaMenu::getTypographySettingsFromFile( 
                        array(
                            'typography_unsupported' => 'settings-typography-top-level-unsupported.php',
                            'typography_supported'   => 'settings-typography-top-level-supported.php'
                        )
                    )
                ),
                'typography_drop_down'      => array(
                    'title'         => __( 'Dropdown Menu', 'fl-builder' ),
                    'fields' => BeaversaurusRexMegaMenu::getTypographySettingsFromFile( 
                        array(
                            'typography_unsupported' => 'settings-typography-dropdown-unsupported.php',
                            'typography_supported'   => 'settings-typography-dropdown-supported.php'
                        )
                    )
                ),
                'typography_mobile_menu'      => array(
                    'title'         => __( 'Mobile Menu', 'fl-builder' ),
                    'fields' => BeaversaurusRexMegaMenu::getTypographySettingsFromFile( 
                        array(
                            'typography_unsupported' => 'settings-typography-mobile-menu-unsupported.php',
                            'typography_supported'   => 'settings-typography-mobile-menu-supported.php'
                        )
                    )
                )
            )
        )
    )
);

// The form for adding menu items
FLBuilder::register_settings_form(
    'beaversaurus_mega_menu_item_form', 
    array(
        'title' => __('Menu Items', 'fl-builder'),
        'tabs'  => array(
            'general'      => array(
                'title'         => __('General', 'fl-builder'),
                'sections'      => array(
                    'general'       => array(
                        'title'         => '',
                        'fields'        => array(
                            'navigation_item_name' => array(
                                'type'  => 'text',
                                'label' => __('Navigation name', 'fl-builder')
                            ),
                            'navigation_item_type' => array(
                                'type'  => 'select',
                                'label' => __('Navigation type', 'fl-builder'),
                                'help'    => 'Select the type of menu to be used for this navigation item',
                                'options' => array(
                                    'standard_dropdown' => 'Dropdown Menu',
                                    'mega_menu'         => 'MegaMenu',
                                    'simple_link'       => 'Simple Link'
                                ),
                                'toggle' => array(
                                    'standard_dropdown' => array(
                                        'sections' => array(
                                            'nav_section_standard_dropdown'
                                        )
                                    ),
                                    'mega_menu' => array(
                                        'sections' => array(
                                            'nav_section_mega_menu'
                                        )
                                    ),
                                    'simple_link' => array(
                                        'sections' => array(
                                            'nav_section_simple_link'
                                        )
                                    )

                                )
                            ),
                            'navigation_item_extra_class' => array(
                                'type'  => 'text',
                                'label' => __('Class name', 'fl-builder')
                            )
                        )
                    ),
                    'nav_section_standard_dropdown' => array(
                        'title'         => __('Standard Menu', 'fl-builder'),
                        'fields'        => array(
                            'dropdown_items_menu' => array(
                                'type'    => 'select',
                                'label'   => __('Menu', 'fl-builder'),
                                'options' => BeaversaurusRex\BeaversaurusRexFLBuilderModule::_getMenus(),
                                'help'    => 'Select the WordPress menu to use for this dropdown menu'
                            ),
                            'saved_row_top_level_dd' => array(
                                'type'  => 'select',
                                'label' => __('Top-Level Item Link ?', 'fl-builder'),
                                'help'    => '',
                                'options' => array(
                                    'Yes' => 'Yes',
                                    'No'  => 'No'
                                ),
                                'default' => 'No',
                                'toggle' => array(
                                    'Yes' => array(
                                        'fields' => array(
                                            'saved_row_top_level_link_url_dd'
                                        )
                                    )
                                )
                            ),
                            'saved_row_top_level_link_url_dd' => array(
                                'type'  => 'link',
                                'label' => __('', 'fl-builder'),
                                'show_target'   => true,
                                'show_nofollow' => true
                            )
                        )
                    ),
                    'nav_section_mega_menu' => array(
                        'title'         => __('Saved Row', 'fl-builder'),
                        'fields'        => array(
                            'saved_row' => array(
                                'type'  => 'select',
                                'label' => __('Saved row', 'fl-builder'),
                                'options' => BeaversaurusRex\BeaversaurusRexFLBuilderModule::_getSavedRows(),
                                'help'    => 'Select the saved row to be used for this navigation item'
                            ),
                            'saved_row_top_level' => array(
                                'type'  => 'select',
                                'label' => __('Top-Level Item Link ?', 'fl-builder'),
                                'help'    => '',
                                'options' => array(
                                    'Yes' => 'Yes',
                                    'No'  => 'No'
                                ),
                                'default' => 'No',
                                'toggle' => array(
                                    'Yes' => array(
                                        'fields' => array(
                                            'saved_row_top_level_link_url'
                                        )
                                    )
                                )
                            ),
                            'saved_row_top_level_link_url' => array(
                                'type'  => 'link',
                                'label' => __('', 'fl-builder'),
                                'show_target'   => true,
                                'show_nofollow' => true
                            ),
                            'saved_row_mega_menu_width' => array(
                                'type'    => 'unit',
                                'label'   => __( 'Saved Row Width', 'fl-builder'),
                                'units'   => array( 'px','%'),
                                'default' => '',
                                'help'    => 'Enter a max width value here when you want the mega menu to disappear when the user rolls their mouse off of the mega menu to the left or right. Leave blank for 100% full width (then the mega menu will only disappear when the user rolls their mouse above or below).'
                            )
                        )
                    ),
                    'nav_section_simple_link' => array(
                        'title'         => __('Simple Link', 'fl-builder'),
                        'fields'        => array(
                            'simple_link_url' => array(
                                'type'  => 'link',
                                'label' => __('Link URL', 'fl-builder'),
                                'show_target'   => true,
                                'show_nofollow' => true
                            )
                        )
                    )
                )
            )
        )
    ) //
);
