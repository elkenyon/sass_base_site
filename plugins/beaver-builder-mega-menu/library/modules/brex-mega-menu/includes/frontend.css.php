<?php

$top_level_nav_transition_time = $module->getModuleSettingWithUnits( 'transition_time_top_level', 'ms' );
$dropdown_transition_time      = $module->getModuleSettingWithUnits( 'transition_time_dropdown', 'ms' );

$typography_supported_top_level_items = $module->getTypography( 'typography_top_level_items' );
$typography_supported_top_level_items_medium = $module->getTypography( 'typography_top_level_items_medium' ); //added by Av
$typography_supported_top_level_items_responsive = $module->getTypography( 'typography_top_level_items_responsive' ); //added by Av


if ( $module->supportsTypography() && (isset( $typography_supported_top_level_items['font-family'] ) || isset( $typography_supported_top_level_items['font-size'] )) ){ //isset( $typography_supported_top_level_items['font-size'] ) added by AV
    $typography_top_level = $typography_supported_top_level_items;

}
else {
    $typography_top_level = array(
        'font-family'      => $module->getModuleSettingFontFamily( 'font_top_level_items' ),
        'font-size'        => $module->getModuleSettingWithUnits( 'font_size_top_level_items_responsive' ),
        'font-weight'      => $module->getModuleSettingFontWeight( 'font_top_level_items' ),
        'line-height'      => $module->getModuleSettingWithUnits( 'line_height_top_level_items' ),
        'letter-spacing'   => $module->getModuleSettingWithUnits( 'letter_spacing_top_level_items' ),
    );
}

$typography_supported_dropdown_items = $module->getTypography( 'typography_dropdown_items' );
$typography_supported_dropdown_items_medium = $module->getTypography( 'typography_dropdown_items_medium' ); //added by Av

if ( $module->supportsTypography() && isset( $typography_supported_dropdown_items['font-family'] ) ){
    $typography_dropdown = $typography_supported_dropdown_items;

}
else {
    $typography_dropdown = array(
        'font-size'        => $module->getModuleSettingWithUnits( 'font_size_dropdown_items_responsive' ),
        'font-family'      => $module->getModuleSettingFontFamily( 'font_dropdown_items' ),
        'font-weight'      => $module->getModuleSettingFontWeight( 'font_dropdown_items' ),
        'line-height'      => $module->getModuleSettingWithUnits( 'line_height_dropdown_items' ),
        'letter-spacing'   => $module->getModuleSettingWithUnits( 'letter_spacing_dropdown_items' ),
    );
}

$typography_supported_mobile_menu = $module->getTypography( 'typography_mobile_menu' );

if ( $module->supportsTypography() && isset( $typography_supported_mobile_menu['font-family'] ) ){
    $typography_mobile_menu = $typography_supported_mobile_menu;

}
else {
    $typography_mobile_menu = array(
        'font-family'    => $module->getModuleSettingFontFamily( 'font_mobile_menu' ),
        'font-size'      => $module->getModuleSettingWithUnits( 'font_size_mobile_menu' ),
        'font-weight'    => $module->getModuleSettingFontWeight( 'font_mobile_menu' ),
        'line-height'    => $module->getModuleSettingWithUnits( 'line_height_mobile_menu' ),
        'letter-spacing' => $module->getModuleSettingWithUnits( 'letter_spacing_mobile_menu' ),
    );
}

// CSS for everything
$default_module_css = array(
    '.brex-mega-menu-desktop .brex-mega-menu' => array(
        'justify-content' => $settings->alignment_top_level_items,
        '> li' => array(
            '> a' => array_merge(
                array(
                    'padding'          => $module->getModuleSettingDimension( 'padding_top_level', null, 'responsive' ),
                    'background-color' => $module->getModuleSettingColor( 'colors_background_top_level_items_primary' ),
                    'color'            => $module->getModuleSettingColor( 'colors_top_level_items_primary' ),
                    'transition'       => "color {$top_level_nav_transition_time}, background-color {$top_level_nav_transition_time}"
                ),
                $typography_top_level
            ),
            '&:hover > a' => array(
                'color'            => $module->getModuleSettingColor( 'colors_top_level_items_secondary' ),
                'background-color' => $module->getModuleSettingColor( 'colors_background_top_level_items_secondary' )
            ),
            '&.drop-down' => array(
                '.drop-down-ul' => array(
                    '> li > a' => array_merge(
                        array(
                            'padding'          => $module->getModuleSettingDimension( 'padding_dropdown', null, 'responsive' ),
                            'color'            => $module->getModuleSettingColor( 'colors_dropdown_primary' ),
                            'background-color' => $module->getModuleSettingColor( 'colors_background_dropdown_primary' ),
                            'min-width'        => $module->getModuleSettingWithUnits( 'min_width_dropdown' ),
                            'transition'       => "color {$dropdown_transition_time}, background-color {$dropdown_transition_time}",
                            '&:hover' => array(
                                'color'            => $module->getModuleSettingColor( 'colors_dropdown_secondary' ),
                                'background-color' => $module->getModuleSettingColor( 'colors_background_dropdown_secondary' )
                            )
                        ),
                        $typography_dropdown
                    )
                )
            )
        )
    )
);

