<?php

/*****************************************************************************************************/

/* INCLUDE SCRIP & ASSETS */
get_template_part('functions/include-script-styles');

/*****************************************************************************************************/

/* MENU REGISTER */
get_template_part('functions/menu-register');

/*****************************************************************************************************/

/* STYLE ACF WP */
get_template_part('functions/style-acf-wp');

/*****************************************************************************************************/

/* CUSTOM POST TYPE & TAXONOMIES */
//get_template_part('functions/custom-post-type');  

/*****************************************************************************************************/

/* OPTION PAGES */
//get_template_part('functions/acf-options-page');  

/*****************************************************************************************************/

/* INCLUDE ACF BLOCKS */
//get_template_part('functions/acf-blocks');

/*****************************************************************************************************/

/* DISABLE COMMENTS */
get_template_part('functions/disable-comments');

/*****************************************************************************************************/

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

add_theme_support( 'woocommerce' );
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' ); //disable woocomerce default style

//allow svg
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml'; 
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types'); 


//admin avatar change
function admin_avatar($args, $id_or_email) {
    if(is_numeric($id_or_email)) {
        $user_id = (int)$id_or_email;
        if($user_id == 1 || $user_id == 2) {
            $args['url'] = get_template_directory_uri() . '/assets/img/admin/avatar.svg';
        }
    }
    return $args;
} 
add_filter('get_avatar_data', 'admin_avatar', 100, 2);
