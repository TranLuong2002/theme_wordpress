<?php
if (!defined('ABSPATH')) exit;

function your_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));

    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'luong dev'),
        'footer' => __('Footer Menu', 'luong dev')
    ));
}
add_action('after_setup_theme', 'your_theme_setup');