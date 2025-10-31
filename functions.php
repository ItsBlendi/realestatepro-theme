<?php
// Theme functions
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/custom-post-types.php';

function realestatepro_setup(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array('primary'=>'Primary Menu'));
}
add_action('after_setup_theme','realestatepro_setup');

// Widget area
function realestatepro_widgets(){
    register_sidebar(array(
        'name'=>'Sidebar',
        'id'=>'sidebar',
        'before_widget'=>'<div class="widget">',
        'after_widget'=>'</div>',
        'before_title'=>'<h3>',
        'after_title'=>'</h3>'
    ));
}
add_action('widgets_init','realestatepro_widgets');
?>