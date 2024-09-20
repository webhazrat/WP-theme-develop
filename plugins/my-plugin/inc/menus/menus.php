<?php

/**
 * Custom admin menu
 */

 function mp_custom_admin_menu(){
    add_menu_page(
        __('Custom Menu', 'mp'),
        __('Custom Menu', 'mp'),
        'manage_options',
        'custom-menu',
        'mp_custom_sub_menu_callback_template',
        '',
        40
    );
    add_submenu_page(
        'custom-menu',
        __('Custom Sub Menu', 'mp'),
        __('Custom Sub Menu', 'mp'),
        'manage_options',
        'custom-menu',
        'mp_custom_sub_menu_callback_template'
    );

    add_submenu_page(
        'custom-menu',
        __('Custom Sub Menu 2', 'mp'),
        __('Custom Sub Menu 2', 'mp'),
        'manage_options',
        'custom-submenu',
        'mp_custom_sub_menu_callback_template2'
    );

    add_submenu_page(
        'tools.php',
        __('Custom Sub Menu 2', 'mp'),
        __('Custom Sub Menu 2', 'mp'),
        'manage_options',
        'custom-tools-menu',
        'mp_custom_sub_menu_callback_template2'
    );

    // custom link page
    add_submenu_page(
        'admin.php',
        __('Custom Sub Menu 2', 'mp'),
        __('Custom Sub Menu 2', 'mp'),
        'manage_options',
        'custom-link',
        'mp_custom_link_callback_template'
    );

 }
 add_action('admin_menu', 'mp_custom_admin_menu');

/**
 * Custom submenu callback template
 */
function mp_custom_sub_menu_callback_template(){
    ?>
    <h2>Custom Submenu Page</h2>
    <?php
}

 /**
 * Custom submenu callback template 2
 */
function mp_custom_sub_menu_callback_template2(){
    ?>
    <h2>Custom Submenu 2 Page</h2>
    <a href="<?php echo admin_url('/admin.php?page=custom-link'); ?>">Custom Link</a>
    <?php
}

/**
 * Custom link callback template
 */
function mp_custom_link_callback_template(){
    ?>
    <h2>Custom Link Page</h2>
    <?php
}


/**
 * Add custom menus into admin bar
 */
function mp_custom_admin_bar_menu($admin_bar){
    $admin_bar->add_menu(array(
        'id' => 'my-item',
        'title' => 'My Item',
        'href' => '#',
        'meta' => array(
            'title' => 'My Title'
        )
    ));
    $admin_bar->add_menu(array(
        'id' => 'my-sub-item',
        'parent' => 'my-item',
        'title' => 'My Sub Item',
        'href' => '#',
        'meta' => array(
            'title' => 'My Title',
            'target' => '_blank',
            'class' => 'my-custom-class'
        )
    ));
}
add_action('admin_bar_menu', 'mp_custom_admin_bar_menu', 100);