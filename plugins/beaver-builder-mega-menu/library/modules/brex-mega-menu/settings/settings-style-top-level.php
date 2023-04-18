<?php
use JordanLeven\Plugins\BeaversaurusRex as BeaversaurusRex;

$settings = array(
    'alignment_top_level_items' => array(
        'type'       => 'select',
        'label'      => __( 'Alignment', 'fl-builder'),
        'help'       => 'Select the alignment for the top-level navigation items',
        'options' => array(
            'flex-start' => 'Left',
            'center'     => 'Center',
            'flex-end'   => 'Right'
        ),
        'preview' => array(
            'type'       => 'css',
            'selector'   => '.brex-mega-menu',
            'property'   => 'justify-content',
        )
    ),
    'icon_top_level_mega_menu_dropdown' => array(
        'type'       => 'icon',
        'label'      => __( 'Dropdown/MegaMenu Icon', 'fl-builder'),
        'help'       => 'Select an icon to be positioned next to the dropdown and mega menu',
        'preview' => array(
            'type'       => 'css',
            'selector'   => '.brex-mega-menu',
            'property'   => 'text-align',
        )
    ),
    'colors_top_level_items_primary' => array(
        'type'       => 'color',
        'label'      => __( 'Color', 'fl-builder'),
        'help'       => 'Select the color for the top-level navigation items',
        'show_reset' => true,
        'show_alpha' => true,
        'preview' => array(
            'type'       => 'css',
            'selector'   => '.brex-mega-menu > li > a',
            'property'   => 'color',
        )
    ),
    'colors_top_level_items_secondary' => array(
        'type'       => 'color',
        'label'      => __( 'Color (hover)', 'fl-builder'),
        'help'       => 'Select the hover color for the top-level navigation items',
        'show_reset' => true,
        'show_alpha' => true
    ),
    'colors_background_top_level_items_primary' => array(
        'type'       => 'color',
        'label'      => __( 'Background color', 'fl-builder'),
        'help'       => 'Select the background color for the top-level navigation items',
        'show_reset' => true,
        'show_alpha' => true,
        'preview' => array(
            'type'       => 'css',
            'selector'   => '.brex-mega-menu > li > a',
            'property'   => 'background-color',
        )
    ),
    'colors_background_top_level_items_secondary' => array(
        'type'       => 'color',
        'label'      => __( 'Background color (hover)', 'fl-builder'),
        'help'       => 'Select the hover background color for the top-level navigation items',
        'show_reset' => true,
        'show_alpha' => true
    ),
    'padding_top_level' => array(
        'type'       => 'dimension',
        'label'      => __( 'Padding', 'fl-builder'),
        'help'       => 'Select the padding for the top-level navigation items',
        'responsive' => array(
            'medium' => 32
        ),
        'top_medium' => 30,
        'padding_top_level_top_medium' => 24,
        'units'      => array( 'px' ),
        'preview'    => array(
            'type'       => 'css',
            'selector'   => '.brex-mega-menu > li > a',
            'property'   => 'padding',
        ),
        'default'       => 20
    ),
    
    'transition_time_top_level' => array(
        'type'        => 'unit',
        'label'       => __( 'Transition time', 'fl-builder'),
        'help'        => 'Select the transition time for top-level navigation items (0 for no transition)',
        'description' => 'ms',
    )
);