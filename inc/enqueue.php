<?php
// Enqueue styles and scripts
function realestate_enqueue_assets(){
    wp_enqueue_style('realestate-style', get_stylesheet_uri());
    wp_enqueue_style('realestate-main', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_script('realestate-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);

    // Google Maps API - replace YOUR_GOOGLE_MAPS_API_KEY with your key
    $key = defined('REAL_ESTATE_GOOGLE_MAPS_KEY') ? REAL_ESTATE_GOOGLE_MAPS_KEY : 'YOUR_GOOGLE_MAPS_API_KEY';
    wp_enqueue_script('google-maps-api', "https://maps.googleapis.com/maps/api/js?key={$key}&libraries=places&callback=initPropertyMap", array(), null, true);
    wp_enqueue_script('property-map', get_template_directory_uri() . '/assets/js/google-maps.js', array('google-maps-api'), null, true);
}
add_action('wp_enqueue_scripts','realestate_enqueue_assets');

// Admin scripts (for geocoding in post edit screen)
function realestate_admin_scripts($hook){
    global $post;
    if(($hook === 'post-new.php' || $hook === 'post.php') && isset($post) && $post->post_type === 'property'){
        $key = defined('REAL_ESTATE_GOOGLE_MAPS_KEY') ? REAL_ESTATE_GOOGLE_MAPS_KEY : 'YOUR_GOOGLE_MAPS_API_KEY';
        wp_enqueue_script('google-maps-api-admin', "https://maps.googleapis.com/maps/api/js?key={$key}&libraries=places", array(), null, true);
        wp_enqueue_script('admin-maps', get_template_directory_uri() . '/assets/js/admin-maps.js', array('google-maps-api-admin'), null, true);
    }
}
add_action('admin_enqueue_scripts','realestate_admin_scripts');
?>