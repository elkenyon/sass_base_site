<?php
use JordanLeven\Plugins\BeaversaurusRex as BeaversaurusRex;

$settings =array(
    'font_mobile_menu' => array(
        'type'  => 'font',
        'label' => __('Font', 'fl-builder'),
        'help'  => 'Select the font for the mobile menu items'
    ),
    'font_size_mobile_menu' => array(
        'type'       => 'unit',
        'label'      => __('Font size', 'fl-builder'),
        'help'       => 'Select the font size for the mobile menu items',
        'units'      => array( 'px', 'em', 'rem')
    ),
    'line_height_mobile_menu' => array(
        'type'       => 'unit',
        'label'      => __('Line-height', 'fl-builder'),
        'help'       => 'Select the line height for the mobile menu items',
        'units'      => array( 'px', 'em', 'rem'),
    ),
    'letter_spacing_mobile_menu' => array(
        'type'       => 'unit',
        'label'      => __('Letter spacing', 'fl-builder'),
        'help'       => 'Select the letter-spacing for the mobile menu items',
        'units'      => array( 'px' )
    )
);