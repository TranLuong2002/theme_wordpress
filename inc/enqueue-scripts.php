<?php
// inc/enqueue-scripts.php
if (!defined('ABSPATH')) exit;

// Main scripts and styles
function theme_enqueue_scripts() {
    // CSS
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), THEME_VERSION);
    wp_enqueue_style('main-style', THEME_URI . '/assets/css/main.css', array(), THEME_VERSION);
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // JavaScript
    wp_enqueue_script('theme-main', THEME_URI . '/assets/js/main.js', array('jquery'), THEME_VERSION, true);
    
    // Conditional scripts
    if (is_search()) {
        wp_enqueue_script('search-functions', THEME_URI . '/assets/js/search.js', array('jquery'), THEME_VERSION, true);
    }
    
    if (is_category()) {
        wp_enqueue_script('category-functions', THEME_URI . '/assets/js/category.js', array('jquery'), THEME_VERSION, true);
    }
    
    if (is_single()) {
        wp_enqueue_script('single-post', THEME_URI . '/assets/js/single.js', array('jquery'), THEME_VERSION, true);
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

// Admin scripts
function theme_admin_scripts() {
    wp_enqueue_style('theme-admin', THEME_URI . '/assets/css/admin.css', array(), THEME_VERSION);
}
add_action('admin_enqueue_scripts', 'theme_admin_scripts');