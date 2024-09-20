<?php

/**
 * Register movie taxonomy
 */

 function mp_movie_taxonomy(){
    $labels = array(
		'name'              => _x( 'Categories', 'Taxonomy general name', 'mp' ),
		'singular_name'     => _x( 'Category', 'Taxonomy singular name', 'mp' ),
		'search_items'      => __( 'Search Categories', 'mp' ),
		'all_items'         => __( 'All Categories', 'mp' ),
		'parent_item'       => __( 'Parent Category', 'mp' ),
		'parent_item_colon' => __( 'Parent Category:', 'mp' ),
		'edit_item'         => __( 'Edit Category', 'mp' ),
		'update_item'       => __( 'Update Category', 'mp' ),
		'add_new_item'      => __( 'Add New Category', 'mp' ),
		'new_item_name'     => __( 'New Category Name', 'mp' ),
		'menu_name'         => __( 'Categories', 'mp' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
        'show_in_rest'      => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'movie_cat' ),
	);

    register_taxonomy('movie_cat', array('movie'), $args);
 }

 add_action('init', 'mp_movie_taxonomy', 0);