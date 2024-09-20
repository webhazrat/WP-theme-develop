<?php

/**
 * Add columns to datatable
 */

 function mp_movie_table_columns($columns){
   unset($columns['date']);
   unset($columns['author']);
   unset($columns['taxonomy-movie_cat']);
    $columns['image'] = __('Poster', 'mp');
    $columns['release_year'] = __('Release Year', 'mp');
    $columns['video_type'] = __('Video Type', 'mp');
    $columns['author'] = __('Author', 'mp');
    $columns['taxonomy-movie_cat'] = __('Categories', 'mp');
    $columns['date'] = __('Published On', 'mp');

    return $columns;
 }
 add_filter('manage_movie_posts_columns', 'mp_movie_table_columns');


 /**
  * Output table columns values
  */

  function mp_movie_table_data($column, $post_id){
   switch($column){
      case 'image' :
         echo get_the_post_thumbnail($post_id, array(50, 50));
         break;
      case 'release_year':
         echo get_post_meta($post_id, '_mp_movie_release_year', true);
         break;
      case 'video_type':
         echo get_post_meta($post_id, '_mp_movie_video_type', true);
         break;
      default: 
         break;
   }
  }
  add_filter('manage_movie_posts_custom_column', 'mp_movie_table_data', 10, 2);

  /**
   * Making columns sortable
   */
  function mp_movie_table_columns_sortable($columns){
   $columns['release_year'] = 'release_year';
   $columns['video_type'] = 'video_type';
   return $columns;
  }
  add_filter('manage_edit-movie_sortable_columns', 'mp_movie_table_columns_sortable');

  /**
   * Columns sorting logic
   */
  function mp_movie_table_columns_sorting_logic($query){
   if(!is_admin() || !$query->is_main_query()){
      return;
   }
   if('release_year' === $query->get('orderby')){
      $query->set('orderby', 'meta_value');
      $query->set('meta_key', '_mp_movie_release_year');
   }
   if('video_type' === $query->get('orderby')){
      $query->set('orderby', 'meta_value');
      $query->set('meta_key', '_mp_movie_video_type');
   }
  }
  add_action('pre_get_posts', 'mp_movie_table_columns_sorting_logic');