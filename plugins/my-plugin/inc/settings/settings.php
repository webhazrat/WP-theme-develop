<?php

/**
 * Create settings menu
 */

 function mp_settings_menu(){
    $hook = add_menu_page(
        __('MP Settings', 'mp'),
        __('MP Settings', 'mp'),
        'manage_options',
        'mp-settings',
        'mp_setting_callback_template',
        '',
        null
    );

    add_action('admin_head-'.$hook, 'mp_settings_assets', 10, 1);
 }
 add_action('admin_menu', 'mp_settings_menu');

 /**
  * Enqueue assets
  */
  function mp_settings_assets(){
    wp_enqueue_media();
    wp_enqueue_script('mp-file-upload-script');
  }

 /**
  * Settings callback template
  */
  function mp_setting_callback_template(){
    ?>
    <div class="warp">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">
        <?php 
          settings_fields('mp-settings');
          do_settings_sections('mp-settings');
          submit_button('Save Settings');
         ?>
      </form>
    </div>
    <?php
  }

/**
 * Settings template
 */

 function mp_settings_template(){
    add_settings_section(
      'mp_settings_section',
      __('MP Settings Page', 'mp'),
      '',
      'mp-settings'
    );

    // register input
    register_setting(
      'mp-settings',
      'mp_settings_input',
      array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
      )
    );

    // add settings fields
    add_settings_field(
      'mp_settings_input',
      __('Input Field', 'mp'),
      'mp_settings_input_field_callback',
      'mp-settings',
      'mp_settings_section'
    );


    // register textarea
    register_setting(
      'mp-settings',
      'mp_settings_textarea',
      array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_textarea_field',
        'default' => ''
      )
    );
     // add settings fields
     add_settings_field(
      'mp_settings_textarea',
      __('Textarea Field', 'mp'),
      'mp_settings_textarea_field_callback',
      'mp-settings',
      'mp_settings_section'
    );


    // register select
    register_setting(
      'mp-settings',
      'mp_settings_select',
      array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
      )
    );
     // add settings fields
     add_settings_field(
      'mp_settings_select',
      __('Select Field', 'mp'),
      'mp_settings_select_field_callback',
      'mp-settings',
      'mp_settings_section'
    );

    // register radio
    register_setting(
      'mp-settings',
      'mp_settings_radio',
      array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
      )
    );
     // add settings fields
     add_settings_field(
      'mp_settings_radio',
      __('Radio Field', 'mp'),
      'mp_settings_radio_field_callback',
      'mp-settings',
      'mp_settings_section'
    );

    // register checkbox
    register_setting(
      'mp-settings',
      'mp_settings_checkbox',
      'mp_sanitize_checkbox_array'
    );
     // add settings fields
     add_settings_field(
      'mp_settings_checkbox',
      __('Checkbox Field', 'mp'),
      'mp_settings_checkbox_field_callback',
      'mp-settings',
      'mp_settings_section'
    );

    // register file
    register_setting(
      'mp-settings',
      'mp_settings_file',
      array(
        'type' => 'integer',
        'sanitize_  callback' => null,
        'default' => ''
      )
    );
     // add settings fields
     add_settings_field(
      'mp_settings_file',
      __('File Field', 'mp'),
      'mp_settings_file_field_callback',
      'mp-settings',
      'mp_settings_section'
    );

 }
 add_action('admin_init', 'mp_settings_template');

 function mp_sanitize_checkbox_array($input) {
  if (is_array($input)) {
      foreach ($input as $key => $value) {
          $input[$key] = sanitize_text_field($value);
      }
  } else {
      $input = array();
  }
  return $input;
}

//  Settings input field template
function mp_settings_input_field_callback(){
  $mp_input_field = get_option('mp_settings_input');
  ?>
   <input type="text" name="mp_settings_input" class="regular-text" value="<?php echo isset($mp_input_field) ? esc_attr($mp_input_field) : ''; ?>" />
  <?php
}

//  Settings textarea field template
function mp_settings_textarea_field_callback(){
  $mp_textarea_field = get_option('mp_settings_textarea');
  ?>
   <textarea name="mp_settings_textarea" class="large-text" rows="6" ><?php echo isset($mp_textarea_field) ? esc_attr($mp_textarea_field) : ''; ?></textarea>
  <?php
}

// Settings select field template
function mp_settings_select_field_callback(){
  $mp_select_field = get_option('mp_settings_select');
  ?>
   <select name="mp_settings_select" class="regular-text">
    <option value="">Select One</option>
    <option value="Option1" <?php selected('Option1', $mp_select_field); ?>>Option1</option>
    <option value="Option2" <?php selected('Option2', $mp_select_field); ?>>Option2</option>
  </select>
  <?php
}

// Settings radio field template
function mp_settings_radio_field_callback(){
  $mp_radio_field = get_option('mp_settings_radio');
  ?>
  <label for="value1">
    <input type="radio" name="mp_settings_radio" id="value1" value="value1" <?php checked('value1', $mp_radio_field); ?>> Value 1
  </label>
  <label for="value2">
    <input type="radio" name="mp_settings_radio" id="value2" value="value2" <?php checked('value2', $mp_radio_field); ?>> Value 2
  </label>
  <?php
}

// Settings checkbox template
function mp_settings_checkbox_field_callback(){
  $mp_checkbox_field = get_option('mp_settings_checkbox');
  ?>
  <label for="value1">
    <input type="checkbox" name="mp_settings_checkbox[]" id="value1" value="value1" <?php checked(in_array('value1', $mp_checkbox_field), true); ?>> Value 1
  </label>
  <label for="value2">
    <input type="checkbox" name="mp_settings_checkbox[]" id="value2" value="value2" <?php checked(in_array('value2', $mp_checkbox_field), true); ?>> Value 2
  </label>
  <?php
}

// Settings file template
function mp_settings_file_field_callback(){
  $mp_file_field = get_option('mp_settings_file');
  ?>
    <div class="mp-upload-wrap">
      <img class="mp-preview" src="<?php echo esc_url(wp_get_attachment_url($mp_file_field)); ?>" alt="" data-src="" width="250" />
      <div class="mp-upload-action">
        <input type="hidden" name="mp_settings_file" value="<?php echo esc_attr(isset($mp_file_field) ? (int) $mp_file_field : 0); ?>" />
        <?php if($mp_file_field == 0) : ?>
        <button type="button" class="add-file-button upload-button button-add-media button-add-site-icon"> Choose a Image</button>
        <?php else : ?>
        <button type="button" class="remove-file-button button button-secondary"> Remove Image</button>
        <?php endif; ?>
      </div>
    </div>
  <?php
}