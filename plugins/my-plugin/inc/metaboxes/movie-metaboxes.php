<?php 

/**
 * Metabox
 */

 function mp_add_movie_metaboxes(){
    add_meta_box(
        'mp_movie_metabox_id', 
        'Movie Options', 
        'mp_movie_metaboxes_template', 
        'movie'
    );
 }
 add_action('add_meta_boxes', 'mp_add_movie_metaboxes');

 /**
  * Metabox Template
  */

  function mp_movie_metaboxes_template($post){
    $teasure_url = get_post_meta($post->ID, '_mp_movie_teasure_url', true);
    $release_year = get_post_meta($post->ID, '_mp_movie_release_year', true);
    $actors = get_post_meta($post->ID, '_mp_movie_actors', true);
    $video_type = get_post_meta($post->ID, '_mp_movie_video_type', true);
    $is_featured = get_post_meta($post->ID, '_mp_movie_is_featured', true);
    ?>
    <table>
        <tr>
            <td>Teasure URL:</td>
            <td><input type="text" class="regular-text" name="mp_movie_teasure_url" value="<?php echo $teasure_url; ?>" /></td>
        </tr>
        <tr>
            <td>Release Year:</td>
            <td><input type="text" class="regular-text" name="mp_movie_release_year" value="<?php echo $release_year; ?>" /></td>
        </tr>
        <tr>
            <td>Actors:</td>
            <td><textarea type="text" class="large-text" name="mp_movie_actors" rows="4"><?php echo $actors; ?></textarea></td>
        </tr>
        <tr>
            <td>Video Type:</td>
            <td>
                <select name="mp_movie_video_type" class="regular-text">
                    <option value="">Select One</option>
                    <option value="HD" <?php selected('HD', $video_type); ?>>HD</option>
                    <option value="SD" <?php selected('SD', $video_type); ?>>SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Is Featured:</td>
            <td>
                <input type="checkbox" name="mp_movie_is_featured" class="regular-text" value="1" <?php checked(1, $is_featured); ?> />
            </td>
        </tr>
    </table>
    <?php
  }


/**
 * Save metabox values
 */

 function mp_save_movie_metaboxes($post_id){
    if(isset($_POST["mp_movie_teasure_url"])){
        update_post_meta($post_id, '_mp_movie_teasure_url', esc_url_raw($_POST["mp_movie_teasure_url"]));
    }
    if(isset($_POST["mp_movie_release_year"])){
        update_post_meta($post_id, '_mp_movie_release_year', sanitize_text_field($_POST["mp_movie_release_year"]));
    }
    if(isset($_POST["mp_movie_actors"])){
        update_post_meta($post_id, '_mp_movie_actors', sanitize_textarea_field($_POST["mp_movie_actors"]));
    }
    if(isset($_POST["mp_movie_video_type"])){
        update_post_meta($post_id, '_mp_movie_video_type', sanitize_text_field($_POST["mp_movie_video_type"]));
    }
    if(isset($_POST["mp_movie_is_featured"])){
        update_post_meta($post_id, '_mp_movie_is_featured', true);
    }else{
        update_post_meta($post_id, '_mp_movie_is_featured', false);
    }
 }

 add_action('save_post', 'mp_save_movie_metaboxes');