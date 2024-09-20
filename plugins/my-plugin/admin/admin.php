<?php

/**
 * Init styles and scripts
 */
function mp_admin_styles_scripts(){
    wp_enqueue_style('mp-admin-css', MYPLUGIN_URL . 'admin/css/admin.css', '', rand());

    wp_register_script('mp-file-upload-script', MYPLUGIN_URL . 'admin/js/file-uploader.js', array('jquery'), rand(), true);
    wp_enqueue_script('mp-admin-script', MYPLUGIN_URL . 'admin/js/admin.js', array('jquery'), rand(), true);
}
add_action('admin_enqueue_scripts', 'mp_admin_styles_scripts');