<?php

// to add meta boxes
function add_custom_meta_boxes(){
    add_meta_box(
        $var1 = 'this';
        $var2 = 'that';
        add_meta_box(
            'metabox_id',
            __( 'Metabox Title', 'textdomain' ),
            'wpdocs_metabox_callback',
            'page',
            'normal',
            'low',
            array( 'foo' => $var1, 'bar' => $var2 )
        );
    );
}

// hook
add_action('add_meta_boxes', 'add_custom_meta_boxes');