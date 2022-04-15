<?php
    // color
    new WP_Customize_Color_Control();
    'sanitize_callback' => 'sanitize_hex_color'

    // image
    new WP_Customize_Image_Control();
    'sanitize_callback' => 'esc_url_raw'

    // type: radio
    'sanitize_callback' => array( __CLASS__, 'sanitize_select' )
    public static function sanitize_select( $input, $setting ) {
        $input   = sanitize_key( $input );
        $choices = $setting->manager->get_control( $setting->id )->choices;
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

    // type: checkbox
    'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' )
    public static function sanitize_checkbox( $checked ) {
        return ( ( isset( $checked ) && true === $checked ) ? true : false );
    }
    

?>