// Mobile menu styles
$mobile_css = array(
    '.brex-mobile-menu-icon' => array(
        'text-align' => $settings->text_align_mobile_menu_icon,
        'i' => array(
            'color' => $module->getModuleSettingColor( 'colors_mobile_menu_icon' ),
            'font-size' => $module->getModuleSettingWithUnits( 'font_size_mobile_menu_icon' ),
        )
    ),
    '&.brex-mobile-menu-container-node' => array(
        '.brex-mobile-menu-container' => array(
            'background-color' => $module->getModuleSettingColor( 'colors_background_mobile_menu_overlay' ),
            '.close-icon' => array(
                'top'       => $module->getModuleSettingWithUnits( 'mobile_menu_position_top' ),
                'right'     => $module->getModuleSettingWithUnits( 'mobile_menu_position_right' ),
                '> i' => array(
                    'font-size' => $module->getModuleSettingWithUnits( 'font_size_mobile_menu_close_icon' ),
                    'color'     => $module->getModuleSettingColor( 'colors_mobile_menu_close_icon' )
                )
            ),
            '.brex-mobile-menu-inner' => array(
                'li' => array(
                    'a' => array_merge(
                        array(
                            'color' => $module->getModuleSettingColor( 'colors_mobile_menu_items' )
                        ),
                        $typography_mobile_menu
                    )
                )
            )
        )
    )
);
$default_module_css = array_merge($default_module_css, $mobile_css);
$default_module_css['.brex-mega-menu-desktop .brex-mega-menu']['display'] = 'none';

if ( $settings->mobile_menu_slide_in_side === 'left' || $settings->mobile_menu_slide_in_side === 'right' ){
    $default_module_css['&.brex-mobile-menu-container-node']['.brex-mobile-menu-container']['width'] = $module->getModuleSettingWithUnits( 'mobile_menu_width' );
}



// Render the custom CSS
$module->renderModuleCSS( $default_module_css );

// Tablet CSS
 //echo '<pre>';  print_r($settings);  die; 

$tablet_module_css = array(
    '.brex-mega-menu-desktop .brex-mega-menu' => array(
        'display' => 'flex',
        '> li' => array(
            '> a' => array_merge( array(
                'padding'   => $module->getModuleSettingDimension( 'padding_top_level', null, 'medium' ),
                'font-size' => $module->getModuleSettingWithUnits( 'font_size_top_level_items_medium' ),
            ),$typography_supported_top_level_items_medium //added by Av
            ),
            '&.drop-down' => array(
                '.drop-down-ul' => array(
                    '> li > a' => array_merge(array(
                        'font-size' => $module->getModuleSettingWithUnits( 'font_size_dropdown_items_medium' ),
                        'padding'   => $module->getModuleSettingDimension( 'padding_dropdown', null, 'medium' ),
                    ),$typography_supported_dropdown_items_medium)
                )
            )
        )
    ),
    '.brex-mobile-menu-icon' => array(
        'display' => 'none'
    ),
    '.brex-mobile-menu-container' => array(
        'display' => 'none'
    )
);
$module->renderModuleCSSResponsiveTablet( $tablet_module_css );

// Desktop CSS
$desktop_module_css = array(
    '.brex-mega-menu-desktop .brex-mega-menu' => array(
        'display' => 'flex',
        '> li' => array(
            '> a' => array(
                'padding'   => $module->getModuleSettingDimension( 'padding_top_level' ),
                'font-size' => $module->getModuleSettingWithUnits( 'font_size_top_level_items' ),
            ),
            '&.drop-down' => array(
                '.drop-down-ul' => array(
                    '> li > a' => array(
                        'font-size' => $module->getModuleSettingWithUnits( 'font_size_dropdown_items' ),
                        'padding' => $module->getModuleSettingDimension( 'padding_dropdown' ),
                    )
                )
            )
        )
    ),
    '.brex-mobile-menu-icon' => array(
        'display' => 'none'
    ),
    '.brex-mobile-menu-container' => array(
        'display' => 'none'
    )
);

$module->renderModuleCSSResponsiveDesktop( $desktop_module_css );