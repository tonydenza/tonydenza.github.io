<?php
/**
 * Sanitization Functions
 * 
 * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php 
*/

function metro_magazine_sanitize_checkbox( $checked ){
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
  
function metro_magazine_sanitize_select( $input, $setting ){
    // Ensure input is a slug.
    $input = sanitize_key( $input );
    
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
 
function metro_magazine_sanitize_number_absint( $number, $setting ) {
    // Ensure $number is an absolute integer (whole number, zero or greater).
    $number = absint( $number );
    
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}