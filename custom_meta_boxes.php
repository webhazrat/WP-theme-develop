<?php
/*
    Add custom meta boxes in "page", "post", "dashboard" and "custom_post_type"
    ## add_meta_box(1, 2, 3, 4, 5, 6);
        1. unique id
        2. title
        3. callback function
        4. page, post, dashboard or custom_post_type_name (screen)
        5. normal, side, advanced(default) (context)
        6. high, core, default or low (priority)
    ## add_action(1, 2)
        1. add_meta_boxes, wp_dashboard_setup (action name)
        2. callback function
*/

// add meta boxes to page, post and custom_post_type
function meta_boxes_in(){
    add_meta_box("meta_boxes_id", __("Metabox Title", "textdomain"), "meta_boxes_in_function", "page", "normal", "high");
}
// hook
add_action('add_meta_boxes', 'meta_boxes_in');

/*
    Callback Function
    ## wp_nonce_field(1, 2)
        1. basename(__FILE__) (action path)
        2. unique name
    ## get_post_meta(1, 2, 3)
        1. post_id
        2. key_name (which will get)
        3. true - single value (if not get value with key) 
*/
function meta_boxes_in_function($post){
    wp_nonce_field(basename(__FILE__), 'wp_nonce_name');
    ?>
        <div>
            <label for="text_field">Text Field</label>
            <?php
                $value = get_post_meta($post->ID, "key_name", true);
            ?>
            <input type="text" name="text_field" value="<?php echo $value; ?>" id="text_field">
        </div>
    <?php
}

/*
    Save post
    ## add_action(1, 2, 3, 4)
        1. save_post (hook action name)
        2. callback function
        3. execution priority
        4. callback function parameters
    ## wp_verify_none(1, 2)
        1. nonce value
        2. basename(__FILE__) (action path)
    ## update_post_meta(1, 2, 3)
        1. post_id
        2. key name
        3. value (which will update)
*/
add_action("save_post", "save_meta_box", 10, 2);
function save_meta_box($post_id, $post){
    // nonce verify
    if(!isset($_POST["wp_nonce_name"]) || !wp_verify_nonce($_POST["wp_nonce_name"], basename(__FILE__))){
        return $post_id;
    }

    // slug verify
    $slug = "post"; //post, page, custom_post_type
    if($slug != $post->post_type){
        return;
    }

    // save data to database
    $text = "";
    if(isset($_POST["text_field"]){
        $text = sanitize_text_field($_POST["text_field"]);
    }else{
        $text = "";
    }
    update_post_meta($post_id, "key_name", $text);
}

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
