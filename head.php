<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- remove bellow after migrate to correct domain -->
    <meta name="googlebot" content="noindex">
    <meta name="googlebot-news" content="nosnippet">

    <!-- Basic metatags -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php the_title(); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>" />

    <!-- Facebook and commons social media -->
    <meta property="og:title" content="<?php the_title(); ?>">
    <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo get_bloginfo('url'); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo get_bloginfo('url'); ?>">
    <meta property="twitter:title" content="<?php the_title();?>">
    <meta property="twitter:description" content="<?php bloginfo('description'); ?>">
    <meta property="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg">


    <!-- favico -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/ico/favicon.png" />

    
    <!-- styles and scripts in functions.php -->
  

    <?php wp_head(); ?>
</head>