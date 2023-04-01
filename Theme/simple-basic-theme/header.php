<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo("charset"); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php bloginfo("title"); ?></title>        

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="<?php bloginfo('home'); ?>">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse gap-3" id="navbarSupportedContent">
                    <?php 
                        wp_nav_menu(array(
                            "theme_location" => "theme_primary_menu",
                            "container" => false,
                            "items_wrap" => '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">%3$s</ul>'
                        ));
                    ?>

                    <?php if(class_exists("WooCommerce")) : ?>
                    <?php if(is_user_logged_in()) : ?>
                        <a href="<?php echo get_permalink(get_option("woocommerce_myaccount_page_id")); ?>">My Account</a>
                        
                        <a href="<?php echo wp_logout_url(get_permalink(get_option("woocommerce_myaccount_page_id"))); ?>">Logout</a>
                    <?php else: ?>
                        <a href="<?php echo get_permalink(get_option("woocommerce_myaccount_page_id")); ?>">Login/Register</a>
                    <?php endif; ?>

                    <a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>" class="btn btn-primary position-relative">
                        Cart
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-items-count">
                            <?php echo WC()->cart->get_cart_contents_count(); ?>
                        </span>
                    </a>
                    <?php endif; ?>

                </div>
            </div>
        </nav>
        