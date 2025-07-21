<?php
// inc/theme-setup.php
if (!defined('ABSPATH')) exit;

// Theme setup
function theme_setup() {
    // Theme supports
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer_about' => 'Footer About Menu',
        'footer_services' => 'Footer Services Menu'
    ));
}
add_action('after_setup_theme', 'theme_setup');

// Image sizes
function theme_image_sizes() {
    add_image_size('news-thumbnail', 400, 250, true);
    add_image_size('hero-banner', 1920, 500, true);
    add_image_size('single-featured', 800, 400, true);
}
add_action('after_setup_theme', 'theme_image_sizes');

// Widget areas
function theme_widgets_init() {
    register_sidebar(array(
        'name' => 'Primary Sidebar',
        'id' => 'sidebar-1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => 'Footer Widget Area',
        'id' => 'footer-1',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'theme_widgets_init');