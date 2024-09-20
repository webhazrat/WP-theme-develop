<?php

/**
 * Register movie post type
 */

 function mp_movie_post_type(){
    $labels = array(
        'name'                  => _x( 'Movies', 'Post type general name', 'mp' ),
		'singular_name'         => _x( 'Movie', 'Post type singular name', 'mp' ),
		'menu_name'             => _x( 'Movies', 'Admin Menu text', 'mp' ),
		'name_admin_bar'        => _x( 'Movie', 'Add New on Toolbar', 'mp' ),
		'add_new'               => __( 'Add New', 'mp' ),
		'add_new_item'          => __( 'Add New', 'mp' ),
		'new_item'              => __( 'New Movie', 'mp' ),
		'edit_item'             => __( 'Edit Movie', 'mp' ),
		'view_item'             => __( 'View Movie', 'mp' ),
		'all_items'             => __( 'All Movies', 'mp' ),
		'search_items'          => __( 'Search Movies', 'mp' ),
		'parent_item_colon'     => __( 'Parent Movies:', 'mp' ),
		'not_found'             => __( 'No movies found.', 'mp' ),
		'not_found_in_trash'    => __( 'No movies found in Trash.', 'mp' ),
		'featured_image'        => _x( 'Movie Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'mp' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'mp' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'mp' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'mp' ),
		'archives'              => _x( 'Movie archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'mp' ),
		'insert_into_item'      => _x( 'Insert into movie', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'mp' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this movie', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'mp' ),
		'filter_items_list'     => _x( 'Filter movies list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'mp' ),
		'items_list_navigation' => _x( 'Movies list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'mp' ),
		'items_list'            => _x( 'Movies list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'mp' ),
	);

    $args = array(
        'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'movie' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
    register_post_type('movie', $args);

 }
 add_action('init', 'mp_movie_post_type');

/**
 * Update movie title placeholder
 */
function mp_update_movie_title_placeholder($title){
    $screen = get_current_screen();
    if('movie' === $screen->post_type){
        $title = 'Add movie name';
    }
    return $title;
}
add_filter('enter_title_here', 'mp_update_movie_title_placeholder');