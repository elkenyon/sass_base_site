<?php
use JordanLeven\Plugins\BeaversaurusRex as BeaversaurusRex;

$settings = array(
    'font_dropdown_items' => array(
        'type'  => 'font',
        'label' => __('Font', 'fl-builder'),
        'help'  => 'Select the font for the dropdown items',
        'preview' => array(
            'type'       => 'css',
            'selector'   => '.brex-mega-menu > li.drop-down ul.drop-down-ul > li > a',
            'property'   => 'font-family'
        )
    ),
    'font_size_dropdown_items' => array(
        'type'       => 'unit',
        'label'      => __('Font size', 'fl-builder'),
        'help'       => 'Select the font size for the navigation items',
        'units'      => array( 'px', 'em', 'rem'),
        'preview' => array(
            'type'     => 'css',
            'selector'   => '.brex-mega-menu > li.drop-down ul.drop-down-ul > li > a',
            'property' => 'font-size',
        )
    ),
    'line_height_dropdown_items' => array(
        'type'       => 'unit',
        'label'      => __('Line height', 'fl-builder'),
        'help'       => 'Select the line height for the navigation items',
        'units'      => array( 'px', 'em', 'rem'),
        'preview' => array(
            'type'     => 'css',
            'selector'   => '.brex-mega-menu > li.drop-down ul.drop-down-ul > li > a',
            'property' => 'line-height',
        )
    ),
    'letter_spacing_dropdown_items' => array(
        'type'       => 'unit',
        'label'      => __('Letter spacing', 'fl-builder'),
        'help'       => 'Select the letter spacing for the navigation items',
        'units'      => array( 'px' ),
        'preview' => array(
            'type'     => 'css',
            'selector'   => '.brex-mega-menu > li.drop-down ul.drop-down-ul > li > a',
            'property' => 'letter-spacing',
        )
    )
);