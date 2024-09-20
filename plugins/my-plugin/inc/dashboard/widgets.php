<?php

/**
 * Dashboard widget
 */
function mp_movie_dashboard_widget(){
    wp_add_dashboard_widget(
        'mp_movie_widget',
        'Movie At a Glance',
        'mp_movie_widget_callback',
    );
}
add_action('wp_dashboard_setup', 'mp_movie_dashboard_widget');


/**
 * Widget callback
 */
function mp_movie_widget_callback(){
    $query = new WP_Query(array('post_type' => 'movie'));
    $count = wp_count_posts('movie');
    ?>
    <div class="main">
        <ul>
            <li class="post-count">Total: <a href="<?php echo admin_url('/edit.php?post_type=movie'); ?>"><?php echo $query->post_count; ?> Movies</a></li>
            <li class="post-publish">Publish: <a href="<?php echo admin_url('/edit.php?post_status=publish&post_type=movie'); ?>"><?php echo $count->publish; ?> Movies</a></li>
            <li class="post-draft">Draft: <a href="<?php echo admin_url('/edit.php?post_status=draft&post_type=movie'); ?>"><?php echo $count->draft; ?> Movie</a></li>
        </ul>
    </div>
    <?php
}