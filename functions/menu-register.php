<?php 
function register_menus(){
    register_nav_menus(array(
        'main' => esc_html__('main')
    ));
}
add_action('init', 'register_menus');