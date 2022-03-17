<?php
/*
    Add custom meta boxes in "page", "post", "dashboard" and "custom_post_type"
    add_meta_box(1, 2, 3, 4, 5, 6);
    1. unique id
    2. title
    3. callback function
    4. page, post, dashboard or custom_post_type_name (screen)
    5. normal, side, advanced(default) (context)
    6. high, core, default or low (priority)
*/

// add meta boxes to page, post and custom_post_type
function meta_boxes_in(){
    add_meta_box("meta_boxes_id", __("Metabox Title", "textdomain"), "meta_boxes_in_function", "page", "normal", "high");
}
// hook
add_action('add_meta_boxes', 'meta_boxes_in');

// add meta boxes to wp_dashborad_setup
function meta_boxes_in_dashboard(){
    add_meta_box("meta_boxes_id_in_dashboard", __("Metabox Title", "textdomain"), "meta_boxes_in_dashboard_function", "dashboard", "normal", "high");
}
// hook
add_action('wp_dashboard_setup', 'meta_boxes_in_dashboard');


/*
    Remove custom meta boxes from page, post, dashboard and custom_post_type
    ## remove_meta_box(1, 2, 3);
    1. remove_id 
    2. dashboard, page, post or custom_post_type (screen)
    3. high, side or advanced (context)

    ## add_action(1, 2)
    1. wp_dashboard_setup, admin_menu 
    2. callback function
*/
function remove_meta_boxes_in(){
    remove_meta_box("remove_id", "dashboard", "side");
}
add_action("wp_dashboard_setup", "remove_meta_boxes_in");
