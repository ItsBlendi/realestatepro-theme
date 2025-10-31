<?php
/**
 * Register property CPT and add meta boxes
 */
function realestatepro_register_property_cpt(){
    $labels = array('name'=>'Properties','singular_name'=>'Property','add_new'=>'Add New Property');
    $args = array('labels'=>$labels,'public'=>true,'show_in_rest'=>true,'menu_icon'=>'dashicons-admin-home','supports'=>array('title','editor','thumbnail'),'has_archive'=>true,'rewrite'=>array('slug'=>'properties'));
    register_post_type('property',$args);
}
add_action('init','realestatepro_register_property_cpt');

// Meta boxes
function realestatepro_add_property_meta_boxes(){
    add_meta_box('realestatepro_property_details','Property Details','realestatepro_render_property_meta_box','property','normal','default');
}
add_action('add_meta_boxes','realestatepro_add_property_meta_boxes');

function realestatepro_render_property_meta_box($post){
    wp_nonce_field(basename(__FILE__),'realestatepro_property_nonce');
    $price = get_post_meta($post->ID,'_price',true);
    $city = get_post_meta($post->ID,'_city',true);
    $bedrooms = get_post_meta($post->ID,'_bedrooms',true);
    $bathrooms = get_post_meta($post->ID,'_bathrooms',true);
    $garage = get_post_meta($post->ID,'_garage',true);
    $type = get_post_meta($post->ID,'_type',true);
    $featured = get_post_meta($post->ID,'_featured',true);
    $latitude = get_post_meta($post->ID,'latitude',true);
    $longitude = get_post_meta($post->ID,'longitude',true);
    ?>
    <table class="form-table">
      <tr><th><label for="price">Price (€)</label></th><td><input type="number" name="price" id="price" value="<?php echo esc_attr($price); ?>" class="regular-text" /></td></tr>
      <tr><th><label for="city">Location</label></th><td><input type="text" id="location-field" name="city" value="<?php echo esc_attr($city); ?>" class="regular-text" /></td></tr>
      <tr><th><label for="bedrooms">Bedrooms</label></th><td><input type="number" name="bedrooms" id="bedrooms" value="<?php echo esc_attr($bedrooms); ?>" class="small-text" /></td></tr>
      <tr><th><label for="bathrooms">Bathrooms</label></th><td><input type="number" name="bathrooms" id="bathrooms" value="<?php echo esc_attr($bathrooms); ?>" class="small-text" /></td></tr>
      <tr><th><label for="garage">Garage Spaces</label></th><td><input type="number" name="garage" id="garage" value="<?php echo esc_attr($garage); ?>" class="small-text" /></td></tr>
      <tr><th><label for="type">Property Type</label></th><td><select name="type" id="type"><option value="">Select Type</option><option value="house" <?php selected($type,'house'); ?>>House</option><option value="apartment" <?php selected($type,'apartment'); ?>>Apartment</option><option value="land" <?php selected($type,'land'); ?>>Land</option></select></td></tr>
      <tr><th><label for="featured">Featured</label></th><td><input type="checkbox" name="featured" id="featured" value="1" <?php checked($featured,'1'); ?> /> <label for="featured">Mark as featured</label></td></tr>
      <tr><th><label for="latitude">Latitude</label></th><td><input type="text" name="latitude" value="<?php echo esc_attr($latitude); ?>" /></td></tr>
      <tr><th><label for="longitude">Longitude</label></th><td><input type="text" name="longitude" value="<?php echo esc_attr($longitude); ?>" /></td></tr>
      <tr><th></th><td><button type="button" id="geo-button">Get Coordinates From Address</button> <span id="geo-status"></span></td></tr>
    </table>
    <?php
}

function realestatepro_save_property_meta($post_id){
    if(!isset($_POST['realestatepro_property_nonce']) || !wp_verify_nonce($_POST['realestatepro_property_nonce'], basename(__FILE__))) return $post_id;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    if(isset($_POST['post_type']) && 'property' === $_POST['post_type'] && !current_user_can('edit_post',$post_id)) return $post_id;

    $fields = array(
        '_price' => sanitize_text_field($_POST['price'] ?? ''),
        '_city' => sanitize_text_field($_POST['city'] ?? ''),
        '_bedrooms' => sanitize_text_field($_POST['bedrooms'] ?? ''),
        '_bathrooms' => sanitize_text_field($_POST['bathrooms'] ?? ''),
        '_garage' => sanitize_text_field($_POST['garage'] ?? ''),
        '_type' => sanitize_text_field($_POST['type'] ?? ''),
        '_featured' => isset($_POST['featured']) ? '1' : '0',
        'latitude' => sanitize_text_field($_POST['latitude'] ?? ''),
        'longitude' => sanitize_text_field($_POST['longitude'] ?? ''),
    );

    foreach($fields as $key => $value){ update_post_meta($post_id, $key, $value); }
}
add_action('save_post','realestatepro_save_property_meta');
?>