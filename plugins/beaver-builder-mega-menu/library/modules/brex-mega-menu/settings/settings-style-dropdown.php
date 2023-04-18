<?php
use JordanLeven\Plugins\BeaversaurusRex as BeaversaurusRex;

$settings = array(
    'colors_dropdown_primary' => array(
        'type'       => 'color',
        'label'      => __( 'Color', 'fl-builder'),
        'help'       => 'Select the color for the dropdown items',
        'show_reset' => true,
        'show_alpha' => true,
        'default'    => '000000',
        'preview'    => array(
            'type'       => 'css',
            'selector'   => '.brex-mega-menu > li.drop-down ul.drop-down-ul > li > a',
            'property'   => 'color',
        )
    ),
    'colors_dropdown_secondary' => array(
        'type'       => 'color',
        'label'      => __( 'Color (hover)', 'fl-builder'),
        'help'       => 'Select the hover color for the dropdown items',
        'show_reset' => true,
        'show_alpha' => true
    ),
    'colors_background_dropdown_primary' => array(
        'type'       => 'color',
        'label'      => __( 'Background color', 'fl-builder'),
        'help'       => 'Select the background color for the dropdown items',
        'show_reset' => true,
        'show_alpha' => true,
        'default'    => 'ffffff',
        'preview'    => array(
            'type'       => 'css',
            'selector'   => '.brex-mega-menu > li.drop-down ul.drop-down-ul > li > a',
            'property'   => 'background-color',
        )
    ),
    'colors_background_dropdown_secondary' => array(
        'type'  => 'color',
        'label' => __( 'Background color (hover)', 'fl-builder'),
        'help'  => 'Select the background hover color for the navigation items',
        'show_reset' => true,
        'show_alpha' => true
    ),
    'padding_dropdown' => array(
        'type'       => 'dimension',
        'label'      => __( 'Padding', 'fl-builder'),
        'help'       => 'Select the padding for the dropdown navigation items',
        'responsive' => true,
        'units'      => array( 'px' ),
        'preview'    => array(
            'type'       => 'css',
            'selector'   => '.brex-mega-menu > li.drop-down ul.drop-down-ul > li > a',
            'property'   => 'padding',
        ),
        'default' => 10
    ),
    'min_width_dropdown' => array(
        'type'    => 'unit',
        'label'   => __('Dropdown min width', 'fl-builder'),
        'units'   => array( 'px'),
        'default' => 200,
        'preview' => array(
            'type'     => 'css',
            'selector'   => '.brex-mega-menu > li.drop-down ul.drop-down-ul > li > a',
            'property' => 'min-width',
            'unit'     => 'px'
        )
    ),
    'transition_time_dropdown' => array(
        'type'        => 'unit',
        'label'       => __( 'Transition time', 'fl-builder'),
        'help'        => 'Select the transition time for dropdown navigation items (0 for no transition)',
        'description' => 'ms',
    )
);