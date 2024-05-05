<?php get_template_part('functions/head'); ?>
<body <?php body_class(); ?>>

<header>
    <?php
        wp_nav_menu(array(
        'theme_location' => 'main',
        'container' => 'ul'
        ));
        ?>
</header>