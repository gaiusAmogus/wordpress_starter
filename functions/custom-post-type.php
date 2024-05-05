<?php
//disable default posts
// function remove_posts_menu()
// {
//     remove_menu_page('edit.php');
// }
// add_action('admin_menu', 'remove_posts_menu');


// //register custom post types
// function gaiusAmogus_custom_post_type()
// {
//     // Add admin page to the menu
//     function add_admin_page()
//     {
//         add_menu_page(
//             'Menu_page', //Page Title
//             'Menu_page', //Menu Title
//             'manage_options', //Capability
//             'CPT_SLUG_HERE_cpt', //Page slug
//             'admin_page_html', //Callback to print html
//             'dashicons-welcome-write-blog', // icon_url
//             5   // position
//         );
//     }
//     add_action('admin_menu', 'add_admin_page');


//     //CPT_SLUG_HERE z terenów
//     $CPT_SLUG_HERE = array(
//         'name'                => _x('CPT_NAME', 'Post Type General Name'),
//         'singular_name'       => _x('CPT_NAME', 'Post Type Singular Name'),
//         'menu_name'           => __('CPT_NAME '),
//         'all_items'           => __('CPT_NAME '),
//         'view_item'           => __('Zobacz'),
//         'add_new_item'        => __('Dodaj'),
//         'add_new'             => __('Dodaj nowy'),
//         'edit_item'           => __('Edytuj'),
//         'search_items'        => __('Szukaj'),
//     );
//     $CPT_SLUG_HERE_args = array(
//         'label'               => __('CPT_SLUG_HERE'),
//         'labels'              => $CPT_SLUG_HERE,
//         'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes','excerpt','author', revisions'),
//         'hierarchical'        => true,
//         'public'              => true,
//         'show_ui'             => true,
//         'show_in_menu'        => true,
//         'show_in_nav_menus'   => true,
//         'show_in_admin_bar'   => true,
//         'menu_icon'           => 'dashicons-welcome-write-blog',
//         'menu_position'       => 2,
//         'can_export'          => true,
//         'has_archive'         => false,
//         'exclude_from_search' => false,
//         'publicly_queryable'  => true,
//         'capability_type'     => 'post',
//         'show_in_rest' => true,
//     );
//     register_post_type('CPT_SLUG_HERE', $CPT_SLUG_HERE_args);

// }
// add_action('init', 'gaiusAmogus_custom_post_type', 0);



// //register taxonomies
// function gaiusAmogus_register_taxonomy()
// {
//     $taxonomy = array(
//         'name' => _x('TAXONOMY_NAME', 'taxonomy general name'),
//         'singular_name' => _x('TAXONOMY_NAME', 'taxonomy singular name'),
//         'menu_name' => __('TAXONOMY_NAME'),
//     );
//     register_taxonomy('taxonomy', array('CPT_SLUG_HERE'), array(
//         'hierarchical' => true,
//         'labels' => $taxonomy,
//         'show_ui' => true,
//         'show_admin_column' => true,
//         'query_var' => true,
//         'show_in_rest' => true,
//     ));

// }
// add_action('init', 'gaiusAmogus_register_taxonomy');



// //show edit taxonomies buttons
// function gaiusAmogus_custom_admin_archive_link()
// {
   
//     function gaiusAmogus_custom_admin_archive_link_subjects()
//     {
//         echo '<div class="wrap" style="margin-top: 15px"><a href="' . get_site_url() . '/wp-admin/edit-tags.php?taxonomy=TAXONOMY_SLUG_HERE&post_type=CPT_SLUG_HERE" class="page-title-action">Button text</a></div>';
//     }
//     add_filter('views_edit-pytania_cpt', 'gaiusAmogus_custom_admin_archive_link_subjects');
// }
// add_action('init', 'gaiusAmogus_custom_admin_archive_link');

/* function to duplicate posts */
function rd_duplicate_post_link( $actions, $post ) {

    //print_r($actions);
    //if (current_user_can('edit_posts') || $post->post_type=='movies') {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplikuj</a>';
   // }
    return $actions;
}
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);
function dt_dpp_post_as_draft(){
    global $wpdb;

    /*sanitize_GET POST REQUEST*/
    $post_copy = sanitize_text_field( $_POST["post"] );
    $get_copy = sanitize_text_field( $_GET['post'] );
    $request_copy = sanitize_text_field( $_REQUEST['action'] );

    $opt = get_option('dpp_wpp_page_options');
    $suffix = !empty($opt['dpp_post_suffix']) ? ' -- '.$opt['dpp_post_suffix'] : '';
    $post_status = !empty($opt['dpp_post_status']) ? $opt['dpp_post_status'] : 'draft';
    $redirectit = !empty($opt['dpp_post_redirect']) ? $opt['dpp_post_redirect'] : 'to_list';

    if (! ( isset( $get_copy ) || isset( $post_copy ) || ( isset($request_copy) && 'dt_dpp_post_as_draft' == $request_copy ) ) ) {
        wp_die('No post!');
    }
    $returnpage = '';

    /* Get post id */
    $post_id = (isset($get_copy) ? $get_copy : $post_copy );
    $post = get_post( $post_id );
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;

    /*reate the post Copy */
    if(isset( $post ) && $post != null) {
        /* Post data array */
        $args = array('comment_status' => $post->comment_status,
        'ping_status' => $post->ping_status,
        'post_author' => $new_post_author,
        'post_content' => $post->post_content,
        'post_excerpt' => $post->post_excerpt,
        'post_name' => $post->post_name,
        'post_parent' => $post->post_parent,
        'post_password' => $post->post_password,
        'post_status' => $post_status,
        'post_title' => $post->post_title.$suffix,
        'post_type' => $post->post_type,
        'to_ping' => $post->to_ping,
        'menu_order' => $post->menu_order

    );
    $new_post_id = wp_insert_post( $args );

    $taxonomies = get_object_taxonomies($post->post_type);
    if(!empty($taxonomies) && is_array($taxonomies)):
        foreach ($taxonomies as $taxonomy) {
            $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }
    endif;

    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
    if (count($post_meta_infos)!=0) {
        $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
        foreach ($post_meta_infos as $meta_info) {
            $meta_key = $meta_info->meta_key;
            $meta_value = addslashes($meta_info->meta_value);
            $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
        }
        $sql_query.= implode(" UNION ALL ", $sql_query_sel);
        $wpdb->query($sql_query);
    }

    /*choice redirect */
        if($post->post_type != 'post'):$returnpage = '?post_type='.$post->post_type;  endif;
        if(!empty($redirectit) && $redirectit == 'to_list'):wp_redirect( admin_url( 'edit.php'.$returnpage ) );
        elseif(!empty($redirectit) && $redirectit == 'to_page'):wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
        else:
            wp_redirect( admin_url( 'edit.php'.$returnpage ) );
        endif;
        exit;
    } 
    else {
        wp_die('Error! Post creation failed: ' . $post_id);
    }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'dt_dpp_post_as_draft' ); 
/* function to duplicate posts end*/