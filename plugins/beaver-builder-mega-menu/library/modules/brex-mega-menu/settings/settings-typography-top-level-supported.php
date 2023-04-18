<?php
use JordanLeven\Plugins\BeaversaurusRex as BeaversaurusRex;

$settings = array(
    'typography_top_level_items' => array(
        'type'  => 'typography',
        'responsive' => true,
        'label' => __('Top Level Items', 'fl-builder'),
        'preview' => array(
            'type'     => 'css',
            'selector' => '.brex-mega-menu > li > a',
        )
    )
);