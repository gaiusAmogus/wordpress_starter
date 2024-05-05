<?php
function add_theme_assets()
{
    // wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/assets/vendor/jquery/jquery-ui.min.css', array(), '1.13.2', 'all');
    wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.00', 'all');

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery',  get_template_directory_uri() . '/assets/vendor/jquery/jquery.min.js', array(), '3.7.1', true);
    // wp_enqueue_script('jquery-ui',  get_template_directory_uri() . '/assets/vendor/jquery/jquery-ui.min.js', array(), '1.13.2', true);
    // wp_enqueue_script('jquery-matchHeight',  get_template_directory_uri() . '/assets/vendor/jquery/jquery.matchHeight.min.js', array(), '0.7.2', true);
    wp_enqueue_script('main',  get_template_directory_uri() . '/assets/js/main.js', array(), '1.00', true);
}
add_action('wp_enqueue_scripts', 'add_theme_assets');