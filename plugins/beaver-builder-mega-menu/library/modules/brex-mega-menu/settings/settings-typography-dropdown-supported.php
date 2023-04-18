<?php
use JordanLeven\Plugins\BeaversaurusRex as BeaversaurusRex;

$settings = array(
    'typography_dropdown_items' => array(
        'type'  => 'typography',
        'responsive' => true,
        'label' => __('Dropdown items', 'fl-builder'),
        'preview' => array(
            'type'       => 'css',
            'selector'   => '.brex-mega-menu > li.drop-down ul.drop-down-ul > li > a',
        )
    )
);