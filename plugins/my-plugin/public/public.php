<?php

/**
 * Init styles and scripts
 */
function mp_public_styles_scripts(){
    wp_enqueue_style('mp-public-css', MYPLUGIN_URL . 'public/css/public.css', '', rand());

    wp_enqueue_script('mp-public-script', MYPLUGIN_URL . 'public/js/public.js', array('jquery'), rand(), true);
}
add_action('wp_enqueue_scripts', 'mp_public_styles_scripts');