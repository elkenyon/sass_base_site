<?php

use JordanLeven\Plugins\BeaversaurusRex as BeaversaurusRex;

$settings = array(
    'colors_mobile_menu_icon' => array(
        'type'       => 'color',
        'label'      => __( 'Mobile menu icon color', 'fl-builder'),
        'help'       => 'Select the color for the mobile menu icon',
        'show_reset' => true,
        'show_alpha' => true,
        'default'    => '000000'
    ),
    'font_size_mobile_menu_icon' => array(
        'type'    => 'unit',
        'label'   => __( 'Mobile menu icon size', 'fl-builder'),
        'help'    => 'Select the font size for the mobile menu icon',
        'units'   => array( 'px'),
        'default' => 24
    ),
    'text_align_mobile_menu_icon' => array(
        'type'    => 'select',
        'label'   => __( 'Mobile menu icon alignment', 'fl-builder'),
        'default' => 'right',
        'options'   => array(
            'left'   => 'Left',
            'center' => 'Center',
            'right'  => 'Right'
        )
    ),
    'colors_background_mobile_menu_overlay' => array(
        'type'       => 'color',
        'label'      => __( 'Mobile menu overlay color', 'fl-builder'),
        'help'       => 'Select the overlay color for the mobile menu',
        'show_reset' => true,
        'show_alpha' => true,
        'default'    => 'ffffff'
    ),
    'colors_mobile_menu_items' => array(
        'type'       => 'color',
        'label'      => __( 'Mobile menu item color', 'fl-builder'),
        'help'       => 'Select the color for the links in the mobile menu',
        'show_reset' => true,
        'show_alpha' => true,
        'default'    => '000000'
    )
);