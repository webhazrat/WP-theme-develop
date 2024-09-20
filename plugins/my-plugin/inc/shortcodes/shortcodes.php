<?php

/**
 * Basic shortcode
 */

 function mp_basic_sortcode(){
    return 'Hello Shortcode';
 }
 add_shortcode('msg', 'mp_basic_sortcode');


 /**
  * Self-closing shortcode
  */
 function mp_self_closing_shortcode($atts){
    $options = extract(shortcode_atts(array(
        'text' => 'Hi, How are you?'
    ), $atts));
    return '<h1>'.$text.'</h1>';
 }
 add_shortcode('message', 'mp_self_closing_shortcode');

 /**
  * Enclosing shortcode
  */
  function mp_enclosing_shortcode($atts, $content = null){
    $options = extract(shortcode_atts(array(
        'class' => 'new-title'
    ), $atts));
    return '<h1 class="'.$class.'">'.$content.'</h1>';
  }
  add_shortcode('enclosing', 'mp_enclosing_shortcode');

  /**
   * Nested shortcode
   */
function mp_nested_shortcode($atts, $content = null){
    $options = extract(shortcode_atts(array(
        'text' => 'Hi, How are you?'
    ), $atts));
    return '<h1>'.$text.do_shortcode($content).'</h1>';
}
add_shortcode('nested', 'mp_nested_shortcode');

/**
 * Buffering shortcode
 */
function mp_buffering_shortcode($atts){
    $html = '';
    ob_start();
    $options = extract(shortcode_atts(array(
        'text' => 'Hi, How are you?'
    ), $atts));
    ?>

    <h1><?php echo $text; ?></h1>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
add_shortcode('buffer', 'mp_buffering_shortcode');

/**
 * Get post data
 */
function mp_get_posts($atts){
    $options = extract(shortcode_atts(array(
        'per_page' => '4'
    ), $atts));

    $html = '';
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $per_page,
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);

    if($query->have_posts()){
        while($query->have_posts()){
            ob_start();
            $query->the_post();
            ?>
            <h1><?php echo esc_html(get_the_title()); ?></h1>
            <?php
            $html .= ob_get_contents();
            ob_end_clean();
        }

    }else{
        $html .= esc_html_e( 'Sorry, no posts matched your criteria.' );
    }

    return $html;

    wp_reset_postdata();
}
add_shortcode('get_posts', 'mp_get_posts');