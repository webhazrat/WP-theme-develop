<?php

/**
 * Extends WP_Widget
 */

class MP_Movie_Widget extends WP_Widget {
    public function __construct(){
        parent::__construct(
            'mp_movie_widget',
            'Recent Movies',
            array(
                'classname' => 'mp-movie-widget',
                'description' => 'Widget for recent movies list'
            )
        );
    }

    public function widget($args, $instance){
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if(!empty($title)){
            echo $before_title . $title . $after_title;
        }
        $query = new WP_Query(array('post_type' => 'movie', 'post_status' => 'publish', 'posts_per_page' => $instance['limit']));
        if($query->have_posts()){ 
            ?>
            <ul>
                <?php 
                    while($query->have_posts()) {
                        $query->the_post();
                        ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php
                    }
                ?>
            </ul>
            <?php
        }
       
        echo $after_widget;
    }

    public function form($instance){
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $limit = !empty($instance['limit']) ? $instance['limit'] : 5;
        ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title', 'mp'); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php esc_attr_e('Number of movies to show', 'mp'); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" value="<?php echo esc_attr($limit); ?>">
            </p>
        <?php
    }

    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = !empty($new_instance['limit']) ? intval($new_instance['limit']) : 5;

        return $instance;
    }
}

/**
 * Register widget
 */
function mp_register_widgets(){
    register_widget('MP_Movie_Widget');
}
add_action('widgets_init', 'mp_register_widgets');
