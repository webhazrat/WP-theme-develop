<?php

function simple_basic_theme_load_scripts(){

    wp_enqueue_style("bootstrap", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css", array(), "5.2.3", "all");

    wp_enqueue_style("theme", get_template_directory_uri()."/assets/css/theme.css", array(), "1.0", "all");

    wp_enqueue_style("style", get_stylesheet_uri(), array(), "1.0", "all");


    wp_enqueue_script("bootstrap", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js", array("jquery"), "5.2.3", true);
    wp_enqueue_script("theme", get_template_directory_uri()."/assets/js/script.js", array("jquery"), "1.0", true);
}
add_action("wp_enqueue_scripts", "simple_basic_theme_load_scripts");


function simple_basic_theme_nav_config(){

    register_nav_menus(array(
        "theme_primary_menu" => "Primary Menu SBT",
        "theme_footer_menu" => "Footer Menu SBT",
        "theme_sidebar_menu" => "Sidebar Menu SBT"
    ));

    add_theme_support("post-thumbnails");

    // woocommerce support
    add_theme_support("woocommerce", array(
        "product_grid" => array(
            "default_columns" => 10,
            "min_columns" => 2,
            "max_columns" => 3
        )
    ));

    // custom logo
    add_theme_support('custom-logo');

    // product thumbnail effect support
    add_theme_support("wc-product-gallery-zoom");
    add_theme_support("wc-product-gallery-lightbox");
    add_theme_support("wc-product-gallery-slider");
}
add_action("after_setup_theme", "simple_basic_theme_nav_config");


function simple_basic_theme_add_li_class($classes, $item, $args){
    $classes[] = "nav-item";
    return $classes;
}
add_filter("nav_menu_css_class", "simple_basic_theme_add_li_class", 1, 3);

function simple_basic_theme_add_anchor_class($classes, $item, $args){
    $classes['class'] = "nav-link";
    return $classes;
}
add_filter("nav_menu_link_attributes", "simple_basic_theme_add_anchor_class", 1, 3);

// woocommerce hooks
// add_action("woocommerce_after_shop_loop_item_title", "the_excerpt");

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-items-count">
        <?php echo $woocommerce->cart->cart_contents_count; ?>
    </span>
	<?php
	$fragments['span.cart-items-count'] = ob_get_clean();
	return $fragments;
}
